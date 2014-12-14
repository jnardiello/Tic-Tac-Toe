<?php

namespace TicTacToe;

class BoardTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->john = new Player('John');
        $this->john->setPlaceholder('X');

        $this->al = new Player('Al');
        $this->al->setPlaceholder('O');

        $this->board = new Board();

    }

    public function testCanSetACell()
    {
        $this->board->set([0, 0], $this->john);
        $expectedGrid = [
            ['X', '', ''],
            ['', '', ''],
            ['', '', ''],
        ];

        $this->assertEquals($expectedGrid, $this->board->toArray());
    }

    public function testCanDisplayBoardAsString()
    {
        $this->board->set([0, 0], $this->john);
        $this->board->set([1, 1], $this->al);
        $this->board->set([1, 2], $this->al);
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
}
