<?php ob_start(); ?>

<h2>Naslovnica spletne strani</h2>
<p>Dobrodošli na spletni strani z vici!</p>

<?php

$content=ob_get_clean();

$title = "Stran z vici";

require "template/layout.html.php";

?>