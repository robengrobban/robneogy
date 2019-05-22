<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';

//Kollar ifall adminen är inloggad
if ( !isset($_SESSION['admin-loggedIn']) ) {
	header("Location: index.php");
}

//Kolla ifall id inte är satt
if ( !isset($_GET['id']) ) {
	header("Location: panel.php");
}

//Hämta information om användaren
include 'php/include/connect-database.php';
include 'php/include/clear-data.php';
$stmt = $conn->prepare("SELECT * FROM account WHERE id = ?");
$userId = clearData($_GET['id']);
$stmt->bind_param("i", $userId);
$stmt->execute();
$accountInfo = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];

if ( $accountInfo == NULL ) {
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

		<link rel="stylesheet" type="text/css" href="css/index.css">
	</head>
	<body>

		<!--FORM FÖR ATT UPPDATERA NAMN-->
		<form method="POST">
			<fieldset>
				<legend>Information om namn</legend>
				<?php
				//Skriv ut information på ett trevligt sätt
				echo '<label>Förnamn:</label><input name="input-firstname" type="text" value="'.$accountInfo['firstname'].'" >';

				echo '<label>Användarnamn:</label><input name="input-username" type="text" value="'.$accountInfo['username'].'" >';

				echo '<label>Efternamn:</label><input name="input-lastname" type="text" value="'.$accountInfo['lastname'].'" >';

				
				//Kolla ifall knappen uppdatera har klickats på
				if ( isset($_POST['skicka-namn']) && isset($_POST['input-firstname']) && isset($_POST['input-username']) && isset($_POST['input-lastname']) && trim($_POST['input-firstname']) != "" && trim($_POST['input-username']) != "" && trim($_POST['input-lastname']) != "" ) {

					//Spara datan
					$inputFirstname = clearData($_POST['input-firstname']);
					$inputUsername = clearData($_POST['input-username']);
					$inputLastname = clearData($_POST['input-lastname']);

					//Kolla så att det nya användarnamnet funkar
					include 'php/include/connect-database.php';
					$stmt = $conn->prepare("SELECT count(*) FROM account WHERE username = ? AND id != ?");
					$stmt->bind_param("si", $inputUsername, $userId);
					$stmt->execute();

					$res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['count(*)'];
					//Kolla ifall resultatet inte är 0
					if ( $res == 0 ) {

						//Ändra all information
						$stmt = $conn->prepare("UPDATE account SET firstname = ?, username = ?, lastname = ? WHERE id = ?");
						$stmt->bind_param("sssi", $inputFirstname, $inputUsername, $inputLastname, $userId);
						$stmt->execute();

						//Stäng anslutningar
						$stmt->close();
						$conn->close();

						//Ladda om sidan
						header("Location: viewUser.php?id=" . $userId);

					} else {
						//Error
						echo "<div id='error-msg'>Det användarnamnet är redan taget. Kan inte ändra.</div>";
					}

					//Stäng anslutningar
					$stmt->close();
					$conn->close();

				} else if ( isset($_POST['skicka-namn']) ) {
					//Error
					echo "<div id='error-msg'>Alla fälten måste vara ifylda.</div>";
				}


				?>
				<button name="skicka-namn" type="submit">Uppdatera</button>
			</fieldset>
		</form>

		<div>
			<?php
			if ( isset($accountInfo['teamId']) && !is_null($accountInfo['teamId']) ) {
				echo '<a target="_blank" href="viewTeam.php?id='.$accountInfo['teamId'].'">Till användarens lag</a>';
			}
			?>
		</div>

		<div>
			<a target="_blank" href="mailto:<?php echo $accountInfo['mail'] ?>">Skicka mail</a>
		</div>

		<div>
			<button onclick="var x = document.getElementById('account-bild');if (x.style.display==='none'){x.style.display = 'block';}else{x.style.display = 'none';}"
			>
				Visa/Göm bild
			</button>

			<?php
			echo '<img id="account-bild" style="display:none;width:100%;height:auto;" src="../user/uploads/'.$accountInfo['imageURL'].'">';
			?>

		</div>

		<form method="POST">
			<fieldset>
				<legend>Avgör saker</legend>
				
				<label>Ban</label><input type="checkbox" name="input-ban" 
				<?php
				if ( $accountInfo['ban'] == 1 ) {
					echo 'checked';
				}
				?>
				>

				<?php
				//Kolla ifall knappen har klickats
				if ( isset($_POST['skicka-ban']) ) {
					//Hämta ifall checkbox:en är iklickad eller inte
					$inputBan = isset($_POST['input-ban']);

					//Avgör om det är 0 eller 1
					if ( $inputBan ) {
						$inputBan = 1;
					} else {
						$inputBan = 0;
					}
					
					//Uppdatera informationen i databasen
					include 'php/include/connect-database.php';
					$stmt = $conn->prepare("UPDATE account SET ban = ? WHERE id = ?");
					$stmt->bind_param("ii", $inputBan, $userId);
					$stmt->execute();

					//Stäng anslutningar
					$stmt->close();
					$conn->close();
					
					//Ladda om sidan
					header("Location: viewUser.php?id=" . $userId);

				}
				?>

				<button type="submit" name="skicka-ban">Uppdatera</button>

			</fieldset>
		</form>

		<table border="1">
			
			<thead>
				<tr>
					<th>id</th>
					<th>spel id</th>
					<th>innehåll</th>
				</tr>
			</thead>

			<tbody>
				<?php
				//Anslut till databas och hämta användarens kommentarer
				$stmt = $conn->prepare("SELECT * FROM comments WHERE accountId = ?");
				$stmt->bind_param("i", $userId);
				$stmt->execute();

				$res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
				for ( $i = 0; $i < count($res); $i++ ) {
					echo '<tr>';
						echo '<td><a href="viewComment.php?id='.$res[$i]['id'].'">'.$res[$i]['id'].'</a></td>';
						echo '<td><a href="viewGame.php?id='.$res[$i]['gameId'].'">'.$res[$i]['gameId'].'</a></td>';
						echo '<td>'.$res[$i]['content'].'</td>';
					echo '</tr>';
				}

				?>
			</tbody>

		</table>

	</body>
</html>
