<?php

namespace TicTacToe\Rules;

class OpponentCornerRule implements Rule
{
    public function __construct(\TicTacToe\Ai $al)
    {
        $this->player = $al;
    }

    public function apply(\TicTacToe\Board $board)
    {
        $cornersCoords = [
            [0, 0],
            [0, 2],
            [2, 0],
            [2, 2],
        ];

        $oppositeCornersArrayIds = [
            0 => 3,
            3 => 0,
            1 => 2,
            2 => 1,
        ];

        foreach ($cornersCoords as $key => $coords) {
            $cell = $board->get($coords);
            $resultId = $oppositeCornersArrayIds[$key];
            $oppositeCell = $board->get($cornersCoords[$resultId]);

            if ($cell->getValue() != $this->player->getPlaceholder() &&
                $cell->getValue() != '' &&
                $oppositeCell->getValue() == '')
            {
                    return $oppositeCell;
            }
        }

        return false;
    }
}
