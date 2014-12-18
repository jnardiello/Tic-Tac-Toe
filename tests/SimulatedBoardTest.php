<?php

namespace TicTacToe;

class SimulatedBoardTest extends \PHPUnit_Framework_TestCase
{
    public function testCanSetCellFromCellClass()
    {
        $cell = new Cell(0, 0, 'X');
        $simulatedBoard = new SimulatedBoard();

        $simulatedBoard->setVirtual($cell);
        $simulatedBoardCell = $simulatedBoard->get([0, 0]);

        $this->assertEquals('X', $simulatedBoardCell->getValue());
    }
}
