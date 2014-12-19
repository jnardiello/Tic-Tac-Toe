<?php

namespace TicTacToe;

class SimulatedBoardTest extends \PHPUnit_Framework_TestCase
{
    public function testCanGetOpportunities()
    {
        $this->markTestSkipped();
        $board = new Board();
        $board->set([2, 0], 'X');
        $board->set([0, 2], 'X');

        $simulatedBoard = new SimulatedBoard($board);
        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($simulatedBoard);

        $this->assertEquals(2, $simulatedBoard->newOpportunitiesFor([0, 0], $ai));
    }
}
