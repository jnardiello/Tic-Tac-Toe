<?php

namespace TicTacToe;

use TicTacToe\Rules\WinRule;

class SimulatedBoard extends Board
{
    public function __construct(\TicTacToe\Board $board)
    {
        $this->board = $board->board;
    }
}
