<?php ob_start(); ?>

<h2>Vsi vici</h2>

<?php GetAllJokes(); ?>


<?php

$content=ob_get_clean();

$title = "Stran z vici";

require "template/layout.html.php";

?>