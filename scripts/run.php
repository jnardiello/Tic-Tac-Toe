<?php

namespace TicTacToe;

require_once(__DIR__ . '/../bootstrap.php');

$tictactoe = new TicTacToe();
$winner = $tictactoe
    ->addHuman('Jacopo', 'X')
    ->addAi('Al', 'O')
    ->play();

echo "The winner is: " . $winner;
