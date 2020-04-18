<?php
/**
* Guess my number - a POST version.
*/
require(__DIR__ . "/src/autoload.php");
require(__DIR__ . "/src/config.php");

//Start a named session
session_name("erhe19");
session_start();



//Incomming variables
$guess   = $_POST["guess"] ?? null;
$doInit  = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;

//SESSION variables
$number  = $_SESSION["number"] ?? null;
$tries   = $_SESSION["tries"] ?? null;
$game = null;

//Init the game
if ($doInit || $number === null) {
    $game =new Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();
} elseif ($doGuess) {
    $game = new Guess($number, $tries);
    $res = $game->makeGuess($guess);
    $_SESSION["tries"] = $game->tries();
    $tries -= 1;
}


//render the page
require(__DIR__ . "/view/form_template.php");
?>

<!-- <pre>
    <?= '<pre>' . var_export($_SESSION, true) . '</pre>'; ?>
</pre>


<pre>
    <?= '<pre>' . var_dump($_POST) . '</pre>'; ?>
</pre> -->
