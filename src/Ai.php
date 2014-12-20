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
        $centerRule = new CenterRule($this);
        $opponentCornerRule = new OpponentCornerRule($this);
        $blockOpponentForkRule = new BlockOpponentForkRule($this);
        $choseCornerRule = new ChoseCornerRule($this);
        $choseSideRule = new ChoseSideRule($this);
        $currentBoard = $this->board;

        if ($move = $winRule->apply($currentBoard)) {
            return $move;
        } else if ($move = $blockRule->apply($currentBoard)) {
            return $move;
        } else if ($move = $forkRule->apply($currentBoard)) {
            return $move;
        } else if ($move = $blockOpponentForkRule->apply($currentBoard)) {
            return $move;
        } else if ($move = $centerRule->apply($currentBoard)) {
            return $move;
        } else if ($move = $opponentCornerRule->apply($currentBoard)) {
            return $move;
        } else if ($move = $choseCornerRule->apply($currentBoard)) {
            return $move;
        } else if ($move = $choseSideRule->apply($currentBoard)) {
            return $move;
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
