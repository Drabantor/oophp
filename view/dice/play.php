<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<h1>Tärningspelet Kasta gris</h1>

<div style="height: 10em"; class="dice-game" >
<div "class="dice-game-left">

    <?php if ($message) : ?>
        <p><?= $message ?></p>
    <?php endif; ?>
