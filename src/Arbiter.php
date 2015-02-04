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

    private function checkOccurrencesOfThree($collections)
    {
        foreach ($collections as $collection) {
            $diagonalArray = [];
            foreach ($collection as $cell) {
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

    private function getPlayerNameFromKey($key)
    {
       foreach ($this->players as $player) {
          if ($player->getPlaceholder() == $key) {
              return $player->getName();
          }
       }
    }

    public function checkForWinner()
    {
        $diagonals = $this->board->diagonals();
        if ($key = $this->checkOccurrencesOfThree($diagonals)) {
            return [
               'status' => 'winner',
               'winner' => $this->getPlayerNameFromKey($key),
            ];
        }

        $rows = $this->board->rows();
        if ($key = $this->checkOccurrencesOfThree($rows)) {
            return [
                'status' => 'winner',
                'winner' => $this->getPlayerNameFromKey($key),
            ];
        }

        $columns = $this->board->columns();
        if ($key = $this->checkOccurrencesOfThree($columns)) {
            return [
                'status' => 'winner',
                'winner' => $this->getPlayerNameFromKey($key),
            ];
        }

        if (count($this->board->getAvailableSpots()) == 0) {
            return [
                'status' => 'draw',
            ];
        }

        return false;
    }
}