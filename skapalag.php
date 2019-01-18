<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';
include 'php/include/clear-data.php';

//Kolla ifall användaren int är inloggad
include 'php/include/is-logged-in.php';
if ( !isLoggedIn() ) {
	header("Location: loggain.php");
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
			<h1>Skapa lag</h1>
		</header>

		<?php
		//Kolla så att man klickat på skapa lag
		if (isset($_POST['create']) &&
				isset($_POST['team-name']) && clearData('team-name') != ""
		) {
			//Hämta data
			$userTeamName = clearData($_POST['team-name']);

			//Kolla så att namnet är max 12 i längt
			if ( strlen($userTeamName) < 13 ) {

				//Anslut till databas
				include 'php/include/connect-database.php';

				//Kolla ifall det finns något namn med det namnet
				$stmt = $conn->prepare("SELECT name FROM team WHERE name = ?");
				$stmt->bind_param("s", $userTeamName);
				$stmt->execute();

				//Spara resultatet
				$res = $stmt->get_result();

				//Kolla ifall det fanns några svar
				if ( $res && $res->num_rows > 0 ) {
					//Finns redan ett lag med det namnet
					echo '<div id="error-msg">
							<p>Lagnamn är redan taget!</p>
						</div>';
				} else {
					//Skapa laget
					$stmt = $conn->prepare("INSERT INTO team (name) VALUES (?)");
					$stmt->bind_param("s", $userTeamName);
					$stmt->execute();

					//Hämta ID för laget
					$stmt = $conn->prepare("SELECT id FROM team WHERE name = ?");
					$stmt->bind_param("s", $userTeamName);
					$stmt->execute();

					//Spara id
					$userTeamId = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['id'];
					$_SESSION['user-teamId'] = $userTeamId;

					//Visa ruta att lag skapats
					echo '<div id="success-msg">
							<p>Laget med namnet '.$userTeamName.' har skapats!</p>
						</div>';
											
				}	

				//Stäng anslutningar
				$stmt->close();
				$conn->close();

			} else {
				echo '<div id="error-msg">
						<p>Lagnamn får inte vara större än 12 tecken!</p>
					</div>';
			}
		}
		//Ifall man klickar på knappen utan att fylla i något 
		else if ( isset($_POST['create']) ) {
			echo '<div id="error-msg">
					<p>Alla fält måste fyllas i!</p>
				</div>';
		}
		?>

		<form method="POST">
			<div id="team-container">
				<label>Lagnamn:</label>
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