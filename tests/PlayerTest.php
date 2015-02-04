<?php

namespace TicTacToe;

class PlayerTest extends \PHPUnit_Framework_TestCase
{
    public function testPlayerCanMoveOverBoard()
    {
        $board = new Board();
        $john = new Player('John');
        $john->setPlaceholder('X')
            ->setBoard($board);

        $al = new Player('Al');
        $al->setPlaceholder('O')
            ->setBoard($board);

        $john->setOnBoard('A1');
        $al->setOnBoard('B1');
        $al->setOnBoard('B2');
        $expectedGrid = [
            ['X', '', ''],
            ['O', 'O', ''],
            ['', '', ''],
        ];

        $this->assertEquals($expectedGrid, $board->toArray());
    }

    public function testPlayerCantMoveOnBusySpot()
    {
        $board = new Board();
        $john = new Player('John');
        $john->setPlaceholder('X')
            ->setBoard($board);

        $al = new Player('Al');
        $al->setPlaceholder('O')
            ->setBoard($board);

        $john->setOnBoard('A1');
        $al->setOnBoard('B1');
        $al->setOnBoard('B2');

        $this->assertFalse($john->setOnBoard('B1'));
    }
}
