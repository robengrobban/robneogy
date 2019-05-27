<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';

//Kollar ifall adminen är inloggad
if ( !isset($_SESSION['admin-loggedIn']) ) {
	header("Location: index.php");
}

//Hämta information om användaren
include 'php/include/connect-database.php';
include 'php/include/clear-data.php';
$stmt = $conn->prepare("SELECT * FROM team WHERE id = ?");
$teamId = clearData($_GET['id']);
$stmt->bind_param("i", $teamId);
$stmt->execute();
$teamInfo = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];





?>
<!DOCTYPE html>
<html lang="sv">
	<head>
		<!--STANDARD INITIERING-->
		<title>Robot Wars Nacka Gymnasium</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/index.css">
	</head>
	<body>
		<form method="POST">
			<fieldset>
				<legend>Information om Lag</legend>
				<?php 
				
					//skirver ut lagnamn
				
				echo '<label>Lagnamn:</label><input name="input-teamname" type="text" value="'.$teamInfo['name'].'" >';

				//Kolla ifall knappen uppdatera har klickats på

				if ( isset($_POST['skicka-lagnamn']) && trim($_POST['input-teamname']) != "" ){

					//Spara datan
					$inputTeamName = clearData($_POST['input-teamname']);

					//Kolla så att det nya Lagnamnet
					include 'php/include/connect-database.php';
					$stmt = $conn->prepare("SELECT count(*) FROM team WHERE name = ? AND id != ?");
					$stmt->bind_param("si", $inputTeamName, $teamId);
					$stmt->execute();

					$res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['count(*)'];
					//Kolla ifall resultatet inte är 0
					if ( $res == 0 ) {

						//Ändra all information
						$stmt = $conn->prepare("UPDATE team SET name = ? WHERE id = ?");
						$stmt->bind_param("si", $inputTeamName, $teamId);
						$stmt->execute();

						//Stäng anslutningar
						$stmt->close();
						$conn->close();

						//Ladda om sidan
						header("Location: viewUser.php?id=" . $teamId);

					} else {
						//Error
						echo "<div id='error-msg'>Det Lagnamnet är redan taget. Kan inte ändra.</div>";
					}

					//Stäng anslutningar
					$stmt->close();
					$conn->close();

				} else if ( isset($_POST['skicka-namn']) ) {
					//Error
					echo "<div id='error-msg'>Alla fälten måste vara ifylda.</div>";
				}


				}


				?>

				<button name="skicka-lagnamn" type="submit">Uppdatera Lagnamn</button>

			</fieldset>
			
		</form>

	</body>
</html>
