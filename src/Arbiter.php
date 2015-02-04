<?php

namespace TicTacToe;

class Arbiter
{
    private $game;
    private $board;

    public function __construct(TicTacToe $ticTacToe)
    {
        $this->game = $ticTacToe;
        $this->board = $ticTacToe->getBoard();
        $this->players = $ticTacToe->getPlayers();
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