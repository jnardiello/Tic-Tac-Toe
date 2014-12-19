<?php

namespace TicTacToe\Rules;

use TicTacToe\Board;
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
            $opportunitiesTheNewCellWillGenerate = $this->simulate($cell, $board);
            if (is_array($opportunitiesTheNewCellWillGenerate) 
                &&
                count($opportunitiesTheNewCellWillGenerate) == 2) {
                return $cell->getCoords();
            }
        }

        return false;
    }

    private function simulate($currentCell, $board)
    {
        $simulatedBoard = new SimulatedBoard($board);
        $simulatedBoard->set($currentCell->getCoords(), $this->player->getPlaceholder());

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($simulatedBoard);
        $winningMovesCoords = $ai->applyWinRule();

        if (count($winningMovesCoords) > 1) {
            return $winningMovesCoords;
        }

        return false;
    }
}
