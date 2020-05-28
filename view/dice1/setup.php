<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<h5>Spela tärningsspelet först till 100 vinner!</h5>


<form class="stup" method="post" action="setup">
    <fieldset style="padding-bottom: 24px">
        <legend>Välj antal spelare (max 4) och antal tärningar (max 5)</legend>

        <table>
            <tr>
                <td style="padding-right:10px"><label for="players">Antal spelare</label></td>
                <td><input type="number" name="players" id="players" value="2" min="2" max="4"></td>
            </tr>
            <tr>
                <td><label for="dices">Antal tärningar</label></td>
                <td><input type="number" name="dices" id="dices" value="2" min="1" max="5"></td>
            </tr>
        </table>

        <input style="background-color: blue; color: white; margin-top: 1em;" type="submit" name="doSetup" value="Starta nytt spel!">
    </fieldset>
</form>
