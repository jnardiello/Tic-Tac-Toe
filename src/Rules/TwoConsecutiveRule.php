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
        $candidateSpots = $this->getCandidateSpots($board);

        return false;
    }

    private function getCandidateSpots($board)
    {
        $availableSpots = $board->getAvailableSpots();
        $candidateSpots = [];

        foreach ($availableSpots as $spot) {
            if ($this->isCandidate($board, $spot)) {
                $candidateSpots[] = $spot;
            }
        }

        return $candidateSpots;
    }

    private function isCandidate($board, $spot)
    {
        $coords['row'] = $board->row($spot->getCoords());
        $coords['column'] = $board->column($spot->getCoords());
        $coords['diagonal'] = $board->diagonal($spot->getCoords());

        foreach ($coords as $cellsCollection) {
            if (!empty($cellsCollection)) {
                $counter = $this->countEmptyAndAi($cellsCollection);
                if ($counter['empty'] == 2 && $counter['ai'] == 1) {
                    return true;
                }
            }
        }
    }

    private function countEmptyAndAi($cells)
    {
        $emptyCells = 0;
        $aiCells = 0;

        foreach ($cells as $cell) {
            if ($cell->getValue() == '') {
                $emptyCells++;
            }

            if ($cell->getValue() == $this->player->getPlaceholder()) {
                $aiCells++;
            }
        }

        return [
            'empty' => $emptyCells,
            'ai' => $aiCells,
        ];
    }
}
