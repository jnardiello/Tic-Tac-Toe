<?php

namespace TicTacToe\Rules;

use TicTacToe\Board;
use TicTacToe\SimulatedBoard;
use TicTacToe\Ai;

class BlockOpponentForkRule implements Rule
{
    public function __construct(\TicTacToe\Ai $al)
    {
        $this->player = $al;
    }

    public function apply(\TicTacToe\Board $board)
    {
        $availableCells = $board->getAvailableSpots();

        foreach ($availableCells as $cell) {
            $opponentOpportunitiesCurrentCellWillGenerate = $this->simulate($cell, $board);

            if (count($opponentOpportunitiesCurrentCellWillGenerate) == 2) {
                return $cell->getCoords();
            }
        }

        return false;
    }

    private function simulate($currentCell, $board)
    {
        $simulatedBoard = new SimulatedBoard($board);
        $simulatedBoard->set($currentCell->getCoords(), $this->getOpponentPlaceholder($board));

        $ai = new Ai();
        $ai->setPlaceholder($this->getOpponentPlaceholder($board))
            ->setBoard($simulatedBoard);
        $winningMovesCoords = $ai->applyWinRule();

        if (count($winningMovesCoords) > 1) {
            return $winningMovesCoords;
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
