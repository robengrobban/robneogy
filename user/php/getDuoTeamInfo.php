<?php


include 'include/clear-data.php';

if ( isset($_POST['team-one-id']) && isset($_POST['team-two-id']) ) {

	//Hämta datan
	$teamOneId = clearData($_POST['team-one-id']);
	$teamTwoId = clearData($_POST['team-two-id']);

	//Anslut till databasen
	include 'include/connect-database.php';

	//Förbered en fråga
	$stmt = $conn->prepare("SELECT * FROM team WHERE id = ? OR id = ?");
	$stmt->bind_param("ii", $teamOneId, $teamTwoId);
	//Kör frågan
	$stmt->execute();

	//Skriv ut resultatet i form av JSON
	echo json_encode( $stmt->get_result()->fetch_all(MYSQLI_ASSOC) );

	//Stäng anslutningar
	$stmt->close();
	$conn->close();

} else {
	//Skicka till error sidan ifall användare är här
	header("Location: error.php?error-msg=Åtkomst nekad!");
}


?>