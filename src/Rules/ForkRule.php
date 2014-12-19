<?php

namespace TicTacToe\Rules;

use TicTacToe\SimulatedBoard;

class ForkRule implements Rule
{
    public function __construct(\TicTacToe\Ai $al)
    {
        $this->player = $al;
    }

    public function apply(\TicTacToe\Board $board)
    {
        /* $availableCells = $board->getAvailableSpots(); */

        /* foreach ($availableCells as $cell) { */
        /*     $opportunitiesTheNewCellWillGenerate = $this->simulate($cell); */

        /*     if ($opportunitiesTheNewCellWillGenerate == 2) { */
        /*         return $cell->getCoords(); */
        /*     } */
        /* } */
        return true;
    }

    private function simulate($cell)
    {
        /* $simulatedBoard = new SimulatedBoard($board); */
        /* $simulatedBoard->set($cell); */

        /* return $simulatedBoard->newOpportunitiesFor($this->player); */
    }
}
