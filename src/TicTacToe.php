<?php

namespace TicTacToe;

class TicTacToe
{
    const LOCAL_NAMESPACE = 'TicTacToe\\';
    const NUM_PLAYERS = 2;

    private $board;
    private $players = [];

    public function __construct()
    {
        $this->board = new Board();
    }

    /**
     * @param string $name
     * @param string $placeholder
     * @return TicTacToe this game
     */
    public function addHuman($name, $placeholder)
    {
        $this->addPlayer('Player', $name, $placeholder);

        return $this;
    }

    /**
     * @param string $name
     * @param string $placeholder
     * @return $this
     */
    public function addAi($name, $placeholder)
    {
        $this->addPlayer('Ai', $name, $placeholder);

        return $this;
    }

    /**
     * @param string $type
     * @param string $name
     * @param string $placeholder
     *
     * Add a player to the players array
     */
    private function addPlayer($type, $name, $placeholder)
    {
        if (count($this->players) < self::NUM_PLAYERS) {
            if (!isset($this->players[$placeholder])) {
                $class = self::LOCAL_NAMESPACE . $type;
                $player = new $class($name);
                $player
                    ->setBoard($this->board)
                    ->setPlaceholder($placeholder);

                $this->players[$placeholder] = $player;
            } else {
                throw new \Exception('Duplicate placeholder');
            }
        } else {
            throw new \Exception("Too many players.");
        }
    }

    /**
     * @return array Players
     */
    public function getPlayers()
    {
        return $this->players;
    }

    public function play()
    {
        if (count($this->players) < 2) {
            throw new \Exception("Not enough players.");
        }
    }


    public static function againstAi(\TicTacToe\Player $player)
    {
        $board = new Board();

        $player->setPlaceholder('X')
            ->setBoard($board);

        $ai = new Ai();
        $ai->setPlaceholder('O')
           ->setBoard($board);

        return new TicTacToe($player, $ai, $board);
    }

    public function moveAgainstAi($humanCoords)
    {
        $sanitizer = new Sanitizer();
        $healthyCoords = $sanitizer->check($humanCoords);
        $player = $this->getPlayer();

        if ( !$healthyCoords || !$player->move($healthyCoords)) {
            return false;
        }

        if (count($this->board->getAvailableSpots()) > 0 && !$this->checkForWinner()) {
            $ai = $this->getAi();
            $ai->move($ai->deduct());
        }

        return true;
    }

    public function getBoard()
    {
        return $this->board;
    }

    public function getPlayer()
    {
        return $this->players['X'];
    }

    private function checkOccurrencesOfThree($diagonals)
    {
        foreach ($diagonals as $diagonal) {
            $diagonalArray = [];
            foreach ($diagonal as $cell) {
                $diagonalArray[] = $cell->getValue();
            }

            $countedValues = array_count_values($diagonalArray);
            foreach ($countedValues as $key => $placeholderOccurrences) {
                if ($placeholderOccurrences == 3 && $key != '') {
                    return $key;
                }
            }
        }

    }

    public function checkForWinner()
    {
        $diagonals = $this->board->diagonals();
        if ($key = $this->checkOccurrencesOfThree($diagonals)) {
             return $this->players[$key]->getName();
        }

        $rows = $this->board->rows();
        if ($key = $this->checkOccurrencesOfThree($rows)) {
             return $this->players[$key]->getName();
        }

        $columns = $this->board->columns();
        if ($key = $this->checkOccurrencesOfThree($columns)) {
             return $this->players[$key]->getName();
        }

        if (count($this->board->getAvailableSpots()) == 0) {
            return 'Draw';
        }

        return false;
    }
}
