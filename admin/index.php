<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';

//Admin lösenord
$adminPassword = "letmein";



?>
<!DOCTYPE html>
<html lang="sv">
	<head>
		<!--STANDARD INITIERING-->
		<title>Robot Wars Nacka Gymnasium</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<?php
		//Kolla ifall det finns POST information
		if ( isset($_POST['skicka']) && isset($_POST['input-password']) && trim($_POST['input-password']) != "" ) {
			//Rensa input
			include 'php/include/clear-data.php';
			$inputPassword = clearData($_POST['input-password']);
			//Kolla ifall lösenordet stämmer
			if ( $inputPassword == $adminPassword ) {
				$_SESSION['admin-loggedIn'] = true;
			}
		}
		//Be användaren att logga in
		else if ( !isset($_SESSION['admin-loggedIn']) ) {
			//Skriv ut form för att logga in
			echo '
				<form id="admin-login" method="POST" >
					<label>Ange lösenord</label>
					<input type="password" name="input-password">
					<button type="submit" name="skicka">Logga in</button>
				</form>
			';
		}	

		/* 
		 * Här kommer kod som skriver ut alla saker man kan göra, så som att välja användare osv
		 */
		if ( isset($_SESSION['admin-loggedIn']) ) {
			//Anslut till databasen och hämta alla användare
			include 'php/include/connect-database.php';
			$stmt = $conn->prepare("SELECT * FROM account");
			$stmt->execute();
			$res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			
			//Gå igenom listan och skriv ut allt i en fin tabell
			echo '<table border="1">';
				echo '<tr>';
					echo '<th>id</th>';
					echo '<th>username</th>';
					echo '<th>mail</th>';
					echo '<th>firstname</th>';
					echo '<th>lastname</th>';
					echo '<th>teamId</th>';
					echo '<th>imageURL</th>';
					echo '<th>ban</th>';
				echo '</tr>';
			for ($i=0; $i < count($res);$i++) {
				echo '<tr>';
					echo '<td>'.$res[$i]['id'].'</td>';
					echo '<td>'.$res[$i]['username'].'</td>';
					echo '<td>'.$res[$i]['mail'].'</td>';
					echo '<td>'.$res[$i]['firstname'].'</td>';
					echo '<td>'.$res[$i]['lastname'].'</td>';
					echo '<td>'.$res[$i]['teamId'].'</td>';
					echo '<td>'.$res[$i]['imageURL'].'</td>';
					echo '<td>'.$res[$i]['ban'].'</td>';
				echo '</tr>';
			}
			echo '</table>';

		}

		?>

	</body>
</html>
