<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';
//Kolla så att ett ID är satt
if (!isset($_GET['id'])) {
	header("Location: index.php");
}

//Kolla ifall matchen finns
include 'php/include/connect-database.php';
include 'php/include/clear-data.php';
$matchId = clearData($_GET['id']);
$stmt = $conn->prepare("SELECT count(id) FROM game WHERE id = ?");
$stmt->bind_param("i", $matchId);
$stmt->execute();
$res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['count(id)'];

//Kolla ifall antalet är 0, skicka i så fall iväg användaren
if ($res == 0) {
	header("Location: php/error.php?error-msg=Matchen med det ID:et finns inte!");
}
unset($res);

$haveVoted = false;
//Kolla ifall användaren har röstat
$stmt = $conn->prepare("SELECT * FROM votes WHERE accountId = ? AND gameId = ?");
$stmt->bind_param("ii", $_SESSION['user-id'], $_GET['id']);
$stmt->execute();
$res = $stmt->get_result();

//Kolla ifall ett svar fanns
if ( $res && $res->num_rows > 0 ) {
	$haveVoted = true;
}

//Kolla ifall användaren är inloggad
include 'php/include/is-logged-in.php';
$isLoggedIn = isLoggedIn();

//Stäng anslutningar
$stmt->close();
$conn->close();
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

		<!-- Funktion JS LÄNK-->
		<script type="text/javascript" src="js/funktioner.js"></script>

		<!--JS LÄNK-->
		<script type="text/javascript" src="js/match.js"></script>

	</head>
	<body
		<?php
		echo "onload=loadMatch(".$_GET['id'].")";
		?>
	>
		<!--TILLBAKA-->
		<nav id="back-nav">
			<ul>
				<li><a href="index.php">Hem</a></li>
			</ul>
		</nav>

		<header>
			<h1>Match</h1>
		</header>

		<?php
		if (!$haveVoted && $isLoggedIn) {

			//Logiken för att rösta
			$voterId = $_SESSION['user-id'];
			$voteTeam = "";
			$matchId = $_GET['id'];
			$voteIncrease = 1;

			//Kolla ifall användaren röstar på lag ett
			if (isset($_POST['röstLagEtt'])) {
				$voteTeam = "votesTeamOne";
			}
			//Kolla ifall användaren röstar på lag två
			else if (isset($_POST['röstLagTvå'])) {
				$voteTeam = "votesTeamTwo";
			}

			//Skicka rösten
			if ( isset($_POST['röstLagEtt']) || isset($_POST['röstLagTvå']) ) {
				//Anslut
				include 'php/include/connect-database.php';
				//Förbered fråga för att öka röst antalet
				$stmt = $conn->prepare("UPDATE game SET ".$voteTeam." = (".$voteTeam." + ?) WHERE id = ?");
				$stmt->bind_param("ii", $voteIncrease, $matchId);
				$stmt->execute();

				//Förberede fråga för att sätta in att användaren har röstat
				$stmt = $conn->prepare("INSERT INTO votes (accountId, gameId) VALUES (?, ?)");
				$stmt->bind_param("ii", $voterId, $matchId);
				$stmt->execute();

				//Ladda om sida för användaren
				header("Location: match.php?id=" . $_GET['id']);

				//Stäng anslutningar
				$stmt->close();
				$conn->close();
			}
		}
		?>

		<div id="match-container">

			<div id="team-one">
				<p class="team-name">L1</p>
				<div class="vote-container">
					<p class="votes">0</p>
					<?php
					if (!$haveVoted && $isLoggedIn) {
						echo '<form method="POST">
								<button type="submit" name="röstLagEtt" class="to-vote">Rösta</button>
						 	  </form>';
					}
					?>
				</div>
			</div>

			<div id="progress-container">
				<h2>VS</h2>
				<div id="progress">
					<div id="progress-value"></div>
				</div>
			</div>

			<div id="team-two">
				<p class="team-name">L2</p>
				<div class="vote-container">
					<p class="votes">0</p>
					<?php
					if (!$haveVoted && $isLoggedIn) {
						echo '<form method="POST">
								<button type="submit" name="röstLagTvå" class="to-vote">Rösta</button>
						 	  </form>';
					}
					?>
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
