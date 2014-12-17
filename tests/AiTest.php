<?php

namespace TicTacToe;

class AiTest extends \PHPUnit_Framework_TestCase
{
    public function testAiCanApplyWinRuleOnASingleRow()
    {
        $board = new Board();
        $board->set([0, 0], 'X');
        $board->set([0, 1], 'X');

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($board);

        $nextMoveCoords = $ai->deduct();
        $ai->move($nextMoveCoords);

        $thirdCell = $board->get([0, 2]);
        $this->assertEquals('X', $thirdCell->getValue());
    }

    public function testAiCanApplyWinRuleOnSecondRow()
    {
        $this->markTestIncomplete();
        $board = new Board();
        $board->set([1, 1], 'X');
        $board->set([1, 2], 'X');

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($board);

        $nextMoveCoords = $ai->deduct();
        $ai->move($nextMoveCoords);

        $firstCell = $board->get([1, 0]);
        $this->assertEquals('X', $firstCell->getValue());
    }
}
