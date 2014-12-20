<?php

namespace TicTacToe\Rules;

class ChoseSideRule implements Rule
{
    public function apply(\TicTacToe\Board $board)
    {
        $sidesCoords = [
            [0, 1],
            [1, 2],
            [2, 1],
            [1, 0],
        ];

        foreach ($sidesCoords as $side) {
            $cell = $board->get($side);
            if ($cell->getValue() == '') {
                return $cell->getCoords();
            }
        }
    }
}
