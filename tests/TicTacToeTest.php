<?php

namespace TicTacToe;

class TicTacToeTest extends \PHPUnit_Framework_TestCase
{
    /*
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

    public function testBothPlayersWillMoveDuringTurn()
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

    public function testAiWontMoveIfPlayerWins()
    {
        $board = $this->tictactoe->getBoard();
        $board->set([2, 2], 'X');
        $board->set([1, 1], 'O');
        $board->set([0, 0], 'X');
        $board->set([0, 2], 'O');
        $board->set([1, 0], 'O');
        $board->set([2, 0], 'X');
        
        $this->tictactoe->moveAgainstAi('C2');
        $this->assertEquals('John', $this->tictactoe->checkForWinner());
    }

    public function testNobodyWonYet()
    {
        $this->assertFalse($this->tictactoe->checkForWinner());
    }

    public function testCantMoveToNonExistingPosition()
    {
        $nonExistingCoords = 'D400';

        $this->assertFalse($this->tictactoe->moveAgainstAi($nonExistingCoords));
    }
    */

    public function testCanAddASinglePlayerToTictactoe()
    {
        $ticTacToe = new TicTacToe();

        $ticTacToe
            ->addPlayer('Jhon', 'X');
//            ->addAi()
//            ->play();

        $this->assertEquals(1, count($ticTacToe->getPlayers()));
    }

    public function testCanAddTwoPlayersToTictactoe()
    {
        $ticTacToe = new TicTacToe();

        $ticTacToe
            ->addPlayer('Jhon', 'X')
            ->addPlayer('Jack', 'O');

        $this->assertEquals(2, count($ticTacToe->getPlayers()));
    }

    public function testWontAddNewPlayerWithDuplicatePlaceholder()
    {
        $ticTacToe = new TicTacToe();
        $ticTacToe
            ->addPlayer('Jhon', 'X')
            ->addPlayer('Jack', 'X');

        $this->expectOutputString("Can't add two players with the same placeholder");
    }

    public function testCanCreateGameWithPlayerAndAi()
    {
        $ticTacToe = new TicTacToe();

        $ticTacToe
            ->addPlayer('Jhon', 'X')
            ->addAi('Al', 'O');

        $this->assertEquals(1, count($ticTacToe->getPlayers()));
        $this->assertEquals(1, count($ticTacToe->getAi()));
    }

    public function testCanAddTwoAisToGame()
    {
        $ticTacToe = new TicTacToe();

        $ticTacToe
            ->addAi('Al', 'O')
            ->addAi('Al', 'X');

        $this->assertEquals(2, count($ticTacToe->getAi()));
    }
}
