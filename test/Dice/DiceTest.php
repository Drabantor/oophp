<?php
namespace Drabantor\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Drabantor\Dice\Dice", $dice);
    }


    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectWithArguments()
    {
        $dice = new Dice(5);
        $this->assertInstanceOf("\Drabantor\Dice\Dice", $dice);
    }


    /**
     * Roll the dice and verify that the value is within limits
     */
    public function testRoll()
    {
        $dice = new Dice(5);

        $firstroll = $dice -> roll();
        $this->assertTrue($firstroll >= 1 && $firstroll <= 5);

        $secondroll = $dice -> roll();
        $this->assertTrue($secondroll >= 1 && $secondroll <= 5);
    }


    /**
     * Get the last roll of the dice and verify that the value
     * is the same as from the roll operation
     */
    public function testGetLastRoll()
    {
        $dice = new Dice(5);

        $firstroll = $dice -> roll();
        $this->assertTrue($firstroll == $dice -> getLastRoll());

        $secondroll = $dice -> roll();
        $this->assertTrue($secondroll == $dice -> getLastRoll());
    }
}
