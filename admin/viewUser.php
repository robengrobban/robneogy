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
	</head>
	<body>

	</body>
</html>
