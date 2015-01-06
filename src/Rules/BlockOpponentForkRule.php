<?php

namespace TicTacToe\Rules;

use TicTacToe\Board;
use TicTacToe\SimulatedBoard;
use TicTacToe\Ai;

class BlockOpponentForkRule extends ForkBaseRule implements Rule
{
    public function __construct(\TicTacToe\Ai $al)
    {
        $this->player = $al;
    }

    public function apply(\TicTacToe\Board $board)
    {
        $availableCells = $board->getAvailableSpots();

        foreach ($availableCells as $cell) {
            $opponentOpportunities = $this->simulate(
                $cell, 
                $board, 
                $this->getOpponentPlaceholder($board));

            if (count($opponentOpportunities) == 2 && $this->noMoreOpponentForks($cell, $board)) {
                return $cell->getCoords();
            }

            if (count($opponentOpportunities) == 2 && !$this->noMoreOpponentForks($cell, $board)) {
                return $this->forceOpponentDefense($board);
            }
        }

        return false;
    }

    private function forceOpponentDefense($board)
    {
        $availableSpots = $board->getAvailableSpots();

        foreach ($availableSpots as $cell) {
            $currentRow = $board->row($cell->getCoords());
            $currentColumn = $board->column($cell->getCoords());
            $currentDiagonal = $board->diagonal($cell->getCoords());

            if ($this->countEmptySpots($currentRow) == 2) {
                return $cell->getCoords();
            }

            if ($this->countEmptySpots($currentColumn) == 2) {
                return $cell->getCoords();
            }

            if ($this->countEmptySpots($currentDiagonal) == 2) {
                return $cell->getCoords();
            }
        }
    }

    private function countEmptySpots($cells)
    {
        $counter = 0;
        foreach ($cells as $cell) {
            if ($cell->getValue() == '') {
                $counter++;
            }
        }

        return $counter;
    }

    private function noMoreOpponentForks($chosenCell, $board) 
    {
        $simulatedBoard = new SimulatedBoard($board);
        $simulatedBoard->set($chosenCell->getCoords(), $this->player->getPlaceholder());

        $availableCells = $simulatedBoard->getAvailableSpots();
        foreach ($availableCells as $cell) {
            $opponentOpportunities = $this->simulate(
                $cell,
                $simulatedBoard,
                $this->getOpponentPlaceholder($board)
            );

            if ($opponentOpportunities > 1) {
                return false;
            }
        }

        return true;
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
