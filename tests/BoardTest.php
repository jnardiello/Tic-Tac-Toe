<?php

class BoardTest extends \PHPUnit_Framework_TestCase
{
    public function testCanSetACell()
    {
        $player = new Player('John');
        $player->setPlaceholder('X');

        $board = new Board();
        $board->set([0, 0], $player);

        $expectedGrid = [
            ['X', '', ''],
            ['', '', ''],
            ['', '', ''],
        ];

        $this->assertEquals($expectedGrid, $board->current());
    }
}

class Board
{
    public function __construct()
    {
        $this->board = [
            new Cell(0, 0, ''),
            new Cell(0, 1, ''),
            new Cell(0, 2, ''),
            new Cell(1, 0, ''),
            new Cell(1, 1, ''),
            new Cell(1, 2, ''),
            new Cell(2, 0, ''),
            new Cell(2, 1, ''),
            new Cell(2, 2, ''),
        ];
    }

    public function set($coords, $player)
    {
        $cell = $this->cellLookup($coords);
        $cell->setValue($player->getPlaceholder());
    }

    private function cellLookup($coords)
    {
        foreach ($this->board as $cell) {
            if ($cell->getCoords() === $coords) {
                return $cell;
            }
        }
    }

    public function current()
    {
        $result = [];

        foreach ($this->board as $cell) {
            $coords = $cell->getCoords();
            $result[$coords[0]][$coords[1]] = $cell->getValue();
        }

        return $result;
    }
}

class Cell
{
    private $x;
    private $y;
    private $value;

    public function __construct($x, $y, $value)
    {
        $this->x = $x;
        $this->y = $y;
        $this->value = $value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getCoords()
    {
        return [
            $this->x,
            $this->y,
        ];
    }

    public function getValue()
    {
        return $this->value;
    }
}

class Player
{
    private $name;
    private $placeholder;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;
    }

    public function getPlaceholder()
    {
        return $this->placeholder;
    }
}
