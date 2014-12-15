<?php

namespace TicTacToe\Rules;

interface Rule
{
    public function execute(\TicTacToe\Board $board);
}
