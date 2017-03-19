<?php ob_start();  $ForgetPassword = ForgetPassword();?>

<h2>Pozabljeno geslo</h2>

<form action="" method="post">
  <div class="form-group">
    <label for="email">Elektronski naslov:</label>
    <input type="email" class="form-control" id="email" name="email" required placeholder="Vaš elektronski naslov ob registraciji">
  </div>

  <button type="submit" name="ForgetPassword" class="btn btn-default">Pozabljeno geslo</button>

</form>


<?php

echo $ForgetPassword;

$content=ob_get_clean();

$title = "Pozabljeno geslo";

require "template/layout.html.php";

?>