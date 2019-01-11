<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';
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
