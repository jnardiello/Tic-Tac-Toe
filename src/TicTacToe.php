<?php

namespace TicTacToe;

use TicTacToe\Board;

class TicTacToe
{
    private $board;
    private $players = [];

    private function __construct($firstPlayer, $secondPlayer, $board)
    {
        $this->board = $board;
        $this->players['X'] = $firstPlayer;
        $this->players['O'] = $secondPlayer;
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

    public function getPlayers()
    {
        return $this->players;
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

    public function getAi()
    {
        return $this->players['O'];
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
        $player = $this->getPlayer();
        $ai = $this->getAi();
        $playerPlaceholder = $player->getPlaceholder();
        $aiPlaceholder = $ai->getPlaceholder();

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
