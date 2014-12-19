<?php

namespace TicTacToe;

use TicTacToe\Rules\WinRule;

class SimulatedBoard extends Board
{
    public function __construct($board)
    {
        $this->board = $board->board;
    }
}
