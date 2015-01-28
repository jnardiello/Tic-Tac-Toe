<?php

namespace TicTacToe\Rules;

use TicTacToe\SimulatedBoard;
use TicTacToe\Ai;

class ForkBaseRule
{
    protected function simulate(\TicTacToe\Cell $currentCell, \TicTacToe\Board $board, $placeholder)
    {
        $simulatedBoard = new SimulatedBoard($board);
        $simulatedBoard->set($currentCell->getCoords(), $placeholder);

        $ai = new Ai();
        $ai->setPlaceholder($placeholder)
            ->setBoard($simulatedBoard);
        $winningMovesCoords = $ai->applyWinRule();

        if (count($winningMovesCoords) > 1) {
            return $winningMovesCoords;
        }

        return false;
    }

    protected function detectFork($board)
    {

    }
}
