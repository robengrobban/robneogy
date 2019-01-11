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
		<link rel="stylesheet" type="text/css" href="css/skapamatch.css">

	</head>
	<body>
		<!--TILLBAKA-->
		<nav id="back-nav">
			<ul>
				<li><a href="index.php">Hem</a></li>
			</ul>
		</nav>

		<header>
			<h1>Skapa match</h1>
		</header>

		<form method="POST">
			<div id="search-container">
				<label id="my-team">Mitt lag</label>
				<label>VS</label>
				<input required type="text" name="search-team">
				<ul>
					<li><a href="#">SEARCH TEAM</a></li>
					<li><a href="#">SEARCH TEAM</a></li>
					<li><a href="#">SEARCH TEAM</a></li>
				</ul>
			</div>
			<button type="submit" name="create-match">Skapa match</button>
		</form>

		<!--FOOTER-->
		<?php
		include 'footer-html.php';
		?>
		
	</body>
</html>