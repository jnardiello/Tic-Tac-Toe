<?php

namespace TicTacToe\Rules;

class CenterRule implements Rule
{
    public function apply(\TicTacToe\Board $board)
    {
        $centerCell = $board->get([1, 1]);

        if ($centerCell->getValue() == '') {
            return $centerCell->getCoords();
        }

        return false;
    }
}
