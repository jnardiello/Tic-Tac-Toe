<?php

namespace TicTacToe;

class SimulatedBoardTest extends \PHPUnit_Framework_TestCase
{
    public function testCanGenerateSimulatedBoardFromBoardAvoidingReference()
    {
        $board = new Board();
        $simulatedBoard = new SimulatedBoard($board);
        $simulatedBoard->set([0, 0], 'X');

        $boardValue = $board->get([0, 0]);

        $this->assertEquals('', $boardValue->getValue());
    }
}
