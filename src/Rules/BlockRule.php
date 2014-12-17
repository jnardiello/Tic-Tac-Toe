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
        $spaceToExplore = [];
        $spaceToExplore['rows'] = $board->rows();
        $spaceToExplore['columns'] = $board->columns();
        $spaceToExplore['diagonals'] = $board->diagonals();

        foreach ($spaceToExplore as $cells) {
            $blockingSpot = $this->moveHereOrLose($board, $cells);
            if ($blockingSpot) {
                return $blockingSpot;
            }
        }

        return false;
    }

    private function moveHereOrLose($board, $cells)
    {
        foreach ($cells as $cell) {
            $currentPlayerBusyCellsCount = $this->countOthersCells($cell);
            if ($currentPlayerBusyCellsCount == $board->getDimension() - self::MOVE_TO_LOSE) {
                $winningCell = $this->getAvailableSpots($cell)[0];
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
