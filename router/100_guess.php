<?php
/**
 * Create routes using $app programming style.
 */

/**
 * Init the guess game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // Init the game session for the game to start
    $game =new Drabantor\Guess\Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();

    $_SESSION["doCheat"] = null;
    $_SESSION["doInit"] ?? null;

    return $app->response->redirect("guess/play");
});


/**
 * Play the game - show game status.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the guess game";

    //Get current settings from SESSION
    $tries   = $_SESSION["tries"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;

    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;

    $doCheat = $_SESSION["doCheat"] ?? null;
    $doInit = $_POST["doInit"] ?? null;

    $data = [
        "guess" => $guess ?? null,
        "tries" => $tries,
        "number" => $number ?? null,
        "res" => $res,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
    ];

    $app->page->add("guess/play", $data);
    //$app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game - make a guess.
 */
$app->router->post("guess/play", function () use ($app) {

    //Incomming variables
    $guess   = $_POST["guess"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doInit  = $_POST["doInit"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    //SESSION variables
    $number  = $_SESSION["number"] ?? null;
    $tries   = $_SESSION["tries"] ?? null;

    if ($doInit || $number === null) {
        $game =new Drabantor\Guess\Guess();
        $_SESSION["number"] = $game->number();
        $_SESSION["tries"] = $game->tries();
        $_SESSION["doCheat"] = null;
    } elseif ($doGuess) {
        $game = new Drabantor\Guess\Guess($number, $tries);
        $res = $game->makeGuess($guess);
        $_SESSION["tries"] = $game->tries();
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
    }

    if (isset($_POST["doCheat"])) {
        $_SESSION["doCheat"] = $doCheat;
    }

    return $app->response->redirect("guess/play");
});


/**
 * Handles the guess and throws an exception if its not a number between 1-100.
 */
$app->router->get("guess/play", function () use ($app) {
    $number = $_SESSION["number"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $game = null;

    try {
        $game = new Drabantor\Guess\Guess($number);
        $res = $game->makeGuess($guess);
    } catch (Drabantor\Guess\GuessException $e) {
        $res = "Not allowed, only values between 1 and 100";
    }
    $_SESSION["res"] = $res;

    return $app->response->redirect("guess/play");
});
