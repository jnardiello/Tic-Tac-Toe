<?php

namespace TicTacToe;

class BoardTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->board = new Board();
    }

    public function testCanSetACell()
    {
        $this->board->set([0, 0], 'X');
        $expectedGrid = [
            ['X', '', ''],
            ['', '', ''],
            ['', '', ''],
        ];

        $this->assertEquals($expectedGrid, $this->board->toArray());
    }

    public function testCanDisplayBoardAsString()
    {
        $this->board->set([0, 0], 'X');
        $this->board->set([1, 1], 'O');
        $this->board->set([1, 2], 'O');
        $expectedString = "\n" .
            "\n      1     2     3  " . 
            "\n                     " . 
            "\n         |     |     " . 
            "\n      X  |     |     " . "      A" .
            "\n         |     |     " . 
            "\n    -----------------" .
            "\n         |     |     " .
            "\n         |  O  |  O  " . "      B" .
            "\n         |     |     " .
            "\n    -----------------" .
            "\n         |     |     " . 
            "\n         |     |     " . "      C" .
            "\n         |     |     \n\n";

        $this->assertEquals($expectedString, $this->board->toString());
    }

    public function testCanRetrieveRows()
    {
        $this->board->set([0, 0], 'X');
        $this->board->set([1, 1], 'O');
        $this->board->set([1, 2], 'O');

        $rows = $this->board->rows();
        $expectedRows = [
            ['X', '', ''],
            ['', 'O', 'O'],
            ['', '', '']
        ];

        $result = $this->cellToArray($rows);
        
        $this->assertEquals($expectedRows, $result);
    }

    public function testCanRetrieveColumns()
    {
        $this->board->set([0, 0], 'X');
        $this->board->set([1, 1], 'O');
        $this->board->set([1, 2], 'O');

        $columns = $this->board->columns();
        $expectedColumns = [
            ['X', '', ''],
            ['', 'O', ''],
            ['', 'O', ''],
        ];

        $result = $this->cellToArray($columns);

        $this->assertEquals($expectedColumns, $result);
    }

    public function testCanRetrieveDiagonals()
    {
        $this->board->set([0, 0], 'X');
        $this->board->set([1, 1], 'O');
        $this->board->set([1, 2], 'O');

        $diagonals = $this->board->diagonals();
        $expectedRows = [
            ['X', 'O', ''],
            ['', 'O', ''],
        ];

        $result = $this->cellToArray($diagonals);
        
        $this->assertEquals($expectedRows, $result);
    }

    public function testCanGetCurrentRowForCell()
    {
        $row = $this->board->row([0, 0]);
        $expectedCellsCoords = [
            [0, 0],
            [0, 1],
            [0, 2],
        ];
        $actualCellsCoords = [];

        foreach ($row as $cell) {
            $actualCellsCoords[] = $cell->getCoords();
        }

        $this->assertSame($expectedCellsCoords, $actualCellsCoords);
    }

    public function testCanGetAvailableSpots()
    {
        $this->board->set([0, 0], 'X');
        $this->board->set([0, 1], 'X');
        $this->board->set([0, 2], 'X');
        $this->board->set([1, 0], 'X');
        $this->board->set([1, 1], 'X');
        $this->board->set([1, 2], 'X');
        $this->board->set([2, 0], 'X');
        $this->board->set([2, 1], 'X');

        $freeCells = $this->board->getAvailableSpots();

        $this->assertEquals(1, count($freeCells));
        $this->assertEquals([2, 2], $freeCells[0]->getCoords());
    }

    private function cellToArray(array $cellsArray)
    {
        $result = [];
        foreach ($cellsArray as $array) {
            $currentColumnToArray = [];
            foreach ($array as $cell) {
                $currentColumnToArray[] = $cell->getValue();
            }
            $result[] = $currentColumnToArray;
        }

        return $result;
    }
}
