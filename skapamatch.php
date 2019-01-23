<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';
include 'php/include/clear-data.php';

//Kolla ifall användaren int är inloggad
include 'php/include/is-logged-in.php';
if ( !isLoggedIn() ) {
	header("Location: loggain.php");
}

//Kolla ifall man inte har ett lag
if ( !isset($_SESSION['user-teamId']) ) {
	header("Location: php/error.php?error-msg=Du har inget lag!");
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
		<link rel="stylesheet" type="text/css" href="css/skapamatch.css">

		<!--JQUERY LÄNK-->
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>

		<!--SÖKNING MED JS-->
		<script type="text/javascript" src="js/team.js"></script>

	</head>
	<body onload="loadTeam('', <?php echo $_SESSION['user-teamId'];?>)">
		<!--TILLBAKA-->
		<nav id="back-nav">
			<ul>
				<li><a href="index.php">Hem</a></li>
			</ul>
		</nav>

		<header>
			<h1>Skapa match</h1>
		</header>

		<?php
		//Kolla så att ett lagnamn har skrivits in
		if ( isset($_POST['search-team']) && clearData($_POST['search-team']) != "" ) {
			//Spara data och rensa inputen
			$searchTeam = clearData($_POST['search-team']);

			//Anslut till databasen
			include 'php/include/connect-database.php';

			//Kolla ifall det inskrivna laget är samma som skaparens lag
			//Detta kan göras utan prepare statement eftersom användaren
			//Påverark inte datan som skrivs in
			$res = $conn->query("SELECT name FROM team WHERE id = " . $_SESSION['user-teamId']);
			$res = $res->fetch_all(MYSQLI_ASSOC)[0]['name'];

			//Kolla ifall de är samma
			if ($res != $searchTeam) {

				//Kolla ifall det inskrivna laget finns
				$stmt = $conn->prepare("SELECT * FROM team WHERE name = ?");
				$stmt->bind_param("s", $searchTeam);
				//Kör frågan
				$stmt->execute();
				//Spara resultatet
				$res2 = $stmt->get_result();

				//Kolla ifall något svar fick. I så fall finns det ett lag med det namnet
				if ( $res2 && $res2->num_rows > 0) {

					//Laget finns, dags att skapa en match
					//Detta görs genom att sätta in lagen i match tabellen

					//Hämta ID för det andra laget
					$idAccount = $_SESSION['user-id'];
					$idTeamOne = $res2->fetch_all(MYSQLI_ASSOC)[0]['id'];
					$idTeamTwo = $_SESSION['user-teamId'];
					$done = 0;
					$votesTeamOne = 1;
					$votesTeamTwo = 1;

					//Skapa en fråga för databasen
					$stmt->prepare("INSERT INTO game (accountId, teamIdOne, teamIdTwo, done, votesTeamOne, votesTeamTwo) VALUES (?,?,?,?,?,?);");
					$stmt->bind_param("iiiiii", $idAccount, $idTeamOne, $idTeamTwo, $done, $votesTeamOne, $votesTeamTwo);
					//Skapa match
					$stmt->execute();

					//Klar meddelande
					header("Location: php/success.php?success-msg=En match mellan lagen ".$searchTeam." och ".$res." har skapats!");

				} else {
					echo '<div id="error-msg">
						<p>Laget du försöker spela mot finns inte!</p>
					</div>';
				}

				$stmt->close();

			} else {
				echo '<div id="error-msg">
					<p>Du kan inte skapa en match mot dig själv!</p>
				</div>';
			}

			//Stäng anslutning
			$conn->close();

		} else if (isset($_POST['search-team'])) {
			echo '<div id="error-msg">
					<p>Ett lag namn måste fyllas i!</p>
				</div>';
		}
		?>

		<form method="POST">
			<div id="search-container">
				<label id="my-team">Mitt lag</label>
				<label>VS</label>
				<input required type="text" name="search-team" oninput="loadTeam(this.value, <?php
						echo $_SESSION['user-teamId'];
					?>)">
				<ul>
					
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