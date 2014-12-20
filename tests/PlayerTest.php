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

        $john->move('A1');
        $al->move('B1');
        $al->move('B2');
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

        $john->move('A1');
        $al->move('B1');
        $al->move('B2');
        $expectedGrid = [
            ['X', '', ''],
            ['O', 'O', ''],
            ['', '', ''],
        ];

        $this->assertFalse($john->move('B1'));
    }
}
