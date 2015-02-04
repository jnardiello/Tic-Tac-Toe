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
            if (!$this->placeholderIsAlreadyInUse($placeholder)) {
                $class = self::LOCAL_NAMESPACE . $type;
                $player = new $class($name);
                $player
                    ->setBoard($this->board)
                    ->setPlaceholder($placeholder);

                $this->players[] = $player;
            } else {
                throw new \Exception('Duplicate placeholder');
            }
        } else {
            throw new \Exception("Too many players.");
        }
    }

    private function placeholderIsAlreadyInUse($placeholder)
    {
        foreach ($this->players as $player) {
            if ($player->getPlaceholder() == $placeholder) {
                return true;
            }
        }

        return false;
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
        $arbiter = new Arbiter($this);
        if (count($this->players) < 2) {
            throw new \Exception("Not enough players.");
        }

        do {
            foreach ($this->players as $player) {
                $player->move();

                // After each move we check if we have a winner
                // If we have one, the game ends and we celebrate
                if ($winner  = $arbiter->checkForWinner()) {
                    break;
                }
            }

        } while (!$winner);

        return $this->getWinnerMessage($winner);
    }

    private function getWinnerMessage($winner)
    {
        switch ($winner['status']) {
            case 'winner':
                return $this->board->toString() . "\n\n" . $winner['winner'] . " has won.\n\n";
                break;
            case 'draw':
                return $this->board->toString() . "\n\nThe game ended with a draw\n\n";
                break;
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
}
