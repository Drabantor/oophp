<?php
namespace Drabantor\Guess;

/**
 * Exception class for GuessException.
 */
class GuessException extends \Exception
{
    public function errorMessage()
    {
        $errorMessage = "Your guess must be an integer and in the range of 1-100!";
        return $errorMessage;
    }
}
