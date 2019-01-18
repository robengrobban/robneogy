<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';

//Kolla efter logout förfrågan
if ( isset($_GET['logout']) ) {
	include 'php/include/session-destroy.php';
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
		<link rel="stylesheet" type="text/css" href="css/index.css">

		<!--JQUERY LÄNK-->
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>

		<!--ANIMATION MED JS-->
		<script type="text/javascript" src="js/style/animate.js"></script>
		<!--MENU ÖPPNING MED JS-->
		<script type="text/javascript" src="js/style/nav.js"></script>

	</head>
	<body onload="animateFrontHeaderText()">

		<!--HEADER FÖR FRONT TEXT OCH BAKGRUNDSBILD-->
		<header id="front-page-header">
			<h1>Robot Wars<br>Nacka Gymnasium</h1>
		</header>

		<!--NAV FÖR STARTSIDAN-->
		<nav id="main-nav">
			<ul>
				<li id="menu"><a>Meny</a></li>
				<?php
				if ( !isset($_SESSION['user-teamId']) ) {
					echo '<li><a href="skapalag.php">Skapa lag</a></li>';
				}
				?>
				<li><a href="skapamatch.php">Skapa match</a></li>
				<?php
				//Kolla ifall användaren är inloggad
				include 'php/include/is-logged-in.php';
				if ( !isLoggedIn() ) {
					echo '<li><a href="skapakonto.php">Skapa konto</a></li>
							<li><a href="loggain.php">Logga in</a></li>';
				} else {
					echo '<li><a href="index.php?logout">Logga ut</a></li>';
				}
				?>
			</ul>
		</nav>

		<div id="container-matches">
			<!--SECTION FÖR UPPKOMMANDE MATCHER-->
			<div id="upcoming-matches">
				<h2>Kommande matcher</h2>
				<!--AUTOMATIKS PÅFYLLNING AV MATCHER-->
				<div>
					<p>
						<span class="team-one">LAG 1</span>
						<span class="team-vs">VS</span>
						<span class="team-two">LAG 2</span>
					</p>
				</div>

				<div>
					<p>
						<span class="team-one">LAG 1</span>
						<span class="team-vs">VS</span>
						<span class="team-two">LAG 2</span>
					</p>
				</div>

				<div>
					<p>
						<span class="team-one">LAG 1</span>
						<span class="team-vs">VS</span>
						<span class="team-two">LAG 2</span>
					</p>
				</div>

				<div>
					<p>
						<span class="team-one">LAG 1</span>
						<span class="team-vs">VS</span>
						<span class="team-two">LAG 2</span>
					</p>
				</div>
			</div>

			<!--SECTION FÖR AVKLARADE MATCHER-->
			<div id="completed-matches">
				<h2>Avslutade matcher</h2>
				<!--AUTOMATIKS PÅFYLLNING AV MATCHER-->
				<div>
					<p>
						<span class="team-one">LAG 1</span>
						<span class="team-vs">VS</span>
						<span class="team-two">LAG 2</span>
					</p>
				</div>

				<div>
					<p>
						<span class="team-one">LAG 1</span>
						<span class="team-vs">VS</span>
						<span class="team-two">LAG 2</span>
					</p>
				</div>

				<div>
					<p>
						<span class="team-one">LAG 1</span>
						<span class="team-vs">VS</span>
						<span class="team-two">LAG 2</span>
					</p>
				</div>
			</div>
		</div>

		<?php
		include 'footer-html.php';
		?>

	</body>
</html>
