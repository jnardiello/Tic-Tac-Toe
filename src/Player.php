<?php

namespace TicTacToe;

class Player extends PlayerBase
{
    public function move()
    {
        echo "\n\n" . $this->board->toString();
        $sanitizer = new Sanitizer();

        do {
            echo "\n\n What is your move {$this->name}?   ";
            $handle = fopen ("php://stdin","r");
            $move = trim(fgets($handle));
            $healthyCoords = $sanitizer->check($move);
        } while(!$healthyCoords || !$this->setOnBoard($healthyCoords));

        return true;
    }
}
