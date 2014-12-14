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
    }

    public function getPlaceholder()
    {
        return $this->placeholder;
    }
}
