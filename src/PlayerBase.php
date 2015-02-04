<?php

namespace TicTacToe;

abstract class PlayerBase
{
    protected $name;
    protected $placeholder;

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

    public abstract function move();

    public function setOnBoard($coords)
    {
        if (is_array($coords[0])) {
            $coords = $coords[0];
        }

        if (!is_array($coords)) {
            $rawCoords = str_split($coords);
            $coordMapper = $this->getCoordinatesMapper();
            $coords = [
                $coordMapper[$rawCoords[0]],
                $rawCoords[1] - 1
            ];
        }

        if (in_array($coords, $this->freeSpotsArray())) {
            $this->board->set($coords, $this->placeholder);
            return true;
        }

        return false;
    }

    private function freeSpotsArray()
    {
        $availableSpots = $this->board->getAvailableSpots();
        $freeSpots = [];

        foreach ($availableSpots as $cell) {
            $freeSpots[] = $cell->getCoords();
        }

        return $freeSpots;
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
