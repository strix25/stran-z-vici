<?php ob_start(); ?>

<h2>Urejanje profila</h2>


<a href="index.php?stran=spremeni-geslo"><i class="fa fa-unlock-alt"></i> Spremni geslo</a>


<?php

$content=ob_get_clean();

$title = "Urejanje profila";

require "template/layout.html.php";

?>