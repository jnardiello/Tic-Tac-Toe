<?php

namespace TicTacToe;

use \TicTacToe\Player;

class TicTacToeTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->player = new Player('John');
        $this->tictactoe = TicTacToe::againstAi($this->player);
    }

    public function testCanCreateGamePlayerVsAi()
    {
        $this->assertInstanceOf('\TicTacToe\TicTacToe', $this->tictactoe);
        $nPlayers = count($this->tictactoe->getPlayers());
        $this->assertEquals(2, $nPlayers);
    }

    public function testBothPlayersWillMoveDurignTurn()
    {
        $humanCoords = 'A1';
        $this->tictactoe->moveAgainstAi($humanCoords);
        
        $board = $this->tictactoe->getBoard();
        $expectedBoard = [
            ['X', '', ''],
            ['', 'O', ''],
            ['', '', ''],
        ];

        $this->assertSame($expectedBoard, $board->toArray());
    }

    public function testPlayerOrAiHaveWon()
    {
        $board = $this->tictactoe->getBoard();
        $board->set([0, 0], 'X');
        $board->set([1, 1], 'X');
        $board->set([2, 2], 'X');

        $this->assertEquals(
            'John',
            $this->tictactoe->checkForWinner()
        );
    }

    public function testPlayerAndAiDraw()
    {
        $board = $this->tictactoe->getBoard();
        $board->set([0, 0], 'X');
        $board->set([0, 1], 'O');
        $board->set([0, 2], 'X');
        $board->set([1, 1], 'O');
        $board->set([1, 0], 'X');
        $board->set([1, 2], 'O');
        $board->set([2, 0], 'O');
        $board->set([2, 1], 'X');
        $board->set([2, 2], 'X');

        $this->assertEquals(
            'Draw',
            $this->tictactoe->checkForWinner()
        );
    }

    public function testNobodyWonYet()
    {
        $this->assertFalse($this->tictactoe->checkForWinner());
    }

    public function testNobodyYetWon()
    {
        $board = $this->tictactoe->getBoard();
        $this->assertFalse($this->tictactoe->checkForWinner());
    }
}
