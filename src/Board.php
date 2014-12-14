<?php

namespace TicTacToe;

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

    public function toArray()
    {
        $result = [];

        foreach ($this->board as $cell) {
            $coords = $cell->getCoords();
            $result[$coords[0]][$coords[1]] = $cell->getValue();
        }

        return $result;
    }

    public function toString()
    {
        $coordIndications = ["A", "B", "C"];
        $result = "\n" .
            "\n      1     2     3  " . 
            "\n                     ";

        $boardAsArray = $this->toArray();
        $counter = 0;
        foreach ($boardAsArray as $row) {
            // Turning empty cells into spaces
            foreach ($row as &$cell) {
                if ($cell == "") {
                    $cell = " ";
                }
            }

            // Styling each row
            $result .=
                "\n         |     |     " .
                "\n      " . $row[0] . "  |  " . $row[1] . "  |  " . $row[2] . "  " .
                "      " . $coordIndications[$counter] .
                "\n         |     |     ";

            // For the first two rows we need to add delimiter
            if ($counter < 2) {
                $result .=
                    "\n    -----------------";
            }

            $counter++;
        }

        $result .= "\n\n";

        return $result;
    }

    private function cellLookup($coords)
    {
        foreach ($this->board as $cell) {
            if ($cell->getCoords() === $coords) {
                return $cell;
            }
        }
    }
}
