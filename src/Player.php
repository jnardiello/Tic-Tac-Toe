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

    public function move($coords)
    {
        if (!is_array($coords)) {
            $rawCoords = str_split($coords);
            $coordMapper = $this->getCoordinatesMapper();
            $coords = [
                $coordMapper[$rawCoords[0]],
                $rawCoords[1] - 1
            ];
        }


        $this->board->set($coords, $this->placeholder);
    }

    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    public function getName()
    {
        return $this->name;
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
