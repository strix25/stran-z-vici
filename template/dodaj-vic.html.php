<?php ob_start(); $AddNewJoke = AddNewJoke(); if(!isset($_SESSION['user'])){header('Location:index.php');} ?>

<h2>Dodajanje vica</h2>

<form action="" method="post">
	<div class="form-group">
		<label for="title">Naslov vica:</label>
		<input type="text" class="form-control" id="title" name="title" required>
	</div>

	<div class="form-group">
		<label for="content">Vsebina vica:</label>
		<textarea class="form-control" name="content" rows="5" id="content" required></textarea>
	</div>

	<div class="form-group">
		<label for="content">Kategorija vica:</label>
		<select class="selectpicker" name='category_id'>
			<?php 
			$link=open_database_connection(); 
			
			$result = $link->query("SELECT * FROM category");

			while($row = $result->fetch_assoc())
			{ 
				echo"<option value='". $row['id']."'>". $row['title']."</option>";
			}
			close_database_connection($link); 
			?>
		</select>
	</div>

  	<button type="submit" name="AddNewJoke" class="btn btn-default">Dodaj novi vic</button>

</form>

<?php

echo $AddNewJoke;

$content=ob_get_clean();

$title = "Dodajanje vica";

require "template/layout.html.php";

?>