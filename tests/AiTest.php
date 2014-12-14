<?php

namespace TicTacToe;

class AiTest extends \PHPUnit_Framework_TestCase
{
    public function testAiCanWinIfOnePlaceholderIsMissingOnSameRow()
    {
        $board = new Board();
        $board->set([0, 0], 'X');
        $board->set([0, 1], 'X');

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($board);

        $nextMoveCoords = $ai->deduct();

        $this->assertEquals('A3', $nextMoveCoords);
    }
}
