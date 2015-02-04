<?php

namespace TicTacToe;

class Player extends PlayerBase
{
    public function move()
    {
        $sanitizer = new Sanitizer();
        echo "\n\n What is your move {$playerName}?   ";
        $handle = fopen ("php://stdin","r");
        $move = trim(fgets($handle));
        $healthyCoords = $sanitizer->check($move);

        if ( !$healthyCoords || !$this->setOnBoard($healthyCoords)) {
            return false;
        }

        return true;
    }
}
