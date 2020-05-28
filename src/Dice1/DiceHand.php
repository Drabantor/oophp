<?php

namespace Drabantor\Dice1;

class DiceHand
{
    /**
     * @var int  $outcome  Array of last roll of the dice.
     * @var OneDie $dice   Array of dices.
     */
    private $dice;
    private $outcome;

   /**
     * Constructor for dicehand with a specific number of dices
     *
     * @param int $dice Number of dices. Two is default
     */
    public function __construct(int $dice = 2)
    {
        $this->dice  = [];
        $this->outcome = [];

        for ($i = 0; $i < $dice; $i++) {
            $this->dice[]  = new OneDie(6);
        }
    }

    /**
     * Get the outcome of the throw
     *
     * @return array $outcome
     */
    public function getOutcome() : array
    {
        $outcome = $this->outcome;

        return $outcome;
    }

    /**
     * Throw all the dices
     *
     * @return void.
     */
    public function throwDices()
    {
        foreach ($this->dice as $d) {
            $this->outcome[] = $d->roll();
        }
    }


    /**
     * Calculate the sum of the outcome.
     *
     * @return int $sum The sum of the outcome.
     */
    public function calcSum()
    {
        return array_sum($this->outcome);
    }


        /**
     * Calculate the average of the outcome.
     *
     * @return int $avg The average of the outcome rounded to 1 decimal.
     */
    public function calcAverage()
    {
        return round(array_sum($this->outcome) / count($this->outcome), 1);
    }
}
