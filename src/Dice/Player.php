<?php

namespace Drabantor\Dice;

/**
 * Showing off a standard class with methods and properties.
 */
class Player
{
    protected $who;
    protected $points;

    public function __construct(String $who)
    {
        $this -> points = 0;
        $this -> who = $who;
    }


    public function getWho()
    {
        return $this -> who;
    }


    public function getPoints()
    {
        return $this -> points;
    }


    public function addPoints(int $points)
    {
        $this -> points += $points;
    }


    public function continuePlaying(int $points, int $limit, int $nbrOfDices, int $leadingScore = 0)
    {
        $points = $points;
        $limit = $limit;
        $nbrOfDices = $nbrOfDices;
        $leadingScore = $leadingScore;
        return null;
    }
}
