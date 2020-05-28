<?php

namespace Drabantor\Dice;

/**
 * Showing off a standard class with methods and properties.
 */
class AiPlayer extends Player
{
    public function __construct(String $id)
    {
        parent::__construct($id);
    }

    public function continuePlaying(int $points, int $limit, int $numberOfDices, int $leadingScore = 0)
    {
        $dicescore = $this -> points + $points;
        // Wining - quit playing
        if ($dicescore >= $limit) {
            return false;
        }

        // If  a competitor has a score of 80 or more, then the computer gambles and contiues to roll until it has won the game or rolled a one.
        if ($dicescore < $leadingScore && $leadingScore >= $limit * 0.20) {
            return true;
        }

        // If a competitor is close to winning - only half of possible total dice points away from winning, then the computer gambles.
        if ($dicescore < $leadingScore && $leadingScore >= ($numberOfDices * 6/2)) {
            return true;
        }

        // Computer contiues to play if the dicehandresult is less than 2/3 of the maxium points.
        if ($points > ($numberOfDices * 6/1.5)) {
            return false;
        }

        return true;
    }
}
