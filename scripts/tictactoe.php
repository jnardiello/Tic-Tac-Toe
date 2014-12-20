<?php

namespace TicTacToe;

require_once(__DIR__ . '/../bootstrap.php');

echo "Hello stranger, what's your name?       ";
$handle = fopen ("php://stdin","r");
$playerName = trim(fgets($handle));

$player = new Player($playerName);
$tictactoe = TicTacToe::againstAi($player);
$board = $tictactoe->getBoard();

do {
    echo "\n\n" . $board->toString();
    echo "\n\n What is your move {$playerName}?   ";
    $handle = fopen ("php://stdin","r");
    $move = trim(fgets($handle));

    if (!$tictactoe->moveAgainstAi($move)) {
        echo "Invalid move my friend! press enter and try again";
        fgets($handle);
        continue;
    }
} while (!$tictactoe->checkForWinner());

$winner = $tictactoe->checkForWinner();

if ($winner == $playerName) {
    echo "\n\nYou Won!\n\n";
    return;
}

if ($winner == 'Draw') {
    echo "\n\nWell done! Draw!\n\n";
    return;
}

echo "\n\nYou have lost!\n\n";
