<?php

namespace TicTacToe;

class AiTest extends \PHPUnit_Framework_TestCase
{
    const AI_PLACEHOLDER = 'X';
    const OPPONENT_PLACEHOLDER = 'O';

    public function setUp()
    {
        $this->board = new Board();
        $this->ai = new Ai();

        $this->ai->setPlaceholder('X')
            ->setBoard($this->board);
    }

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
        $this->assertLineOfTwo($fixtures, $expectedCoords, self::AI_PLACEHOLDER);
    }

    /**
     * @dataProvider coordinatesProvider
     */
    public function testBlockRuleCanBeAppliedOverRow($fixtures, $expectedCoords)
    {
        $this->assertLineOfTwo($fixtures, $expectedCoords, self::OPPONENT_PLACEHOLDER);
    }

    public function testAiCanForkAfterRunningBoardSimulation()
    {
        $fixtures = [
            [[0, 2], 'O'],
            [[2, 1], 'O'],
            [[2, 0], 'X'],
            [[1, 1], 'X'],
        ];
        $this->fillBoard($fixtures);

        $nextMoveCoords = $this->ai->deduct();
        $expectedCoordsRange = [
            [0, 0],
            [1, 0],
        ];
        $this->assertTrue(in_array($nextMoveCoords, $expectedCoordsRange));
    }

    public function testAiCanMoveToTheCenter()
    {
        $emptyBoard = [];
        $expectedCoords = [1, 1];

        $this->assertAiWillDeductMove($emptyBoard, $expectedCoords);
    }

    public function testAiWillChoseCornerOverSide()
    {
        $fixtures = [
            [[1, 1], 'X'],
        ];
        $expectedCoords = [0, 0];

        $this->assertAiWillDeductMove($fixtures, $expectedCoords);
    }

    public function testEmptySide()
    {
        $fixtures = [
            [[0, 0], 'O'],
            [[0, 1], 'X'],
            [[0, 2], 'O'],
            [[1, 1], 'X'],
            [[1, 2], 'O'],
            [[2, 0], 'X'],
            [[2, 1], 'O'],
            [[2, 2], 'X'],
        ];
        $expectedCoords = [1, 0];

        $this->assertAiWillDeductMove($fixtures, $expectedCoords);
    }

    public function testAiWillForceDefenseWithoutCreatingOpponentFork()
    {
        $fixtures = [
            [[0, 2], 'O'],
            [[2, 0], 'O'],
            [[1, 1], 'X'],
        ];
        $expectedCoords = [0, 1];

        $this->assertAiWillDeductMove($fixtures, $expectedCoords);
    }

    public function testAiWillBlockOpponentFork()
    {
        $fixtures = [
            [[0, 0], 'O'],
            [[2, 1], 'O'],
            [[1, 1], 'X'],
        ];
        $expectedCoords = [1, 0];

        $this->assertAiWillDeductMove($fixtures, $expectedCoords);
    }

    private function assertLineOfTwo($fixtures, $expectedCoords)
    {
        foreach ($fixtures as $fixture) {
            $this->board->set($fixture, 'X');
        }

        $nextMoveCoords = $this->ai->deduct();
        $this->ai->setOnBoard($nextMoveCoords);

        $thirdCell = $this->board->get($expectedCoords);
        $this->assertEquals('X', $thirdCell->getValue());
    }

    private function fillBoard($fixtures)
    {
        foreach ($fixtures as $fixture) {
            $coords = $fixture[0];
            $placeholder = $fixture[1];

            $this->board->set($coords, $placeholder);
        }
    }

    private function assertAiWillDeductMove($fixtures, $expectedResult)
    {
        $this->fillBoard($fixtures);

        $nextMoveCoords = $this->ai->deduct();

        $this->assertEquals($expectedResult, $nextMoveCoords);
    }
}
