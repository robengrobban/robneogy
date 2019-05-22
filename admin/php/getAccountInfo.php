<?php 
include 'include/clear-data.php';
if (isset($_POST['username'])) {

	//Anslut till databasen
	include 'include/connect-database.php';

	//Hämta username
	$username = clearData($_POST['username']);
	$stmt = $conn->prepare("SELECT * FROM account WHERE username LIKE ?");
	//Fixa username
	$username = "%".$username."%";
	$stmt->bind_param("s", $username);
	$stmt->execute();

	//Skriv ut resultatet i form av JSON
	echo json_encode( $stmt->get_result()->fetch_all(MYSQLI_ASSOC) );

	$stmt->close();
	$conn->close();
}
 ?>