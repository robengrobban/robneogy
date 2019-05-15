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
		<link rel="stylesheet" type="text/css" href="css/index.css">
	</head>
	<body>

		<form id="admin-login" method="POST" >
			<label>Ange lösenord</label>
			<input type="password" name="input-password">
			<button type="submit" name="skicka">Logga in</button>
		</form>
		
		<?php
		//Kolla ifall det finns POST information
		if ( isset($_POST['skicka']) && isset($_POST['input-password']) && trim($_POST['input-password']) != "" ) {
			//Rensa input
			include 'php/include/clear-data.php';
			$inputPassword = clearData($_POST['input-password']);
			//Kolla ifall lösenordet stämmer
			if ( $inputPassword == $adminPassword ) {
				$_SESSION['admin-loggedIn'] = true;
				header("Location: panel.php");
			}
		}
		?>

	</body>
</html>
