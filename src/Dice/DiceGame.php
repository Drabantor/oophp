<?php

namespace Drabantor\Dice;

/**
 * Showing off a standard class with methods and properties.
 */
class DiceGame
{
    private $players = [];
    private $dicehand;
    private $numberOfDices;
    private $currentPlayerIndex;
    private $currentSum;
    private $resultOfPlayerRoll;

    const INVALID_DICE_VALUE = 1;
    const LOWEST_VALUE_FOR_WIN = 100;

    public function __construct(int $numberOfPlayers = 2, bool $withComputer = true, int $numberOfDices = 6)
    {
        $count = $numberOfPlayers;

        if ($withComputer) {
            $count--;
        }

        for ($i = 0; $i < $count; $i++) {
            $who = $i + 1;
            array_push($this -> players, new Player("Spelare " . $who));
        }

        if ($withComputer) {
            array_push($this -> players, new AiPlayer("Datorn"));
        }

        $this -> dicehand = new DiceHandHistogram($numberOfDices);
        $this -> currentPlayerIndex = 0;
        $this -> currentSum = 0;
        $this -> numberOfDices = $numberOfDices;
        $this -> resultOfPlayerRoll = 0;
    }

    public function rollDiceHand()
    {
        $roll = [];

        $roll = $this -> dicehand -> roll();

        if ($this -> isValidRoll()) {
            $this -> currentSum += $this -> dicehand -> sum();
        } else {
            $this -> currentSum = 0;
        }

        $this -> resultOfPlayerRoll++;
        return $roll;
    }


    public function isValidRoll()
    {
        return !in_array(self::INVALID_DICE_VALUE, $this -> dicehand -> values());
    }


    public function getCurrentPlayer()
    {
        return $this -> players[$this -> currentPlayerIndex] -> getWho();
    }


    public function getTheSum()
    {
        return $this -> currentSum;
    }

    public function getPlayersPoints()
    {
        $playersList = [];

        foreach ($this -> players as $player) {
            array_push($playersList, [$player -> getWho(), $player -> getPoints()]);
        }

        return $playersList;
    }


    public function nextPlayer()
    {
        $this -> players[$this -> currentPlayerIndex] -> addPoints($this -> currentSum);
        $this -> currentSum = 0;
        $this -> currentPlayerIndex++;

        if ($this -> currentPlayerIndex >= count($this -> players)) {
            $this -> currentPlayerIndex = 0;
        }

        $this -> resultOfPlayerRoll = 0;
    }


    public function forceNextTurn()
    {
        if ($this -> resultOfPlayerRoll == 0) {
            return false;
        }

        if (!($this -> isValidRoll())) {
            return true;
        }

        $playMore =
        $this -> players[$this -> currentPlayerIndex] -> continuePlaying(
            $this -> currentSum,
            self::LOWEST_VALUE_FOR_WIN,
            $this -> numberOfDices
        );

        if ($playMore !== null) {
            return !$playMore;
        }

        return null;
    }


    public function checkWhoWins()
    {
        for ($i = 0; $i < count($this -> players); $i++) {
            if ($this -> players[$i] -> getPoints() >= self::LOWEST_VALUE_FOR_WIN) {
                return $this -> players[$i] -> getWho();
            }
        }

        return null;
    }


    public function getHistogram()
    {
        $histogram = new Histogram();
        $histogram->injectData($this->dicehand);

        return $histogram->getAsText();
    }
}
