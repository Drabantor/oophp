<?php

namespace Drabantor\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceGame.
 */
class DiceGameTest extends TestCase
{
    /**
     * Roll the dicehand and verify that the values are within limits
     */
    public function testRollDicehand()
    {
        $players = 5;
        $dices = 4;
        $withComputer = false;
        $dicegame = new DiceGame($players, $withComputer, $dices);
        $res = $dicegame -> rollDiceHand();
        $this -> assertSame($dices, count($res));

        foreach ($res as $r) {
            $this -> assertTrue($r >= 1 && $r <= 6);
        }
    }


    /**
     * Roll the dicehand and verify that the validation of the roll is working
     */
    public function testIsValidRoll()
    {
        $players = 5;
        $dices = 4;
        $withComputer = false;
        $dicegame = new DiceGame($players, $withComputer, $dices);
        $res = $dicegame -> rollDiceHand();
        $this -> assertSame($dices, count($res));

        $validroll = true;
        foreach ($res as $r) {
            if ($r == 1) {
                $validroll = false;
                break;
            }
        }

        $res2 = $dicegame -> isValidRoll();
        $this -> assertSame($validroll, $res2);
    }

    /**
     * Get the current player and verify that the right ID is returned
     */
    public function testGetCurrentPlayer()
    {
        $dicegame = new DiceGame();
        $res = $dicegame -> getCurrentPlayer();
        $this -> assertEquals("Spelare 1", $res);
        $dicegame -> nextPlayer();
        $res = $dicegame -> getCurrentPlayer();
        $this -> assertEquals("Datorn", $res);
    }


    /**
     * Check the current sum is zero after each player has played his round
     */
    public function testGetCurrentSumZero()
    {
        $players = 5;
        $dices = 4;
        $withComputer = false;
        $dicegame = new DiceGame($players, $withComputer, $dices);
        $esp = 0;
        $res = $dicegame -> getTheSum();
        $this -> assertEquals($esp, $res);
        $dicegame -> nextPlayer();
        $res = $dicegame -> getTheSum();
        $this -> assertEquals($esp, $res);
    }


    /**
     * Roll the dicehand several times and check the current
     * sum is updated as supposed to
     */
    public function testGetCurrentSumMultipleRolls()
    {
        $players = 5;
        $dices = 4;
        $withComputer = false;
        $dicegame = new DiceGame($players, $withComputer, $dices);
        $esp = 0;
        $res = $dicegame -> getTheSum();
        $this -> assertEquals($esp, $res);
        $counter = 0;

        while ($counter < 3) {
            $resarray = $dicegame -> rollDiceHand();
            if ($dicegame -> isValidRoll()) {
                $esp += array_sum($resarray);
                $counter++;
                $res = $dicegame -> getTheSum();
                $this -> assertEquals($esp, $res);
            } else {
                $esp = 0;
                $counter = 0;
            }
        }

        $dicegame -> nextPlayer();
        $esp = 0;
        $res = $dicegame -> getTheSum();
        $this -> assertEquals($esp, $res);
    }


    /**
     * Check the players point count is zero at the start of game
     */
    public function testGetPlayersPointsZero()
    {
        $players = 5;
        $dices = 4;
        $withComputer = false;
        $dicegame = new DiceGame($players, $withComputer, $dices);
        $esp = 0;
        $res = $dicegame -> getPlayersPoints();
        for ($i = 0; $i < $players; $i++) {
            $this -> assertEquals($esp, $res[$i][1]);
        }
    }


    /**
     * Check the players point count is updated after player's round
     */
    public function testGetPlayersPoints()
    {
        $players = 5;
        $dices = 4;
        $withComputer = false;
        $counter = 0;
        $dicegame = new DiceGame($players, $withComputer, $dices);
        $esp = 0;

        while ($counter < 2) {
            $resarray = $dicegame -> rollDiceHand();
            if ($dicegame -> isValidRoll()) {
                $esp += array_sum($resarray);
                $counter++;
            } else {
                $esp = 0;
                $counter = 0;
            }
        }

        $dicegame -> nextPlayer();
        $res = $dicegame -> getPlayersPoints();
        $this -> assertEquals($esp, $res[0][1]);
    }


    /**
     * Check the next player in list is chosen
     */
    public function testNextPlayerDefault()
    {
        $dicegame = new DiceGame();
        $this -> assertEquals("Spelare 1", $dicegame -> getCurrentPlayer());
        $dicegame -> nextPlayer();
        $this -> assertEquals("Datorn", $dicegame -> getCurrentPlayer());
        $dicegame -> nextPlayer();
        $this -> assertEquals("Spelare 1", $dicegame -> getCurrentPlayer());
    }

    /**
     * Check the next player in list is chosen
     */
    public function testNextPlayerMulti()
    {
        $players = 4;
        $dices = 5;
        $withComputer = false;
        $dicegame = new DiceGame($players, $withComputer, $dices);
        $counter = 1;
        while ($counter < 5) {
            $this -> assertEquals("Spelare " . $counter, $dicegame -> getCurrentPlayer());
            $dicegame -> nextPlayer();
            $counter ++;
        }

        $this -> assertEquals("Spelare 1", $dicegame -> getCurrentPlayer());
        $dicegame -> nextPlayer();
        $this -> assertEquals("Spelare 2", $dicegame -> getCurrentPlayer());
    }
}
