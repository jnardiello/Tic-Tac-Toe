<?php

namespace TicTacToe;

use TicTacToe\Rules\WinRule;

class SimulatedBoard extends Board
{
    public function __construct(\TicTacToe\Board $board)
    {
        $this->board = $board->board;
    }

    public function simulate()
    {

    }
    /* public function newOpportunitiesFor($coords, $player) */
    /* { */
    /*     /1* $this->set($coords, $player->getPlaceholder()); *1/ */
    /*     $opportunities = 0; */

    /*     $currentRow = $this->row($coords); */
    /*     $currentColumn = $this->column($coords); */
    /*     $currentDiagonal = $this->diagonal($coords); */

    /*     if ( */
    /*         $this->countCellValueOccurrences($currentRow, $player->getPlaceholder()) > 0 */
    /*         && */
    /*         $this->countCellValueOccurrences($currentRow, '') */
    /*     ) { */
    /*         $opportunities++; */
    /*     } */
    /*     if ( */
    /*         $this->countCellValueOccurrences($currentColumn, $player->getPlaceholder()) > 0 */
    /*         && */
    /*         $this->countCellValueOccurrences($currentRow, '') */
    /*     ) { */
    /*         $opportunities++; */
    /*     } */
    /*     if ( */
    /*         $this->countCellValueOccurrences($currentDiagonal, $player->getPlaceholder()) > 0 */
    /*         && */
    /*         $this->countCellValueOccurrences($currentRow, '') */
    /*     ) { */
    /*         $opportunities++; */
    /*     } */

    /*     return $opportunities; */
    /* } */

    /* private function countCellValueOccurrences(array $cells, $cellValue) */
    /* { */
    /*     $counter = 0; */
    /*     foreach ($cells as $cell) { */
    /*         if ($cell->getValue() == $cellValue) { */
    /*             $counter++; */
    /*         } */
    /*     } */

    /*     return $counter; */
    /* } */
}
