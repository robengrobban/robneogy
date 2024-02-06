<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';

//Kollar ifall adminen är inloggad
if ( !isset($_SESSION['admin-loggedIn']) ) {
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

		<!--JQUERY LÄNK-->
		<script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>

		<!--JS LÄNK-->
		<script type="text/javascript" src="js/panel.js"></script>
	</head>
	<body onload="loadAccount('')">
		<h1>Användare</h1>
		<label>Sök användare: <input type="text" oninput="loadAccount(this.value)"></label>
		<table id="search-account" border="1" >
			<thead>
				<tr>
					<th>id</th>
					<th>username</th>
					<th>mail</th>
					<th>firstname</th>
					<th>lastname</th>
					<th>teamId</th>
					<th>imageURL</th>
					<th>ban</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>


		<?php
		//Anslut till databasen och hämta alla användare
		include 'php/include/connect-database.php';
		//Hämta information om lag
		$stmt = $conn->prepare("SELECT * FROM team");
		$stmt->execute();
		$res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		//Gå igenom listan och skriv ut allt i en fin tabell
		echo '<h1>Lag</h1><table border="1">';
			echo '<tr>';
				echo '<th>id</th>';
				echo '<th>name</th>';
			echo '</tr>';
		for ($i=0; $i < count($res);$i++) {
			echo '<tr>';
				echo '<td><a target="_blank" href="viewTeam.php?id='.$res[$i]['id'].'">'.$res[$i]['id'].'</a></td>';
				echo '<td>'.$res[$i]['name'].'</td>';
			echo '</tr>';
		}
		echo '</table>';

		//Hämta information om matcher
		$stmt = $conn->prepare("SELECT * FROM game");
		$stmt->execute();
		$res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		//Gå igenom listan och skriv ut allt i en fin tabell
		echo '<h1>Matcher</h1><table border="1">';
			echo '<tr>';
				echo '<th>id</th>';
				echo '<th>accountId</th>';
				echo '<th>teamIdOne</th>';
				echo '<th>teamIdTwo</th>';
				echo '<th>done</th>';
				echo '<th>winnerID</th>';
				echo '<th>votesTeamOne</th>';
				echo '<th>votesTeamTwo</th>';
			echo '</tr>';
		for ($i=0; $i < count($res);$i++) {
			echo '<tr>';
				echo '<td><a target="_blank" href="viewGame.php?id='.$res[$i]['id'].'">'.$res[$i]['id'].'</a></td>';
				echo '<td><a target="_blank" href="viewUser.php?id='.$res[$i]['accountId'].'">'.$res[$i]['accountId'].'</a></td>';
				echo '<td><a target="_blank" href="viewTeam.php?id='.$res[$i]['teamIdOne'].'">'.$res[$i]['teamIdOne'].'</a></td>';
				echo '<td><a target="_blank" href="viewTeam.php?id='.$res[$i]['teamIdTwo'].'">'.$res[$i]['teamIdTwo'].'</a></td>';
				echo '<td>'.$res[$i]['done'].'</td>';
				echo '<td><a target="_blank" href="viewTeam.php?id='.$res[$i]['winnerId'].'">'.$res[$i]['winnerId'].'</a></td>';
				echo '<td>'.$res[$i]['votesTeamOne'].'</td>';
				echo '<td>'.$res[$i]['votesTeamTwo'].'</td>';
			echo '</tr>';
		}
		echo '</table>';


		//Hämta information om kommentarer
		$stmt = $conn->prepare("SELECT * FROM comments");
		$stmt->execute();
		$res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		//Gå igenom listan och skriv ut allt i en fin tabell
		echo '<h1>Kommentarer</h1><table border="1">';
			echo '<tr>';
				echo '<th>id</th>';
				echo '<th>accountId</th>';
				echo '<th>gameId</th>';
				echo '<th>content</th>';
			echo '</tr>';
		for ($i=0; $i < count($res);$i++) {
			echo '<tr>';
				echo '<td><a target="_blank" href="viewComment.php?id='.$res[$i]['id'].'">'.$res[$i]['id'].'</a></td>';
				echo '<td><a target="_blank" href="viewUser.php?id='.$res[$i]['accountId'].'">'.$res[$i]['accountId'].'</a></td>';
				echo '<td><a target="_blank" href="viewGame.php?id='.$res[$i]['gameId'].'">'.$res[$i]['gameId'].'</a></td>';
				echo '<td>'.$res[$i]['content'].'</td>';
			echo '</tr>';
		}
		echo '</table>';


		//Stäng anslutningar
		$stmt->close();
		$conn->close();

		?>

	</body>
</html>
