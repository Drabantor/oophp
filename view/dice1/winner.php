<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?>

<h5>Spela tärningsspelet först till 100 vinner!</h5>

<?php if ($winner != null) : ?>
    <p> Vinnare är: <b><?= $winner ?></b></p>
<?php endif; ?>

<?php if ($res != null) : ?>
    <p> Tärningarna visar: <b><?= $res ?></b></p>
<?php endif; ?>

<?php if ($res != null && $sum == 0) : ?>
    <p> Nuvarande spelare förlorade alla poäng denna runda!</p>
<?php endif; ?>

<?php if ($sum != null) : ?>
    <p> Det ihopsamlade tärningsresultatet denna runda: <b><?= $sum ?></b></p>
<?php endif; ?>

<a href="init">Starta ett nytt spel!</a>
