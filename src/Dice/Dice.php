<?php

namespace Drabantor\Dice;

/**
 * A class that deict a dice with a given number of sides
 */
class Dice
{
    private $rolls;
    private $sides;

    public function __construct(int $noOfDiceSides = 6)
    {
        $this -> rolls = [];
        $this -> sides = $noOfDiceSides;
    }

    public function roll()
    {
        $roll = rand(1, $this -> sides);
        array_push($this -> rolls, $roll);
        return $roll;
    }

    public function getLastRoll()
    {
        $roll = end($this -> rolls);
        reset($this -> rolls);
        return $roll;
    }
}
