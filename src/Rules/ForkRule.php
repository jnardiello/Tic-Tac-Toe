<?php

namespace TicTacToe\Rules;

use TicTacToe\Board;
use TicTacToe\SimulatedBoard;
use TicTacToe\Ai;

class ForkRule extends ForkBaseRule implements Rule
{
    public function __construct(\TicTacToe\Ai $al)
    {
        $this->player = $al;
    }

    public function apply(\TicTacToe\Board $board)
    {
        $availableCells = $board->getAvailableSpots();

        foreach ($availableCells as $cell) {
            $opportunities = $this->simulate($cell, $board, $this->player->getPlaceholder());
            if (is_array($opportunities) 
                &&
                count($opportunities) == 2) {
                return $cell->getCoords();
            }
        }

        return false;
    }
}
