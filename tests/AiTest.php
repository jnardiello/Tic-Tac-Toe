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

        $winningMovesCoords = $ai->deduct();
        $ai->move($winningMovesCoords[0]);

        $thirdCell = $board->get($expectedCoords);
        $this->assertEquals('X', $thirdCell->getValue());
    }

    /**
     * @dataProvider coordinatesProvider
     */
    public function testBlockRuleCanBeAppliedOverRow($fixtures, $expectedCoords)
    {
        $board = new Board();
        foreach ($fixtures as $fixture) {
            $board->set($fixture, '0');
        }

        $ai = new Ai();
        $ai->setPlaceholder('X')
           ->setBoard($board);

        $nextMoveCoords = $ai->deduct();
        $ai->move($nextMoveCoords);

        $thirdCell = $board->get($expectedCoords);
        $this->assertEquals('X', $thirdCell->getValue());
    }

    public function testAiCanForkAfterRunningBoardSimulation()
    {
        $board = new Board();
        $board->set([0, 2], 'O');
        $board->set([2, 1], 'O');
        $board->set([2, 0], 'X');
        $board->set([1, 1], 'X');

        $ai = new Ai();
        $ai->setPlaceholder('X')
           ->setBoard($board);

        $nextMoveCoords = $ai->deduct();
        $expectedCoordsRange = [
            [0, 0],
            [1, 0],
        ];
        $this->assertTrue(in_array($nextMoveCoords, $expectedCoordsRange));
    }

    public function testAiCanBlockOpponentForkAfterRunningBoardSimulation()
    {
        $board = new Board();
        $board->set([0, 2], 'O');
        $board->set([1, 0], 'O');
        $board->set([1, 1], 'X');

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($board);

        $nextMoveCoords = $ai->deduct();
        $expectedCoords = [0, 0];

        $this->assertEquals($expectedCoords, $nextMoveCoords);
    }

    public function testAiCanMoveToTheCenter()
    {
        $board = new Board();

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($board);

        $nextMoveCoords = $ai->deduct();
        $expectedCoords = [1, 1];

        $this->assertEquals($expectedCoords, $nextMoveCoords);
    }

    public function testOpponentIsInOppositeCorner()
    {
        $board = new Board();
        $board->set([0, 0], 'O');
        $board->set([1, 1], 'X');

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($board);

        $nextMoveCoords = $ai->deduct();
        $expectedCoords = [2, 2];

        $this->assertEquals($expectedCoords, $nextMoveCoords);
    }

    public function testEmptySide()
    {
        $board = new Board();
        $board->set([0, 0], 'O');
        $board->set([0, 1], 'X');
        $board->set([0, 2], 'O');
        $board->set([1, 1], 'X');
        $board->set([1, 2], 'O');
        $board->set([2, 0], 'X');
        $board->set([2, 1], 'O');
        $board->set([2, 2], 'X');

        $ai = new Ai();
        $ai->setPlaceholder('X')
            ->setBoard($board);

        $nextMoveCoords = $ai->deduct();
        $expectedCoords = [1, 0];

        $this->assertEquals($expectedCoords, $nextMoveCoords);
    }
}
