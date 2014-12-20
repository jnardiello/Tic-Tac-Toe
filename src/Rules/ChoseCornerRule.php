<?php

namespace TicTacToe\Rules;

class ChoseCornerRule implements Rule
{
    public function apply(\TicTacToe\Board $board)
    {
        $cornerCoords = [
            [0, 0],
            [0, 2],
            [2, 0],
            [2, 2],
        ];

        foreach ($cornerCoords as $corner) {
            $cell = $board->get($corner);
            if ($cell->getValue() == '') {
                return $cell->getCoords();
            }
        }
    }
}
