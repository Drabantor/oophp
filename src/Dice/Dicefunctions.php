<?php

    /**
    * Decide who will begin the game
    *
    * @param Dice $game Utilizing an object from Game class. Storing data in    * $_SESSION
    *
    * @return string $message message about the game status
    */

function decideWhoStart($game, $message)
{
    if ($_SESSION["condition"]["current-player"] == null) {
        $message = "Klicka på 'Kasta' för att avgöra vem som börjar.";
    }

    if (isset($_SESSION["condition"]["set-first-player"])) {
        $firstThrow = $game->decideWhoStart();

        $_SESSION["condition"]["decide-begin-throw"] = [
            $_SESSION["condition"]["human-name"] => $firstThrow[0],
            $_SESSION["condition"]["computer-name"] => $firstThrow[1]
        ];

        $firstPlayer = $game->getPlayerName();
        $_SESSION["condition"]["current-player"] = $firstPlayer;
        $playerName = $_SESSION["condition"][$firstPlayer . "-name"];
        $message = $playerName . " fick högst och börjar kasta.";
        unset($_SESSION["condition"]["set-first-player"]);
    }

    if ($_SESSION["condition"]["current-player"] != null
        && $_SESSION["condition"]["active-throw"] != null) {
        $player = $_SESSION["condition"]["current-player"];
        $playerName = $_SESSION["condition"][$player . "-name"];

        $message .= "" . $playerName ."s tur att kasta.";
    }

    if ($_SESSION["condition"]["current-player"] != null) {
        if ($_SESSION["condition"]["active-throw"] == null) {
            $_SESSION["condition"]["active-throw"] = "begin";
        }
    }
    return $message;
}

/**
 * Simulate computer.
 */
function simulateComputer($game)
{
    for ($i = 0; $i < 3; $i++) {
        // Generate results
        $game->getPlayer()->makeRoll();
        $currentResult = $game->getPlayer()->getResult();

        $_SESSION["condition"]["current-acc"][] = $currentResult;

        $currentAcc = $_SESSION["condition"]["current-acc"];
        if ($currentAcc != []) {
            $game->getPlayer()->setArrSum($_SESSION["condition"]["current-acc"]);
        }

        $player = $_SESSION["condition"]["current-player"];
        $playerName = $_SESSION["condition"][$player . "-name"];

        if ($game->checkDiceIfOne()) {
            $message = changePlayer("<p></p>" . $playerName . " kastade en etta");
            return $message;
        }
    }

    $player = $_SESSION["condition"]["current-player"];

    // Save the result in the session
    $_SESSION["condition"][$player . "-total"] += $game->getPlayer()->getSumInt();

    // Check if win
    if (checkWinCondition($player)) {
        return "win";
    };

    $player = $_SESSION["condition"]["current-player"];
    $playerName = $_SESSION["condition"][$player . "-name"];

    // Change player and give message
    $message = changePlayer("<p></p>" . $playerName . " valde att spara resultatet");

    $_SESSION["condition"]["save"] = false;

    return $message;
}

/**
 * Change player.
 */
function changePlayer($event)
{
    // Change player
    if ($_SESSION["condition"]["current-player"] == "human") {
        $_SESSION["condition"]["current-player"] = "computer";
    } else {
        $_SESSION["condition"]["current-player"] = "human";
    };

    $_SESSION["condition"]["previous-acc"] = $_SESSION["condition"]["current-acc"];
    $_SESSION["condition"]["current-acc"] = [];

    $player = $_SESSION["condition"]["current-player"];

    $playerName = $_SESSION["condition"][$player . "-name"];

    $message = "<p></p>" . $event . ", nu är det " . $playerName . "s tur.";

    return $message;
}


/**
 * Check if someone has won.
 */
function checkWinCondition($currentPlayer)
{
    if ($_SESSION["condition"][$currentPlayer . "-total"] >= 100) {
        $player = $_SESSION["condition"]["current-player"];
        $playerName = $_SESSION["condition"][$player . "-name"];
        $_SESSION["condition"]["winner"] = $playerName;
        return true;
    }
}
