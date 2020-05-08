<?php

namespace Drabantor\Dice;

class Dice
{
    /**
     * Get the name of the current player.
     *
     * @return string  Name of the current player.
     */
    public function getPlayerName() : string
    {
        return $this->currentPlayer->getName();
    }

    /**
     * Set the player property.
     *
     * @return void
     */
    public function setPlayer(Player $player)
    {
        $this->currentPlayer = $player;
    }

    /**
     * Get the current player
     *
     * @return Player Get object
     */
    public function getPlayer()
    {
        return $this->currentPlayer;
    }

    /**
     * Check the dice if it has value 1
     *
     * @return void
     */
    public function checkDiceIfOne()
    {
        if (in_array(1, $this->currentPlayer->getResult())) {
            return true;
        }
    }


    /**
     * Decide who start the game.
     *
     * @return void
     */
    public function decideWhoStart()
    {
        $oneDie = new OneDie(6);

        $youThrow = 0;
        $aiThrow = 0;

        while ($youThrow == $aiThrow) {
            $youThrow = $oneDie->roll();

            $aiThrow = $oneDie->roll();

            $result = [$youThrow, $aiThrow];

            if ($youThrow > $aiThrow) {
                $this->setPlayer(new Player("human"));
                break;
            }

            if ($youThrow < $aiThrow) {
                $this->setPlayer(new Player("computer"));
                break;
            }
        }
        return $result;
    }
}
