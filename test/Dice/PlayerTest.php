<?php
namespace Drabantor\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player.
 */
class PlayerTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateObject()
    {
        $name = "Elon Musk";
        $player = new Player($name);

        $this->assertInstanceOf("\Drabantor\Dice\Player", $player);
    }


    /**
     * Get the id of the player and verify it's the same as
     * the id sent at object creation.
     */
    public function testGetId()
    {
        $name = "Elon Musk";
        $player = new Player($name);
        $res = $player -> getWho();
        $this->assertSame($name, $res);
    }


    /**
     * Add some points to the player and verify that it's updated
     */
    public function testAddPointsOnce()
    {
        $name = "Elon Musk";
        $player = new Player($name);
        $player -> addPoints(25);
        $res = $player -> getPoints();
        $this->assertSame(25, $res);
    }

    /**
     * Add some points to the player several times
     * and verify that it's updated
     */
    public function testAddPointsTwice()
    {
        $name = "Elon Musk";
        $player = new Player($name);
        $player -> addPoints(11);
        $res = $player -> getPoints();
        $this->assertSame(11, $res);

        $player -> addPoints(21);
        $res = $player -> getPoints();
        $this->assertSame(11 + 21, $res);
    }


    /**
     * Get the points of the player and verify that it's zero
     * after the object creation.
     */
    public function testGetPointsWhenZero()
    {
        $name = "Elon Musk";
        $player = new Player($name);
        $res = $player -> getWho();
        $this->assertSame($name, $res);
    }


    /**
     * Get the points of the player and verify that it's zero
     * after the object creation.
     */
    public function testGetPointsWhenAddedOnce()
    {
        $name = "Elon Musk";
        $player = new Player($name);
        $player -> addPoints(5);
        $res = $player -> getPoints();
        $this->assertSame(5, $res);
    }


    /**
     * Get the points of the player and verify that it's updated
     * after one addition.
     */
    public function testGetPointsWhenAddedMultiple()
    {
        $name = "Elon Musk";
        $player = new Player($name);
        $player -> addPoints(5);
        $res = $player -> getPoints();
        $this->assertSame(5, $res);

        $player -> addPoints(5);
        $res = $player -> getPoints();
        $this->assertSame(5 + 5, $res);

        $player -> addPoints(23);
        $res = $player -> getPoints();
        $this->assertSame(5 + 5 + 23, $res);
    }


    /**
     * Checks if the player want to keep playing
     */
    public function testKeepPlaying()
    {
        $name = "Elon Musk";
        $player = new Player($name);
        $this->assertNull($player -> continuePlaying(10, 10, 10));
    }
}
