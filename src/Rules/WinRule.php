<?php

namespace TicTacToe\Rules;

class WinRule implements Rule
{
    private $player;

    public function __construct(\TicTacToe\Ai $al)
    {
        $this->player = $al;
    }

    public function apply(\TicTacToe\Board $board)
    {
        $rows = $board->rows();
        foreach ($rows as $row) {
            $currentPlayerBusyCellsCount = $this->countMyCells($row);
            if ($currentPlayerBusyCellsCount == $board->getDimension() - 1) {
                $winningCell = $this->getAvailableSpots($row)[0];
                return $winningCell->getCoords();
            }
        }

        return false;
    }

    private function getAvailableSpots(array $cells)
    {
        $result = [];
        foreach ($cells as $cell) {
            if ($cell->getValue() == '') {
                $result[] = $cell;
            }
        }

        return $result;
    }

    private function countMyCells(array $cells)
    {
        $result = [];
        foreach ($cells as $cell) {
            if ($cell->getValue() == $this->player->getPlaceholder()) {
                $result[] = $cell;
            }
        }

        return count($result);
    }
}
