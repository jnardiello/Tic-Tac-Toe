<?php

namespace TicTacToe;

class BoardTest extends \PHPUnit_Framework_TestCase
{
    public function testCanSetACell()
    {
        $player = new Player('John');
        $player->setPlaceholder('X');

        $board = new Board();
        $board->set([0, 0], $player);

        $expectedGrid = [
            ['X', '', ''],
            ['', '', ''],
            ['', '', ''],
        ];

        $this->assertEquals($expectedGrid, $board->toArray());
    }

    public function testCanDisplayBoardAsString()
    {
        $john = new Player('John');
        $john->setPlaceholder('X');

        $al = new Player('Al');
        $al->setPlaceholder('O');

        $board = new Board();
        $board->set([0, 0], $john);
        $board->set([1, 1], $al);
        $board->set([1, 2], $al);

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

        $this->assertEquals($expectedString, $board->toString());
    }
}
