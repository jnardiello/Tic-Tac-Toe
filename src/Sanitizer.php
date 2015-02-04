<?php

namespace TicTacToe;

class Sanitizer
{
    public function check($input)
    {
        $letter = strtoupper(substr($input, 0, 1));
        $number = substr($input, 1, 1);

        if ($this->isInputSwitched($number)) {
            $letter = strtoupper(substr($input, 1, 1));
            $number = substr($input, 0, 1);
        }

        if (
            !in_array($letter, $this->getValidLetters())
            ||
            !in_array($number, $this->getValidNumbers())
        ) {
            echo "\nInvalid move my friend, try again\n";
            return false;
        }

        return $letter . $number;
    }

    private function getValidLetters()
    {
        return ['A', 'B', 'C'];
    }

    private function getValidNumbers()
    {
        return [1, 2, 3];
    }

    private function isInputSwitched($number)
    {
        return in_array(strtoUpper($number), $this->getValidLetters());
    }
}
