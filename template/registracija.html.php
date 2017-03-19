<?php ob_start(); $Registracija =  Registracija(); ?>

<h2>Registraicja uporabnikov</h2>

<form action="" method="post">
  <div class="form-group">
    <label for="username">Uporabniško ime:</label>
    <input type="text" class="form-control" id="username" required name="username" placeholder="Vaše uporabniško ime">
  </div>

  <div class="form-group">
    <label for="password">Geslo:</label>
    <input type="password" class="form-control" id="password" required name="password" placeholder="Geslo...">
  </div>

  <div class="form-group">
    <label for="RepeatPassword">Ponovno geslo:</label>
    <input type="password" class="form-control" id="RepeatPassword" required name="RepeatPassword" placeholder="Ponovite geslo">
  </div>

  <div class="form-group">
    <label for="captcha"><?php echo captcha(); ?></label>
    <input type="text" class="form-control" id="captcha" required name="captcha" placeholder="Dokažite da niste robot">
  </div>

  <button type="submit" name="register" class="btn btn-default">Registracija</button>
</form>

<?php

echo $Registracija;

$content=ob_get_clean();

$title = "Registracija";

require "template/layout.html.php";

?>