<?php

namespace TicTacToe;

use TicTacToe\Rules\WinRule;

class Ai extends Player
{
    public function __construct()
    {
        parent::__construct('Al');
    }

    public function deduct()
    {
        $currentBoard = $this->board;
        $winRule = new WinRule();
        return $winRule->execute($currentBoard);
    }
}
