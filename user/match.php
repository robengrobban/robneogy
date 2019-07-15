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
unset($res);


//Kolla ifall matchen är klar
$matchDone = false;
$stmt = $conn->prepare("SELECT done FROM game WHERE id = ?");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['done'];
//Ifall klar, sätt variabel till true
if ( $res == 1 ) {
	$matchDone = true;
}
unset($res);


//Hämta det id för den som skapade sidan
$stmt = $conn->prepare("SELECT accountId FROM game WHERE id = ?");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$matchCreatorId = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['accountId'];


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

		<!--JS MATCHER LÄNK-->
		<script type="text/javascript" src="js/match.js"></script>

		<!--JS KOMMENTARER LÄNK-->
		<script type="text/javascript" src="js/comment.js"></script>

	</head>
	<body
			<?php
			echo "onload='loadMatch(".$_GET['id']."), loadComments(".$_GET['id']."), startCommentLoad(".$_GET['id'].")'";
			?>
		>
		<!--TILLBAKA-->
		<nav id="back-nav">
			<ul>
				<li><a href="index.php">Hem</a></li>
			</ul>
		</nav>

		<div id="shadow-container"> 

			<header>
				<h1>Match</h1>
			</header>

			<?php
			if (!$haveVoted && $isLoggedIn && !$matchDone) {

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
						if (!$haveVoted && $isLoggedIn && !$matchDone) {
							echo '<form method="POST">
									<button type="submit" name="röstLagEtt" class="to-vote">Rösta</button>
							 	  </form>';
						} else if ( $haveVoted ) {
							echo '<button disabled title="Du har redan röstat!" class="to-vote need-login">Rösta</button>';
						} else if ( $matchDone ) {
							echo '<button disabled title="Matchen är klar. Du kan inte rösta!" class="to-vote need-login">Rösta</button>';
						} else {
							echo '<button disabled title="Du måste logga in för att rösta!" class="to-vote need-login">Rösta</button>';
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
						//Olika fall beroende på ifall användaren har röstat eller inte
						if (!$haveVoted && $isLoggedIn && !$matchDone) {
							echo '<form method="POST">
									<button type="submit" name="röstLagTvå" class="to-vote">Rösta</button>
							 	  </form>';
						} else if ( $haveVoted ) {
							echo '<button disabled title="Du har redan röstat!" class="to-vote need-login">Rösta</button>';
						} else if ( $matchDone ) {
							echo '<button disabled title="Matchen är klar. Du kan inte rösta!" class="to-vote need-login">Rösta</button>';
						} else {
							echo '<button disabled title="Du måste logga in för att rösta!" class="to-vote need-login">Rösta</button>';
						}
						?>
					</div>
				</div>

				<?php
				//Skirv ut vinnar panel
				if ( !$matchDone && $matchCreatorId == $_SESSION['user-id'] ) {
					echo '<form id="choose-winner" method="POST">
								<label>Avgör vinnare</label><input required name="confirm" type="checkbox">
								<button type="submit" name="winner-team-one" id="team-one-name">L1</button>
								<button type="submit" name="winner-team-two" id="team-two-name">L2</button>
							</form>';
				}
				//Logiken för att avgöra vilket lag som vann
				if (!$matchDone && $matchCreatorId == $_SESSION['user-id'] && isset($_POST['confirm']) && (isset($_POST['winner-team-one']) || isset($_POST['winner-team-two'])) ) {
					$setWinner = "";
					if ( isset($_POST['winner-team-one']) ) {
						$setWinner = "teamIdOne";
					} else if ( isset($_POST['winner-team-two']) ) {
						$setWinner = "teamIdTwo";
					}
					//Skicka förfrågan om att uppdatera den som vann matchen
					include 'php/include/connect-database.php';
					$stmt = $conn->prepare("UPDATE game SET winnerId = ".$setWinner.", done = 1 WHERE id = ?");
					$stmt->bind_param("i", $_GET['id']);
					$stmt->execute();

					//Stäng anslutningar
					$stmt->close();
					$conn->close();

					//Skicka tillbaka användaren
					header("Location: match.php?id=" . $_GET['id']);
				}
				?>

			</div>

			<?php

			if ( $isLoggedIn && isset($_POST['the-comment']) && clearData($_POST['the-comment']) != "" ) {

				//Hämta kommentaren
				$kommentar = clearData($_POST['the-comment']);

				//Möter kommentaren kravet för storlek?
				if (strlen($kommentar)>256) {
					echo '<div id="error-msg">
							<p>Kommentaren överskrider maximala antalet tecken!</p>
						</div>';
				} else {
					//Anslut
					include 'php/include/connect-database.php';

					$stmt = $conn->prepare("INSERT INTO comments (accountId, gameId, content) VALUES (?,?,?)");
					$stmt->bind_param("iis", $_SESSION['user-id'], $_GET['id'], $kommentar);
					$stmt->execute();

					//Ladda om sidan
					header("Location: match.php?id=" . $_GET['id']);

					//Stäng anslutningar
					$stmt->close();
					$conn->close();
				}

			} else if (isset($_POST['the-comment'])) {
				echo '<div id="error-msg">
						<p>Kommentar saknas!</p>
					</div>';
			}

			?>

			<div id="comment-container">

				<div id="the-comments">
					<!--<section class="comment">
						<p>
							Jag har en fin kommentar som jag vil dela med mig!
						</p>
						<span>
							Herbert
						</span>
					</section>-->
				</div>

				<form id="to-comment" method="POST">
					<label>Kommentar:</label>
					<textarea required placeholder="En kommentar..." form="to-comment" name="the-comment" maxlength="256"></textarea>
					<?php
					if ( !$isLoggedIn ) {
						echo '<button disabled title="Måste logga in för att kommentera!" class="need-login" type="submit" name="skicka">Kommentera</button>';
					} else {
						echo '<button type="submit" name="skicka">Kommentera</button>';
					}
					?>

				</form>

			</div>
		</div>

		<!--FOOTER-->
		<?php
		include 'footer-html.php';
		?>
	</body>
</html>
