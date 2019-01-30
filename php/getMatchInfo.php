<?php 

include 'include/clear-data.php';



	if (isset($_POST['id'])) {

		//skriva ut en ajax fil med alla matcher som har ett visst ett.
	
		//Anslut till databasen
		include 'include/connect-database.php';


		//hämta matchId
		$matchId = clearData($_POST['id']);

		//om matchId == -1 så kommer den skriva ut alla matcher.
		if ($matchId == (-1)) {

			$stmt = $conn->prepare("SELECT * FROM game WHERE ? ORDER BY id DESC");
			$temp = 1;
			$stmt->bind_param("i", $temp);
			$stmt->execute();

			//Skriv ut resultatet i form av JSON
			echo json_encode( $stmt->get_result()->fetch_all(MYSQLI_ASSOC) );

			$stmt->close();

		}
		//annars skriv ut en specifik match.
		else{

			$stmt = $conn->prepare("SELECT * FROM game WHERE id = ? ORDER BY id DESC");
			$stmt->bind_param("i", $matchId);
			$stmt->execute();

			//Skriv ut resultatet i form av JSON
			echo json_encode( $stmt->get_result()->fetch_all(MYSQLI_ASSOC) );

			$stmt->close();
			
		}
			//Stäng anslutningar
			$conn->close();

	}

	else {
		//Skicka till error sidan ifall användare är här
		header("Location: error.php?error-msg=Åtkomst nekad!");
	}
	






 ?>