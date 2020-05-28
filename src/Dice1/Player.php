<?php

namespace Drabantor\Dice1;

class Player
{
    /**
     * Constructor
     *
     * @param string $name The name of the player.
     *
     * @param int $total The total sum of the player's thrown dices
     *
     */
    public function __construct(string $name, int $total = 0)
    {
        $this->name = $name;
        $this->currentResult = [];
        $this->totalResult = $total;
    }

    /**
     * Get current results
     *
     * @return array $res An array containing latest results.
     */
    public function getResult() : array
    {
        $res = $this->currentResult;
        return $res;
    }

    /**
     * Get total results
     *
     * @return int $res Sum of the total results.
     */
    public function getTotal()
    {
        $res = $this->totalResult;
        return $res;
    }


    /**
     * Set total results
     *
     * @param int $total Sum of the total results.
     *
     * @return void
     */
    public function setTotal($total)
    {
        if ($total != null) {
            $this->totalResult = $total;
        }
    }

    /**
     * Get the total sum from integers
     *
     * @return int $res Accumulated results as integer
     */
    public function getSumInt() : int
    {
        $res = 0;

        foreach ($this->acc as $item) {
            $res += array_sum($item);
        }

        return $res;
    }


    /**
     * Set accumulated results as an array
     *
     * @param array $accArr the sum of an array
     *
     * @return void
     */
    public function setArrSum($accArr)
    {
        if ($accArr != []) {
            $this->acc = $accArr;
        }
    }

    /**
     * Get name of the player.
     *
     * @return string $playerName The name of the player.
     */
    public function getName()
    {
        $res = $this->name;
        return $res;
    }

    /**
     * Throw a hand of dice and set the number of dices as a parameter
     *
     * @return void
     */
    public function makeRoll()
    {
        $hand = new DiceHand(2);
        $hand->throwDices();
        $this->currentResult = $hand->getOutcome();
    }
}
