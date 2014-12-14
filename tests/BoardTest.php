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
        
        $this->assertEquals($expectedRows, $rows);
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

        $this->assertEquals($expectedColumns, $columns);
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
        
        $this->assertEquals($expectedRows, $diagonals);
    }
}
