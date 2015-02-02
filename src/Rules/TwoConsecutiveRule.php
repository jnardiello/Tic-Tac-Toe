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

        foreach ($candidateSpots as $spot) {
            if (!$this->detectOpponentFork($spot, $board)) {
                return $spot->getCoords();
            }
        }

        return false;
    }

    private function detectOpponentFork($spot, $board)
    {
        $complementatyFreeSpot = $this->getFreeSpot($spot, $board);
        $simulatedBoard = new SimulatedBoard($board);
        $simulatedBoard->set($spot->getCoords(), $this->getOpponentPlaceholder($board));

        $opponentWinningMoves = $this->simulate($complementatyFreeSpot, $simulatedBoard, $this->getOpponentPlaceholder($board));
        if (is_array($opponentWinningMoves)) {
            return true;
        }

        return false;
    }

    private function getFreeSpot($spot, $board)
    {
        $coords['row'] = $board->row($spot->getCoords());
        $coords['column'] = $board->column($spot->getCoords());
        $coords['diagonal'] = $board->diagonal($spot->getCoords());

        foreach ($coords as $coord) {
            $result = $this->getFreeSpotFromCollection($coord);
            if ($result) {
                return $result;
            }
        }
    }

    private function getFreeSpotFromCollection($cells)
    {
        foreach ($cells as $cell) {
           if ($cell->getValue() == '')  {
               return $cell;
           }
        }
    }

    private function getOpponentPlaceholder($board)
    {
        foreach ($board->board as $cell) {
            if ($cell->getValue() != $this->player->getPlaceholder() && $cell->getValue() != '') {
                return $cell->getValue();
            }
        }

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
