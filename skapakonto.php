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
		<link rel="stylesheet" type="text/css" href="css/skapakonto.css">

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

			<div id=firstname-container>
				<label>Förnamn:</label>
				<input required type="text" name="firstname">
			</div>

			<div id="lastname-container">
				<label>Efternamn:</label>
				<input required type="text" name="lastname">
			</div>

			<div id="username-container">
				<label>Användarnamn:</label>
				<input required type="text" name="username">
			</div>

			<div id=email-container>
				<label>Email:</label>
				<input required type="email" name="email">
			</div>

			<div id="password-container">
				<label>Lösenord:</label>
				<input required type="password" name="password">

				<label>Återupprepa lösenord:</label>
				<input required type="password" name="password-rep">
			</div>


			<button type="submit" name="login">Logga in</button>

		</form>

		<!--FOOTER-->
		<?php
		include 'footer-html.php';
		?>
	</body>
</html>
