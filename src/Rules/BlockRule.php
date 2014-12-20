<?php

namespace TicTacToe\Rules;

class BlockRule implements Rule
{
    const MOVE_TO_LOSE = 1;

    private $player;

    public function __construct(\TicTacToe\Ai $al)
    {
        $this->player = $al;
    }

    public function apply(\TicTacToe\Board $board)
    {
        $availableSpots = $board->getAvailableSpots();

        foreach ($availableSpots as $cell) {
            $row = $board->row($cell->getCoords());
            if ($this->countOthersCells($row) == 2) {
                return $cell->getCoords();
            }
            $column = $board->column($cell->getCoords());
            if ($this->countOthersCells($column) == 2) {
                return $cell->getCoords();
            }
            $diagonal = $board->diagonal($cell->getCoords());
            if (isset($diagonal) && $this->countOthersCells($diagonal) == 2) {
                return $cell->getCoords();
            }
        }

        return false;
    }

    private function countOthersCells(array $cells)
    {
        $result = [];
        foreach ($cells as $cell) {
            if ($cell->getValue() != "" 
                && 
                $cell->getValue() != $this->player->getPlaceholder()) {
                $result[] = $cell;
            }
        }

        return count($result);
    }
}
