<?php
/*
 * Denna fils syfte är att hämta information om ett lag som en användare söker efter.
 * Ifall man inte söker på något ska alla lag hämtas.
 * Filen ska echo ut JSON text. Vilket betyder att en JS fil kommer använda
 * AJAX för att hämta datan och presentera den
*/

include 'include/clear-data.php';

if ( isset($_POST['gameId']) ) {

	//Hämta datan
	$gameId = clearData($_POST['gameId']);

	//Anslut till databasen
	include 'include/connect-database.php';

	//Förbered en fråga
	$stmt = $conn->prepare("SELECT comments.*, account.username FROM comments, account WHERE gameId = ? AND account.id = comments.accountId");
	$stmt->bind_param("i", $gameId);
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
