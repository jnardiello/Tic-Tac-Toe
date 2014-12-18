<?php

namespace TicTacToe;

class SimulatedBoard extends Board
{
    public function setVirtual($newCell)
    {
        foreach ($this->board as $key => $cell) {
            if ($cell->getCoords() == $cell->getCoords()) {
                unset($this->board[$key]);
                array_push($this->board, $newCell);
            }
        }
    }
}
