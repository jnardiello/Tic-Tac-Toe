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

            // We have a possible fork and we can stop it
            if (count($opponentOpportunities) == 2 && $this->noMoreOpponentForks($cell, $board)) {
                var_dump('case 1');
                return $cell->getCoords();
            }

            // Sometimes we can't stop a fork, so we push the opponent to defend
            if (count($opponentOpportunities) == 2 && !$this->noMoreOpponentForks($cell, $board)) {
                var_dump('case 2');
                return $this->forceOpponentDefense($board);
            }
        }

        return false;
    }

    private function forceOpponentDefense($board)
    {
        $availableSpots = $board->getAvailableSpots();

        foreach ($availableSpots as $cell) {
            $current['row'] = $board->row($cell->getCoords());
            $current['column'] = $board->column($cell->getCoords());
            $current['diagonal'] = $board->diagonal($cell->getCoords());

            foreach ($current as $groupOfCells) {
                if ($this->countEmptySpots($groupOfCells) == 2) {
                    return $cell->getCoords();
                }
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
