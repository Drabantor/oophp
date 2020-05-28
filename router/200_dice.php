<?php
/**
 * Create routes using $app programming style.
 */

 //debugging
// var_dump(array_keys(get_defined_vars()));

require("../src/Dice1/Dicefunctions.php");

/**
 * Init and redirect to play the game.
 */
$app->router->post("dice/init", function () use ($app) {

    /**
     * Init session variables.
     */
    $_SESSION["condition"] = [
        "human-total" => null,
        "computer-total" => null,
        "human-name" => null,
        "computer-name" => "Datorn",
        "save" => null,
        "set-first-player" => null,
        "active-throw" => null,
        "current-player" => null,
        "current-result" => null,
        "current-acc" => [],
        "winner" => null
    ];

    if (isset($_POST["player-name"])) {
        $_SESSION["condition"]["human-name"] = $_POST["player-name"];
    }

    return $app->response->redirect("dice/play");
});

$app->router->get("dice/play", function () use ($app) {

    // Create a new Dice object.
    $game = new Drabantor\Dice1\DiceDice();

    // Inject some data from the session into the Dice object.

    // Current player
    $currentPlayer = $_SESSION["condition"]["current-player"];
    if ($currentPlayer != null) {
        $game->setPlayer(new Drabantor\Dice1\Player($currentPlayer));
    }

    // The total result for the current player.
    $currentTotal = $_SESSION["condition"][$currentPlayer . "-total"] ?? null;
    if ($currentTotal != null) {
        $game->getPlayer()->setTotal($currentTotal);
    }

    // The accumulated result which might be saved if the player chooses to do so.
    $currentAcc = $_SESSION["condition"]["current-acc"];
    if ($currentAcc != []) {
        $game->getPlayer()->setArrSum($_SESSION["condition"]["current-acc"]);
    }

    $message = "";

    // Deciding who will begin.
    $message = decideWhoStart($game, $message);

    // If Save is set
    if ($_SESSION["condition"]["save"] == true) {
        // Spara resultat i session
        $_SESSION["condition"][$currentPlayer . "-total"] += $game->getPlayer()->getSumInt();

        // Check if win.
        if (checkWinCondition($currentPlayer)) {
            $app->response->redirect("dice/result");
        };
        // Change player.
        $player = $_SESSION["condition"]["current-player"];
        $playerName = $_SESSION["condition"][$player . "-name"];
        $message = changePlayer("<p></p>" . $playerName . " sparade resultatet", $game);
        // Set Save to false
        $_SESSION["condition"]["save"] = false;
    } else if ($_SESSION["condition"]["current-player"]
        && !isset($_SESSION["condition"]["set-first-player"]) && $_SESSION["condition"]["active-throw"] == "active") {
        // Begin the the main round
    if ($_SESSION["condition"]["current-player"] == "human") {
        // Generate results
            $game->getPlayer()->makeRoll();
            $currentResult = $game->getPlayer()->getResult();
            // Assign current result to session.
            $_SESSION["condition"]["current-acc"][] = $currentResult;
            // Get the last player.
            $player = $_SESSION["condition"]["current-player"];
            $playerName = $_SESSION["condition"][$player . "-name"];
            // Check if there's a die with value one in the last throw
        if ($game->checkDiceIfOne()) {
                // If so, change player and create a message
                $message = changePlayer($playerName . " kastade en etta");
        }
    } else if ($_SESSION["condition"]["current-player"] == "computer") {
            // Simulate the computers throws.
            $message = simulateComputer($game);
        if ($message == "win") {
                $app->response->redirect("dice/result");
        }
    }
    }

    $title = "Tärningsspelet Kasta gris";

    $data = [
        "message" => $message ?? null,
        "currentResult" => $currentResult ?? null,
        "humanName" => $_SESSION["condition"]["human-name"],
        "computerName" => $_SESSION["condition"]["computer-name"],
        "humanPoints" => $_SESSION["condition"]["human-total"],
        "computerPoints" => $_SESSION["condition"]["computer-total"],
        "currentAcc" => $_SESSION["condition"]["current-acc"],
        "previousAcc" => $_SESSION["condition"]["previous-acc"] ?? null,
        "currentPlayer" => $_SESSION["condition"]["current-player"] ?? null
    ];

    $app->page->add("/dice/play", $data);
    $app->page->add("/dice/template");
    $app->page->add("/dice/status", $data);

    // $app->page->add("/dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Redirection route.
 */
$app->router->get("dice/check", function () use ($app) {

    if ($_SESSION["condition"]["current-player"] == null) {
        $_SESSION["condition"]["set-first-player"] = true;
    }

    if ($_SESSION["condition"]["active-throw"] == "begin") {
        $_SESSION["condition"]["active-throw"] = "active";
    }

    $app->response->redirect("dice/play");
});

/**
 * Play a round of the game.
 */
$app->router->post("dice/play", function () use ($app) {
    if (isset($_POST["save"])) {
        $_SESSION["condition"]["save"] = true;
    };

    $app->response->redirect("dice/check");
});


/**
 * Show the final result of the game
 */
$app->router->get("dice/result", function () use ($app) {
    $title = "Tärningsspelet";

    $winner = $_SESSION["condition"]["winner"];

    $data = [
        "message" => "Vinnare är " . "<strong> $winner </strong>" . ", GRATTIS!",
        "humanPoints" => $_SESSION["condition"]["human-total"],
        "computerPoints" => $_SESSION["condition"]["computer-total"],
        "humanName" => $_SESSION["condition"]["human-name"],
        "computerName" => $_SESSION["condition"]["computer-name"]
    ];

    $app->page->add("/dice/result", $data);
    $app->page->add("/dice/restart");

    return $app->page->render([
        "title" => $title,
    ]);
});
