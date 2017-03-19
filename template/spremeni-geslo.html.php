<?php ob_start(); $chanege_password = chanege_password(); ?>

<h2>Sprememba gesla</h2>

<form action="" method="post">
  <div class="form-group">
    <label for="old_password">Trenutno geslo:</label>
    <input type="password" class="form-control" id="old_password" name="old_password" required placeholder="Vaše trenutno gelso">
  </div>

  <div class="form-group">
    <label for="password">Novo geslo:</label>
    <input type="password" class="form-control" id="password" name="password" required placeholder="Geslo...">
  </div>

 <div class="form-group">
    <label for="password_repeat">Ponovno novo geslo:</label>
    <input type="password" class="form-control" id="password_repeat" name="password_repeat" required placeholder="Geslo...">
  </div>

  <button type="submit" name="chanege_password" class="btn btn-default">Spremeni geslo</button>

</form>


<?php

echo $chanege_password;

$content=ob_get_clean();

$title = "Sprememba gesla";

require "template/layout.html.php";

?>