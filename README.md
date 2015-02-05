## PHP Tic Tac Toe

### Requirements
- `PHP 5x` installed on your machine. You can quickly grab a php vagrant machine [here](http://puphpet.com).
- Install [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

### Install
- `git clone` this repository locally  
- run `composer install`

### Run
- run `php scripts/run.php`. The program will start, good luck with beating the Ai ;)

### Creating a new game
To create a new game simply 
```php
$tictactoe = new TicTacToe();
$winner = $tictactoe
    ->addAi('Al', 'O')
    ->addHuman('Jacopo', 'X')
    ->play();
```
where the order in which you are adding ais or humans will affect the order of turns. The winner name and message will be returned.

## Notes
The AI will never lose. At best you can `Draw`. The Ai will apply the strategy mentioned on [Wikipedia](http://en.wikipedia.org/wiki/Tic-tac-toe#Strategy).

## Dev notes
To run the tests `vendor\bin\phpunit`

The Ai implements a series of rules, which are listed by priority. The most interesting rules are [Fork](https://github.com/jnardiello/Tic-Tac-Toe/blob/master/src/Rules/ForkRule.php) and [BlockOpponentFork](https://github.com/jnardiello/Tic-Tac-Toe/blob/master/src/Rules/BlockOpponentForkRule.php) as the Ai will run a real simulation to understand if it is possible to generate a fork or if the opponent is going to fork anytime soon - and calculate how to stop it.
