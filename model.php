<?php
session_start();

function open_database_connection()
{
	$link=new mysqli("potato.si","user","user123","pb");
	$link->query("SET NAMES 'utf8'");
	return $link;
}
function close_database_connection($link)
{
	mysqli_close($link);
}

function Registracija() {
	$message = "";
	if (isset($_POST['register']))
	{	
		if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['RepeatPassword']) && !empty($_POST['captcha']))
		{	
			if($_POST['password'] == $_POST['RepeatPassword'])
			{
				if($_SESSION["captcha"] == $_POST['captcha'])
				{
					if(strlen($_POST['password']) >= 8)
					{	
						$username = $_POST['username'];

						$link=open_database_connection(); 

						$UsernameCheck = $link->query("SELECT username FROM users WHERE username = '$username' ");
	                    
	                    $row_cnt = mysqli_num_rows($UsernameCheck);

	                    close_database_connection($link); 

	                    if($row_cnt == 0)
	                    {
							$password = sha1($_POST['password']);

							$link=open_database_connection(); 

							$sql="INSERT INTO users (username, password, register) VALUES ('$username','$password', now())";
							
							if (!mysqli_query($link,$sql))
							{
								echo(mysqli_error($link));
							} 
							else 
							{

								$message = "<p class='bg-success'>Registracija je uspela</p>";
							}
								
							close_database_connection($link); 

						}else {$message = "<p class='bg-danger'>Uporabniško ime že obstaja</p>";}

					}else {$message = "<p class='bg-danger'>Geslo mora biti daljše od 8 znakov!</p>";}

				 }else {$message = "<p class='bg-danger'>Vnesite pravilno število za captcho</p>";}

			}else {$message = "<p class='bg-danger'>Gesli se ne ujemata!</p>";}


		}else {$message = "<p class='bg-danger'>Vsa polja morajo biti izpolnjena</p>";}
	}

	return $message;
}

function Prijava() {
	$message = "";
	


	if (isset($_POST['login']))
	{	
		if(!empty($_POST['username']) && !empty($_POST['password']))
		{	
			$username = $_POST['username'];
			$password = sha1($_POST['password']);

			$link=open_database_connection(); 

			$UsernameCheck = $link->query("SELECT username FROM users WHERE username = '$username' ");
	        
	        $row_cnt = mysqli_num_rows($UsernameCheck);

	        if($row_cnt != 0)
	        {
				$result = $link->query("SELECT * FROM users WHERE username = '$username' ");
				//(mysqli_error($DB));

				while($row = $result->fetch_assoc())
				{ 
					$wrong_password = $row['wrong_password'];

					$wrong_password2 = $wrong_password + 1; 

					if($wrong_password >= 3)
					{
						$wrong_password2 = 3;
						$message = "<p class='bg-danger'>Vaš račun je zaklenjen</p>";
					}

					if($row['password'] == $password)
					{
						if($wrong_password < 3)
						{
							$_SESSION["user"] = $username;

							if(isset($_POST['SaveLogin']))
							{
								setcookie("user", $username, time() + 3600);
							}
							$last_login = date('Y-m-d H:i:s');
							$link->query("UPDATE users SET last_login = '$last_login' WHERE username = '$username'");
							$link->query("UPDATE users SET wrong_password = '0' WHERE username = '$username'");
						}
					} 
					else //Wrong password
					{
						$message = "<p class='bg-danger'>Uporabniško ime ali geslo je napačno</p>";

						$link->query("UPDATE users SET wrong_password = '$wrong_password2' WHERE username = '$username'");
						
					} 
					
				}

	        	close_database_connection($link); 

			}else {$message = "<p class='bg-danger'>Uporabniško ime ali geslo je napačno</p>";} //Wrong username


		}else {$message = "<p class='bg-danger'>Vsa polja morajo biti izpolnjena</p>";}
	}

	return $message;
}

function captcha() {
	$rand1 = rand(1,9); 
	$rand2 = rand(1,9);

	echo $rand1 . "+" . $rand2;

	$result = $rand1 + $rand2;

	$_SESSION["captcha"] = $result;

}

