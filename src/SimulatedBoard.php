<?php

namespace TicTacToe;

use TicTacToe\Rules\WinRule;

class SimulatedBoard extends Board
{
    public function __construct($board)
    {
        $this->board = $this->cloneBoard($board);
    }

    private function cloneBoard($board)
    {
        $newBoard = new Board();
        foreach ($board->all() as $cell) {
            $newBoard->set($cell->getCoords(), $cell->getValue());
        }

        return $newBoard->all();
    }
}
