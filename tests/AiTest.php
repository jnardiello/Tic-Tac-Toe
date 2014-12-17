<?php

namespace TicTacToe;

class AiTest extends \PHPUnit_Framework_TestCase
{
    public function coordinatesProvider()
    {
        return [
            [[ // by row
                [0, 0],
                [0, 1],
            ],
            [0, 2]],
            [[ // by column
                [0, 0],
                [1, 0],
            ],
            [2, 0]],
            [[ // by diagonal
                [0, 0],
                [1, 1],
            ],
            [2, 2]],
        ];
    }

    /**
     * @dataProvider coordinatesProvider
     */
    public function testAiCanApplyWinRuleByRowAndColumnAndDiagonal($fixtures, $expectedCoords)
    {
        $board = new Board();
        foreach ($fixtures as $fixture) {
            $board->set($fixture, 'X');
        }

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($board);

        $nextMoveCoords = $ai->deduct();
        $ai->move($nextMoveCoords);

        $thirdCell = $board->get($expectedCoords);
        $this->assertEquals('X', $thirdCell->getValue());
    }

    public function testNoWinningMoveExists()
    {
        $board = new Board();
        $board->set([0, 0], 'X');

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($board);

        $nextMoveCoords = $ai->deduct();

        $this->assertTrue(!isset($nextMoveCoords));
    }

    public function testBlockRuleCanBeAppliedOverRow()
    {
        $board = new Board();
        $board->set([0, 0], 'O');
        $board->set([0, 1], 'O');

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($board);

        $nextMoveCoords = $ai->deduct();
        $ai->move($nextMoveCoords);

        $thirdCell = $board->get([0, 2]);
        $this->assertEquals('X', $thirdCell->getValue());
    }
}
