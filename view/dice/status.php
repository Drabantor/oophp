<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<p><?= $humanName ?>s poäng: <?= $humanPoints ?? 0 ?></p>

<p><?= $computerName ?>s poäng: <?= $computerPoints ?? 0 ?></p>

</div>
    <div class="dice-game-right">
        <?php if ($currentAcc) : ?>
            <?php
                $player = $_SESSION["condition"][$currentPlayer . "-name"];
            ?>

            <h5><?= $player ?>s kast</h5>
            <div class="throw-div">
                <?php foreach ($currentAcc as $i => $arr) : ?>
                    <div style="width: 5em;">
                        <h5>Kast <?= $i + 1 ?></h5>
                        <?php foreach ($arr as $k => $v) : ?>
                            <p><i style="font-size: 2.8em;" class="die-symbol">&#x268<?= intval($v) -1 ?>;</i></p>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($previousAcc) : ?>
            <?php
            if ($currentPlayer == "human") {
                $player = $_SESSION["condition"]["computer-name"];
            }
            if ($currentPlayer == "computer") {
                $player = $_SESSION["condition"]["human-name"];
            }
            ?>

            <h4><?= $player ?>s kast</h4>
            <div class="throw-div">
                <?php foreach ($previousAcc as $i => $arr) : ?>
                    <div  style="width: 5em;">
                        <h5>Kast <?= $i + 1 ?></h5>
                        <?php foreach ($arr as $k => $v) : ?>
                            <p><i style="font-size: 2.8em;" class="die-symbol">&#x268<?= intval($v) -1 ?>;</i></p>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php $_SESSION["condition"]["previous-acc"] = []; ?>

        <?php endif; ?>

        <?php if (isset($_SESSION["condition"]["decide-begin-throw"])) : ?>
            <h4>Första kasten</h4>
            <?php foreach ($_SESSION["condition"]["decide-begin-throw"] as $k => $v) : ?>
                <p><?= $k ?>: <i style="font-size: 2.8em;" class="die-symbol">&#x268<?= $v -1 ?>;</i></p>
            <?php endforeach; ?>
            <?php unset($_SESSION["condition"]["decide-begin-throw"]); ?>

        <?php endif; ?>
    </div>
</div>
