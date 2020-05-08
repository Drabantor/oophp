
<form method="post">
<?php if ($_SESSION["condition"]["current-player"] == "computer") : ?>
    <input style="background-color: blue; color: white" type="submit" name="roll" value="Kasta åt datorn">

<?php else : ?>
    <input style="background-color: blue; color: white" type="submit" name="roll" value="Kasta">
<?php endif; ?>

<?php if ($_SESSION["condition"]["active-throw"] == "active"
            && $_SESSION["condition"]["current-player"] == "human"
            && $_SESSION["condition"]["current-acc"] != null) : ?>
    <input style="background-color: green; color: white" type="submit" name="save" value="Spara">
<?php endif ?>
</form>
