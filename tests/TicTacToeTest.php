<?php

namespace TicTacToe;

use \TicTacToe\Player;

class TicTacToeTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateGamePlayerVsAi()
    {
        $player = new Player('John');
        $tictactoe = TicTacToe::againstAi($player);

        $this->assertInstanceOf('\TicTacToe\TicTacToe', $tictactoe);
        $nPlayers = count($tictactoe->getPlayers());
        $this->assertEquals(2, $nPlayers);
    }

    /* public function testBothPlayersWillMoveDurignTurn() */
    /* { */
    /* } */
}
