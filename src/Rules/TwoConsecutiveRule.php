<?php

namespace TicTacToe\Rules;

use TicTacToe\Board;
use TicTacToe\SimulatedBoard;
use TicTacToe\Ai;

class TwoConsecutiveRule extends ForkBaseRule implements Rule
{
    public function __construct(\TicTacToe\Ai $al)
    {
        $this->player = $al;
    }

    public function apply(\TicTacToe\Board $board)
    {
        $availableSpots = $board->getAvailableSpots();

        foreach ($availableSpots as $cell) {
            $opportunities = $this->simulate(
                $cell,
                $board,
                $this->player->getPlaceholder()
            );

            if ($opportunities) {
                var_dump($cell->getCoords(), $opportunities);
                die();
            }
        }

        return false;
    }

    private function getOpponentPlaceholder($board)
    {
        foreach ($board->board as $cell) {
            if ($cell->getValue() != $this->player->getPlaceholder() && $cell->getValue() != '') {
                return $cell->getValue();
            }
        }
    }
}
