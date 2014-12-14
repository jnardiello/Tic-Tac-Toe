<?php

namespace TicTacToe;

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
        return $this;
    }

    public function setBoard($board)
    {
        $this->board = $board;
        return $this;
    }

    public function move($coordString)
    {
        $rawCoords = str_split($coordString);
        $coordMapper = $this->getCoordinatesMapper();

        $coords = [
            $coordMapper[$rawCoords[0]],
            $rawCoords[1] - 1
        ];

        $this->board->set($coords, $this->placeholder);
    }

    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    private function getCoordinatesMapper()
    {
        return [
            'A' => 0,
            'B' => 1,
            'C' => 2,
        ];
    }
}
