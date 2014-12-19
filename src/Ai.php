<?php

namespace TicTacToe;

use TicTacToe\Rules\WinRule;
use TicTacToe\Rules\BlockRule;
use TicTacToe\Rules\ForkRule;

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
        $forkRule = new ForkRule($this);
        $currentBoard = $this->board;

        if ($move = $winRule->apply($currentBoard)) {
            return $move;
        } else if ($move = $blockRule->apply($currentBoard)) {
            return $move;
        } 
        /* else if ($move = $forkRule->apply($currentBoard)) { */
        /*     return $move; */
        /* } */
    }


}
