<?php

namespace TicTacToe;

use TicTacToe\Rules\WinRule;
use TicTacToe\Rules\BlockRule;

class Ai extends Player
{
    public function __construct()
    {
        parent::__construct('Al');
    }

    public function deduct()
    {
        $winRule = new WinRule($this);
        $blockRule = new BlockRule($this);
        $currentBoard = $this->board;

        if ($move = $winRule->apply($currentBoard)) {
            return $move;
        } else if($move = $blockRule->apply($currentBoard)) {
            return $move;
        }
    }
}
