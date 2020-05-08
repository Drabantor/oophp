<?php

namespace Anax\View;

?><h1>Gissa numret</h1>
<body>
    <div>
    <p>Guess a number between 1 and 100. You have <?= $tries ?> tries left.</p>
        <form method="post">
            <input type="text" name="guess">
            <input style="background-color: blue; color: white" type="submit" name="doGuess" value="Make a guess">
            <input style="background-color: green; color: white" type="submit" name="doInit" value="Start over">
            <input style="background-color: #BD1D1A; color: white" type="submit" name="doCheat" value="Cheat">
        </form>
    </div>
</body>

<?php if (isset($res)) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>
<?php endif; ?>

<?php if (isset($_SESSION["doCheat"])) : ?>
    <p><b>CHEAT</b>: Current number is <b><?= $_SESSION["number"] ?></b>.</p>
<?php endif; ?>
