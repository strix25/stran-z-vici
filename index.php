<?php

require_once'model.php';

if(isset($_COOKIE['user']))
{
	$username = $_COOKIE['user'];
  	$_SESSION["user"] = $username;
}

if (isset($_GET['stran']))
{
	if ($_GET['stran']=="prijava")
	{
		include 'template/prijava.html.php';
	} 
	else if ($_GET['stran']=="registracija")
	{	
		include 'template/registracija.html.php';
	}
	else if ($_GET['stran']=="profil")
	{	
		include 'template/profil.html.php';
	}
	else if ($_GET['stran']=="spremeni-geslo")
	{	
		include 'template/spremeni-geslo.html.php';
	}
	else if ($_GET['stran']=="pozabljeno-geslo")
	{	
		include 'template/pozabljeno-geslo.html.php';
	}
	else if ($_GET['stran']=="admin")
	{	
		include 'template/admin.html.php';
	}
	else if ($_GET['stran']=="dodaj-vic")
	{	
		include 'template/dodaj-vic.html.php';
	}
	else if ($_GET['stran']=="vici")
	{	
		include 'template/vici.html.php';
	}
	else if ($_GET['stran']=="vsi-vici")
	{	
		include 'template/vsi-vici.html.php';
	}
	else if ($_GET['stran']=="odjava")
	{	
		session_destroy();
		if(isset($_COOKIE['user']))
		{
			setcookie("user", $username, time() - 3600);
		}
		header('Location: index.php');
	}
	else
	{	
		include 'template/error.html.php';
	}
} 
else 
{	
	include 'template/index.html.php';
}

?> 