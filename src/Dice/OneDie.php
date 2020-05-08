<?php

namespace Drabantor\Dice;

class OneDie
{
    /**
     * Constructor to create a Die.
     *
     * @param int $sides Number of sides of the die.
     *
     */
    public function __construct(int $sides)
    {
        $this->sides = $sides;
    }

    /**
     * Throw a Die a number of times.
     *
     * @param int $times Number of times to throw the die.
     *
     * @return int $result Results of the throws.
     */
    public function roll()
    {
        return round(rand(1, $this->sides));
    }
}