function chanege_password() {
	$message = "";

	if(isset($_POST['chanege_password']))
	{
		if(!empty($_POST['old_password']) && !empty($_POST['password']) && !empty($_POST['password_repeat']))
		{
			$user = $_SESSION["user"];
			$old_password = $_POST['old_password'];
			$password = $_POST['password'];
			$password_repeat = $_POST['password_repeat'];

			$link=open_database_connection(); 

			$result = $link->query("SELECT * FROM users WHERE username = '$user' ");

			while($row = $result->fetch_assoc())
			{ 
				$StoredPassword = $row['password'];

				if(sha1($old_password) == $StoredPassword)
				{
					if($password == $password_repeat)
					{
						$NewPassword = sha1($password);

						$link->query("UPDATE users SET password = '$NewPassword' WHERE username = '$user'");

						session_destroy();
						header('Location: index.php');

						close_database_connection($link); 

					}else $message = "<p class='bg-danger'>Geslo in ponovi geslo se morata ujemati!</p>"; 

				}else $message = "<p class='bg-danger'>Vneseno vaše trenutno geslo je napačno!</p>"; 
			}

		}else $message = "<p class='bg-danger'>Vsa polja so obvezna!</p>"; 
	}
	return $message;
}

function ForgetPassword() {
	$message = "";

	if(isset($_POST['ForgetPassword']))
	{
		if(!empty($_POST['email']))
		{
			$email = $_POST['email'];

			$link=open_database_connection(); 

			$EmailCheck = $link->query("SELECT email FROM users WHERE email = '$email' ");
	        
	        $row_cnt = mysqli_num_rows($EmailCheck);

	        if($row_cnt != 0)
	        {
	        	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    			$password = substr(str_shuffle( $characters ), 0, 8 );

    			$NewPassword = sha1($password);

    			echo" <p class='bg-success'>Vaše novo genereirano geslo je: $password</p>";

    			$link->query("UPDATE users SET password = '$NewPassword' WHERE email = '$email'");

    			$msg = "Vaše novo generirano geslo je: $password";

				$msg = wordwrap($msg,70);

				mail($email,"Novo geslo",$msg);

	        }else $message = "<p class='bg-danger'>Vneseni e-naslov je napačen ali ne obstaja!</p>";

		}else $message = "<p class='bg-danger'>Polje z e-mail je obvezno!</p>";
	}
	return $message;
}

function AddNewJoke() {
	$message = "";

	if(isset($_POST['AddNewJoke']))
	{
		if(!empty($_POST['title']) && !empty($_POST['content']))
		{
			$title = $_POST['title'];
			$content = $_POST['content'];
			$date_time = date('Y-m-d H:i:s');
			$user_username = $_SESSION['user'];
			$category_id = $_POST['category_id'];
			$link=open_database_connection(); 

			$result = $link->query("SELECT * FROM users WHERE username = '$user_username'");

			$row = $result->fetch_assoc();

			$user_id = $row['id'];

			$link->query("INSERT INTO jokes VALUES('','$title','$content','$date_time','$user_id','$category_id')");
			
			$message = "<p class='bg-success'>Vic je bil uspešno dodan</p>";

			close_database_connection($link); 

		}else $message = "<p class='bg-danger'>Vsa polja so zahtevana!</p>";
	}
	return $message;
}

function GetCategory() {
		
	$link=open_database_connection(); 

	echo"<div class='row'> <div class='col-sm-6 col-md-4'>";

	$result = $link->query("SELECT * FROM category");

	while($row = $result->fetch_assoc())
	{ 
		$category_id = $row['id'];
		$title = $row['title'];
		
		$jokes = $link->query("SELECT * FROM jokes WHERE category_id = '$category_id' ORDER BY id DESC LIMIT 1");

		while($row = $jokes->fetch_assoc())
		{ 
			$content = $row['content'];
			
			echo"
				

				<div class='thumbnail'>
					<div class='caption'>
						<h3>$title</h3>
						<p>$content</p>
					</div>
				</div>
			";
		}
	}

	echo"</div></div>";
}

function GetLastThreeJokes() {

	$link=open_database_connection(); 

	$result = $link->query("SELECT * FROM jokes ORDER BY id DESC LIMIT 3 ");

		while($row = $result->fetch_assoc())
		{ 
			$id = $row['id'];
			$title = $row['title'];
			$content = $row['content'];
			$date_time = $row['date_time'];
			$user_id = $row['user_id'];
			
			$user_name = $link->query("SELECT * FROM users WHERE id = '$user_id'");

			while($row = $user_name->fetch_assoc())
			{
				$username = $row['username'];

				echo"
					<h2>$title</h2>
					<p>Dodal: $username</p>
					<p>$content</p>
				";
			}
		}

		echo "<p><a href='index.php?stran=vsi-vici'>Prikaži vse vice</a></p>";

	close_database_connection($link); 
}

function GetAllJokes() {

	$link=open_database_connection(); 

	$result = $link->query("SELECT * FROM jokes ORDER BY id DESC");

		while($row = $result->fetch_assoc())
		{ 
			$id = $row['id'];
			$title = $row['title'];
			$content = $row['content'];
			$date_time = $row['date_time'];
			
			echo"
				<h2>$title</h2>
				<p>$content</p>
			";
		}

	close_database_connection($link); 
}

?>
