<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';

//Kolla ifall användaren inte är inloggad
include 'php/include/is-logged-in.php';
if ( !isLoggedIn() ) {
	header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="sv">
	<head>
		<!--STANDARD INITIERING-->
		<title>Robot Wars Nacka Gymnasium</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!--FONT LÄNK-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

		<!--STIL MED CSS-->
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/nav.css">
		<link rel="stylesheet" type="text/css" href="css/konto.css">

	</head>
	<body>
		<!--TILLBAKA-->
		<nav id="back-nav">
			<ul>
				<li><a href="index.php">Hem</a></li>
			</ul>
		</nav>

		<form method="POST">
			<header>
				<h1>Mitt konto: <?php echo $_SESSION['user-name'] ?></h1>
			</header>

			<div class="form-container">
				<label>Förnamn:</label>
				<input required name="firstname" type="text" value="<?php echo $_SESSION['user-firstname'] ?>">
			</div>

			<div class="form-container">
				<label>Efternamn:</label>
				<input required name="efternamn" type="text" value="<?php echo $_SESSION['user-lastname'] ?>">
			</div>

			<div class="form-container">
				<label>Email:</label>
				<input required name="email" type="email" value="<?php echo $_SESSION['user-email'] ?>">
			</div>

			<button type="submit">Uppdatera information</button>
		</form>

	</body>
</html>
