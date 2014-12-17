<?php

namespace TicTacToe\Rules;

class WinRule implements Rule
{
    const MOVE_TO_WIN = 1;

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
            $winningSpot = $this->getWinningSpot($board, $cells);
            if ($winningSpot) {
                return $winningSpot;
            }
        }

        return false;
    }

    private function getWinningSpot($board, $cells)
    {
        foreach ($cells as $cell) {
            $currentPlayerBusyCellsCount = $this->countMyCells($cell);
            if ($currentPlayerBusyCellsCount == $board->getDimension() - self::MOVE_TO_WIN) {
                $availableSpots = $this->getAvailableSpots($cell);
                if (!empty($availableSpots)) {
                    $winningCell = $this->getAvailableSpots($cell)[0];
                    return $winningCell->getCoords();
                }
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
