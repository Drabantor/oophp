<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the guess game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // Init the game session for the game to start
    $game =new Drabantor\Guess\Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();

    return $app->response->redirect("guess/play");
});



/**
 * Play the game - show game status.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    //SESSION variables
    $tries   = $_SESSION["tries"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;

    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;

    $data = [
        "guess" => $guess ?? null,
        "tries" => $tries,
        "number" => $number ?? null,
        "res" => $res,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

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
    // $doInit  = $_POST["doInit"] ?? null;
    // $doCheat = $_POST["doCheat"] ?? null;

    //SESSION variables
    $number  = $_SESSION["number"] ?? null;
    $tries   = $_SESSION["tries"] ?? null;


    if ($doGuess) {
        $game = new Drabantor\Guess\Guess($number, $tries);
        $res = $game->makeGuess($guess);
        $_SESSION["tries"] = $game->tries();
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
        $tries -= 1;
    }


    // if ($_POST["guess"]) {
    //     try {
    //         $_SESSION["res"] = $game->makeGuess($_SESSION["res"]);
    //     } catch (Exception $e) {
    //         $class = get_class($e);
    //         $message = $e->getMessage();
    //         $_SESSION["exception"] = "Got exception {$class}: <b>{$message}</b>";
    //     }
    // }


    return $app->response->redirect("guess/play");
});
