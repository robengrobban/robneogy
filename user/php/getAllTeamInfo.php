<?php


include 'include/clear-data.php';

if ( isset($_POST['confirm']) ) {
	//Anslut till databasen
	include 'include/connect-database.php';

	//Förbered en fråga
	$temp = 1;
	$stmt = $conn->prepare("SELECT * FROM team WHERE ?");
	$stmt->bind_param("i", $temp);
	//Kör frågan
	$stmt->execute();

	//Skriv ut resultatet i form av JSON
	echo json_encode( $stmt->get_result()->fetch_all(MYSQLI_ASSOC) );

	//Stäng anslutningar
	$stmt->close();
	$conn->close();
}
else {
	//Skicka till error sidan ifall användare är här
	header("Location: error.php?error-msg=Åtkomst nekad!");
}

?>