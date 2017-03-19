<?php ob_start(); if(!isset($_SESSION['user'])){header('Location:index.php');} ?>

<h2>Administratoska plošča</h2>

<a href="index.php?stran=dodaj-vic"><i class="fa fa-plus"></i> Dodaj novi vic</a>

<?php

$content=ob_get_clean();

$title = "Administratoska plošča";

require "template/layout.html.php";

?>