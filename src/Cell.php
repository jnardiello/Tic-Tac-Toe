<?php

namespace TicTacToe;

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
