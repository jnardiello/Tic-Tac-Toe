<?php

namespace TicTacToe\Rules;

use TicTacToe\SimulatedBoard;
use TicTacToe\Ai;

class ForkRule implements Rule
{
    public function __construct(\TicTacToe\Ai $al)
    {
        $this->player = $al;
    }

    public function apply(\TicTacToe\Board $board)
    {
        $availableCells = $board->getAvailableSpots();

        foreach ($availableCells as $cell) {
            $opportunitiesTheNewCellWillGenerate = count($this->simulate($cell, $board));

            if ($opportunitiesTheNewCellWillGenerate == 2) {
                return $cell->getCoords();
            }
        }
    }

    private function simulate($currentCell, $board)
    {
        $simulatedBoard = new SimulatedBoard($board);
        $simulatedBoard->set($currentCell->getCoords(), $this->player->getPlaceholder());

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($simulatedBoard);
        $winningMovesCoords = $ai->deduct();

        if (count($winningMovesCoords) > 0) {
            return $winningMovesCoords;
        }

        return false;
    }
}
