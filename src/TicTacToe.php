<?php

namespace TicTacToe;

use TicTacToe\Board;

class TicTacToe
{
    private $board;
    private $players = [];

    private function __construct($firstPlayer, $secondPlayer, $board)
    {
        $this->board = $board;
        $this->players[] = $firstPlayer;
        $this->players[] = $secondPlayer;
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public static function againstAi(\TicTacToe\Player $player)
    {
        $board = new Board();

        $player->setPlaceholder('X')
            ->setBoard($board);

        $ai = new Ai();
        $ai->setPlaceholder('O')
           ->setBoard($board);

        return new TicTacToe($player, $ai, $board);
    }
}
