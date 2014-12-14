<?php

namespace TicTacToe;

class AiTest extends \PHPUnit_Framework_TestCase
{
    public function testAiCanWinIfOnePlaceholderIsMissingOnSameRow()
    {
        $this->markTestIncomplete();
        $board = new Board();
        $board->set([0, 0], 'X');
        $board->set([0, 1], 'X');

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($board);

        $ai->deduct();

        $expectedBoard = [
            ['X', 'X', 'X'],
            ['', '', ''],
            ['', '', ''],
        ];
        $this->assertEquals($expectedBoard, $board->toArray());
    }
}
