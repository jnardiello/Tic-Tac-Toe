<?php

namespace TicTacToe;

use TicTacToe\Rules\WinRule;
use TicTacToe\Rules\BlockRule;
use TicTacToe\Rules\ForkRule;
use TicTacToe\Rules\CenterRule;
use TicTacToe\Rules\OpponentCornerRule;
use TicTacToe\Rules\BlockOpponentForkRule;
use TicTacToe\Rules\ChoseSideRule;
use TicTacToe\Rules\ChoseCornerRule;
use TicTacToe\Rules\TwoConsecutiveRule;

class Ai extends Player
{
    public function __construct()
    {
        parent::__construct('Al');
    }

    public function deduct()
    {
        $prioritizedRules = [
            new WinRule($this),
            new BlockRule($this),
            new ForkRule($this),
//            new TwoConsecutiveRule($this),
            /* new BlockOpponentForkRule($this), */
            new CenterRule($this),
            new OpponentCornerRule($this),
            new ChoseCornerRule($this),
            new ChoseSideRule($this),
        ];

        $currentBoard = $this->board;

        foreach ($prioritizedRules as $rule) {
            if ($move = $rule->apply($currentBoard)) {
                return $move;
            }
        }

        return false;
    }

    public function applyWinRule()
    {
        $currentBoard = $this->board;
        $winRule = new WinRule($this);

        return $winRule->apply($currentBoard);
    }
}
