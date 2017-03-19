<?php ob_start();  $Prijava = Prijava();?>

<h2>Prijava za registrirane uporabnike !</h2>

<form action="" method="post">
  <div class="form-group">
    <label for="username">Uporabniško ime:</label>
    <input type="text" class="form-control" id="username" name="username" required placeholder="Vaše uporabniško ime">
  </div>

  <div class="form-group">
    <label for="password">Geslo:</label>
    <input type="password" class="form-control" id="password" name="password" required placeholder="Geslo...">
  </div>

  <div class="checkbox">
    <label>
      <input type="checkbox" name='SaveLogin' value='SaveLogin'> Zaponi si me
    </label>
  </div>

  <a href='index.php?stran=pozabljeno-geslo'>Pozabljeno geslo ?</a><br>

  <button type="submit" name="login" class="btn btn-default">Prijava</button>

</form>

<?php

echo $Prijava;

$content=ob_get_clean();

$title = "Prijava";

if(isset($_COOKIE['user']) or isset($_SESSION["user"]) ){header('Location:index.php'); }

require "template/layout.html.php";

?>