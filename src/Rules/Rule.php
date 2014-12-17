<?php

namespace TicTacToe\Rules;

interface Rule
{
    public function apply(\TicTacToe\Board $board);
}
