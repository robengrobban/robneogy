<?php
//Skapa anslutnings variabler
$serverip = "127.0.0.1";

$username = "robneogy";

$password = "BQw3obdO8w9YhQ7v";

$database = "databaseGy";

//Skapa anslutningsobjekt
$conn = new mysqli( $serverip , $username , $password , $database );

//Snabb error hantering
if ( $conn->connect_error ) {
	die();
	header("Location: php/error.php?error-msg=" . $conn->connect_error . "");
} else {
	//Skicka en förfågan till databasen att använda UTF-8
	$conn->query("SET NAMES utf8");
}

?>
