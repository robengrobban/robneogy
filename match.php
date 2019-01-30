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
		<link rel="stylesheet" type="text/css" href="css/match.css">

		<!--JQUERY LÄNK-->
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		
		<!--JS LÄNK-->
		<script type="text/javascript" src="js/match.js"></script>

	</head>
	<body>
		<!--TILLBAKA-->
		<nav id="back-nav">
			<ul>
				<li><a href="index.php">Hem</a></li>
			</ul>
		</nav>

		<header>
			<h1>Match</h1>
		</header>

		<div id="match-container">

			<div id="team-one">
				<p class="team-name">LAG 1</p>
				<div class="vote-container">
					<p class="votes">50</p>
					<button class="to-vote">Rösta</button>
				</div>
			</div>

			<div id="progress-container">
				<h2>VS</h2>
				<div id="progress">
					<div id="progress-value"></div>
				</div>
			</div>

			<div id="team-two">
				<p class="team-name">Lag 2</p>
				<div class="vote-container">
					<p class="votes">10</p>
					<button class="to-vote">Rösta</button>
				</div>
			</div>

		</div>

		<div id="comment-container">

			<section class="comment">
				<p>
					Jag har en fin kommentar som jag vil dela med mig!
				</p>
				<span>
					Herbert
				</span>
			</section>

			<form id="to-comment" method="POST">
				<label>Kommentar:</label>
				<textarea required form="to-comment" name="the-comment" maxlength="256"></textarea>
				<button type="submit" name="skicka">Kommentera</button>
			</form>

		</div>

		<!--FOOTER-->
		<?php
		include 'footer-html.php';
		?>
	</body>
</html>
