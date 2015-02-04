<?php

namespace TicTacToe;

require_once(__DIR__ . '/../bootstrap.php');

$tictactoe = new TicTacToe();
$winner = $tictactoe
    ->addAi('Al', 'O')
    ->addHuman('Jacopo', 'X')
    ->play();

echo $winner;