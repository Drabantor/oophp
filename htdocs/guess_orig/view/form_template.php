<?php
require(__DIR__  . "/incl/header.php");
?>

<body>
    <div>
    <h1>Guess number!</h1>
    <p>Guess a number between 1 and 100. You have <?= $tries ?> tries left.</p>
    <!-- method="post" action="process.php" -->
        <form method="post">
            <input type="text" name="guess">
            <input type="submit" name="doGuess" value="Make a guess">
            <input type="submit" name="doInit" value="Start over">
            <input type="submit" name="doCheat" value="Cheat">
        </form>
    </div>
</body>

<?php if (isset($doGuess)) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>
<?php endif; ?>

<?php if (isset($doCheat)) : ?>
    <p>Cheat: current number is <?= $number ?></p>
<?php endif; ?>
