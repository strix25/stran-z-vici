<?php ob_start(); ?>

<center>
	<h2>Napaka, spletna stran ne obstaja!</h2>
	<p>Stran ali navedba, ki jo poskušate doseči, ne obstaja več ali pa je potekla.</p>
</center>
<?php

$content=ob_get_clean();

$title = "Stran z vici";

require "template/layout.html.php";

?>