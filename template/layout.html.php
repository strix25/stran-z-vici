<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">

		<title><?php echo $title; ?></title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		
		<link rel="stylesheet" href="style/main.css">
	</head>

	<body>
		<div id="top"><?php if(isset($_SESSION["user"])){echo "Pozdravljen " . $_SESSION["user"];}else{
			echo"Če se želite prijaviti kliknite <a href='index.php?stran=prijava'>tukaj</a>";} ?></div>

		<div class="container">
			<div id="logo">
				<h1>Najboljši</h1>  
				<h1><img src="style/images/logo.png" alt="" height="80" width="80"></h1> 
			    <h1>vici vseh časov</h1>  
			</div>
		</div>

		<div class="container">

			<nav class="navbar navbar-default">
				<div class="container-fluid">

				  <div class="navbar-header">
				  	 <a class="navbar-brand" href="">
				        <img alt="Brand" src="style/images/logo.png" height="40" width="40">
				      </a>
				  </div>

				  <div id="navbar" class="navbar-collapse collapse">

				    <ul class="nav navbar-nav">
				      <li class="active"><a href="index.php">naslovnica</a></li>
				      <li><a href="index.php?stran=vici">vici</a></li>
				      <li><a href=""></a></li>
				    </ul>

				    <ul class="nav navbar-nav navbar-right">
				    	<?php 
				    	if(isset($_SESSION["user"]))
				    	{
				    		echo'<li><a href="index.php?stran=admin">Administratoska plošča</a></li>';
				    		echo'<li><a href="index.php?stran=odjava">odjava</a></li>';
				    		echo'<li><a href="index.php?stran=profil">profil</a></li>';
				    	}
				    	else
				    	{
				    		echo'<li><a href="index.php?stran=prijava">prijava</a></li>';
				    	}
				    	?>
				      <li><a href="index.php?stran=registracija">registracija</a></li>
				    </ul>

				  </div>

				</div>

			</nav>

		</div>

		<div class="container">
			<?php echo $content; ?>
		</div>

	</body>

</html>