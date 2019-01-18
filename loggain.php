<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';
include 'php/include/clear-data.php';

//Kolla ifall användaren är inloggad
include 'php/include/is-logged-in.php';
if ( isLoggedIn() ) {
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
		<link rel="stylesheet" type="text/css" href="css/loggain.css">

	</head>
	<body>
		<!--TILLBAKA-->
		<nav id="back-nav">
			<ul>
				<li><a href="index.php">Hem</a></li>
			</ul>
		</nav>

		<header>
			<h1>Logga in</h1>
		</header>

		<?php
		//Kolla så att knappen har klickats och att alla fällt är ifyllda
		if ( isset($_POST['create']) && 
			isset($_POST['username']) && clearData($_POST['username']) != "" &&
			isset($_POST['password']) && clearData($_POST['password']) != "" )
		{

			//Spara data och rensa den
			$userName = clearData($_POST['username']);
			$userPassword = clearData($_POST['password']);


		}
		//Kolla så att man faktiskt har tryckt på knappen
		else if (isset($_POST['create'])) {
			echo '<div id="error-msg">
					<p>Alla fält måste fyllas i!</p>
				</div>';
		}
		?>

		<!--FROM FÖR INLOGG-->
		<form method="POST">

			<div id="username-container">
				<label>Användarnamn:</label>
				<input required type="text" name="username">
			</div>

			<div id="password-container">
				<label>Lösenord:</label>
				<input required type="password" name="password">
			</div>

			<button type="submit" name="login">Logga in</button>

		</form>

		<!--FOOTER-->
		<?php
		include 'footer-html.php';
		?>
	</body>
</html>
