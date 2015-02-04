<?php

namespace TicTacToe;

class ArbiterTest extends \PHPUnit_Framework_TestCase
{
    public function testArbiterCanTellWinner()
    {
        $ticTacToe = new TicTacToe();
        $ticTacToe
            ->addHuman('John', 'X')
            ->addAi('Al', 'O');

        $board = $ticTacToe->getBoard();
        $board->set([0, 0], 'X');
        $board->set([1, 0], 'X');
        $board->set([2, 0], 'X');

        $arbiter = new Arbiter($ticTacToe);
        $expectedWinner = [
            'status' => 'winner',
            'winner' => 'John',
        ];

        $this->assertEquals($expectedWinner, $arbiter->checkForWinner());
    }

    public function testArbiterWillReturnFalseWhenNoWinnerIsFound()
    {
        $ticTacToe = new TicTacToe();
        $ticTacToe
            ->addHuman('John', 'X')
            ->addAi('Al', 'O');

        $board = $ticTacToe->getBoard();
        $board->set([0, 0], 'X');
        $board->set([1, 0], 'X');

        $arbiter = new Arbiter($ticTacToe);

        $this->assertFalse($arbiter->checkForWinner());
    }
}