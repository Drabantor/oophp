<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>
<h1>Dice game med Histogram</h1>
<body>
    <div>
        <div class="dice-game-left">
            <?php if ($totals !== null) : ?>
                <table>
                    <tr>
                        <td><b>Spelare</b></td>
                        <td><b>Poäng</b></td>
                    </tr>
                    <?php foreach ($totals as $total) { ?>
                    <tr>
                        <td><?= $total[0] ?></td>
                        <td><?=": " . $total[1] ?></td>
                    </tr>
                    <?php }; ?>
                </table>
            <?php endif; ?>

            <form class="throw-div" method="post">
                <?php if (($next != true) && ($res == null || $sum != 0)) { ?>
                    <input style="background-color: blue; color: white" type="submit" name="doRoll" value="Kasta" formaction="<?= url("dice1/play"); ?>">
                <?php } else { ?>
                <?php }?>
                <?php if ($next === null || $next == true) { ?>
                    <input style="background-color: green; color: white" type="submit" name="doNextPlayer" value="Nästa spelare" formaction="<?= url("dice1/next"); ?>">
                <?php } ?>
            </form>
        </div>
    </div>

        <div class="dice-game-right">
            <h5>Först till 100 vinner!</h5>

        <?php if ($player != null) : ?>
            <p><b><?= $player ."s" ?></b> tur att kasta.</p>
        <?php endif; ?>

        <?php if ($res != null) : ?>
            <p> Tärningarna visar: <b><?= $res ?></b></p>
        <?php endif; ?>

        <?php if ($res != null && $sum == 0) : ?>
            <p>Nuvarande spelare förlorade alla poäng denna runda!</p>
        <?php endif; ?>

        <?php if ($sum != null) : ?>
            <p> Det ihopsamlade tärningsresultatet denna runda: <b><?= $sum ?></b></p>
        <?php endif; ?>
        </div>


        <div class="histogram">
            <?php if ($histogram !== null) : ?>
                <table>
                    <tr>
                        <th>Histogram</th>
                    </tr>
                <?php foreach ($histogram as $h) { ?>
                    <tr>
                        <td><?= $h ?></td>
                    </tr>
                <?php }; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
