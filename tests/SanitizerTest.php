<?php

namespace TicTacToe;

class SanitizerTest extends \PHPUnit_Framework_TestCase
{
    public function testWillRefuseInvalidInput()
    {
        $sanitizer = new Sanitizer();
        $input = 'D500';

        $this->assertFalse($sanitizer->check($input));
    }

    public function testWithGoodInputWillReturnCoords()
    {
        $sanitizer = new sanitizer();
        $input = 'C3';

        $this->assertequals('C3', $sanitizer->check($input));
    }

    public function testSanitizerWillHandleLowerCaseLetters()
    {
        $sanitizer = new sanitizer();
        $input = 'c3';

        $this->assertequals('C3', $sanitizer->check($input));
    }

    public function testSanitizerCanHandleBadFormattedInput()
    {
        $sanitizer = new sanitizer();
        $input = '3c';

        $this->assertequals('C3', $sanitizer->check($input));
    }
}
