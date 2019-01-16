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
		<link rel="stylesheet" type="text/css" href="css/skapalag.CSS">

	</head>

	<body>
		<!--TILLBAKA-->
			<nav id="back-nav">
				<ul>
					<li><a href="index.php">Hem</a></li>
				</ul>
			</nav>
		
		<header>
			<h1>Skapa Lag</h1>
		</header>

		<form method="POST">
			<div id="team-container">
				<label>Lag namn:</label>
				<input required type="text" name="team-name">
			</div>
			<button type="submit" name="create">Skapa</button>
		</form>

		<!--FOOTER-->
		<?php
		include 'footer-html.php';
		?>
		
	</body>
</html>