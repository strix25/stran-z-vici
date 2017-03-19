<?php ob_start(); ?>

<h2>Zadnji 3-je najboljši vici</h2>

<?php GetCategory(); GetLastThreeJokes(); ?>


<?php

$content=ob_get_clean();

$title = "Stran z vici";

require "template/layout.html.php";

?>