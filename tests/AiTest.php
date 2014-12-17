<?php

namespace TicTacToe;

class AiTest extends \PHPUnit_Framework_TestCase
{
    public function testAiCanApplyWinRuleByRow()
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

    public function testAiCanApplyWinRuleByColumn()
    {
        $board = new Board();
        $board->set([0, 0], 'X');
        $board->set([1, 0], 'X');

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($board);

        $nextMoveCoords = $ai->deduct();
        $ai->move($nextMoveCoords);

        $firstCell = $board->get([2, 0]);
        $this->assertEquals('X', $firstCell->getValue());
    }

    public function testAiCanApplyWinRuleByDiagonal()
    {
        $board = new Board();
        $board->set([0, 0], 'X');
        $board->set([1, 1], 'X');

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($board);

        $nextMoveCoords = $ai->deduct();
        $ai->move($nextMoveCoords);

        $firstCell = $board->get([2, 2]);
        $this->assertEquals('X', $firstCell->getValue());
    }

    public function testNoWinningMoveExists()
    {
        $board = new Board();
        $board->set([0, 0], 'X');

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($board);

        $nextMoveCoords = $ai->deduct();

        $this->assertFalse($nextMoveCoords);
    }
}
