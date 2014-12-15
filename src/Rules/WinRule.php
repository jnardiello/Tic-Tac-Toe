<?php

namespace TicTacToe\Rules;

class WinRule implements Rule
{
    public function execute(\TicTacToe\Board $board)
    {
        return 'A3';
    }
}
