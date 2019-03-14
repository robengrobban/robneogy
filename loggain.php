<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';
include 'php/include/clear-data.php';

//Kolla ifall användaren är inloggad
include 'php/include/is-logged-in.php';
if ( isLoggedIn() ) {
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

		<!--FONT LÄNK-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

		<!--STIL MED CSS-->
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/nav.css">
		<link rel="stylesheet" type="text/css" href="css/loggain.css">

	</head>
	<body>
		<!--TILLBAKA-->
		<nav id="back-nav">
			<ul>
				<li><a href="index.php">Hem</a></li>
			</ul>
		</nav>

		<?php
		//Kolla så att knappen har klickats och att alla fällt är ifyllda
		if ( isset($_POST['login']) &&
			isset($_POST['username']) && clearData($_POST['username']) != "" &&
			isset($_POST['password']) && clearData($_POST['password']) != "" )
		{

			//Spara data och rensa den
			$userName = clearData($_POST['username']);
			$userPassword = clearData($_POST['password']);

			//Anslut till databasen
			include "php/include/connect-database.php";

			//Förbered en fråga
			$stmt = $conn->prepare("SELECT * FROM account WHERE username = ? OR mail = ?");
			$stmt->bind_param ("ss", $userName, $userName);
			//Kör
			$stmt->execute();

			//Hämta resultatet
			$res = $stmt->get_result();

			//Kolla ifall vi inte fick ett svar, i så fall skicka fel meddelande
			if ($res->num_rows==0) {
				echo '<div id="error-msg">
					<p>Fel användarnamn/email eller lösenord</p>
				</div>';
			}
			else{
				//Hämta resultatet
				$res=$res->fetch_all(MYSQLI_ASSOC)[0];
				//Kolla ifall lösenordet stämmer
				if (password_verify($userPassword, $res["password"])) {
					//Hämta data och spara det i en session
					$_SESSION["user-id"]=$res["id"];
					$_SESSION["user-name"]=$res["username"];
					$_SESSION["user-email"]=$res["mail"];
					$_SESSION["user-firstname"]=$res["firstname"];
					$_SESSION["user-lastname"]=$res["lastname"];
					//Ifall användaren har ett ID spara det i en session
					if (isset($res["teamId"])) {
						$_SESSION["user-teamId"]=$res["teamId"];
					}
					//Stäng anslutningarna
					$stmt->close();
					$conn->close();

					//Skicka användaren till startsidan
					header("Location: index.php");

				}
				//Fel användarnamn eller lösenord.
				else{
				echo '<div id="error-msg">
					<p>Fel användarnamn eller lösenord</p>
				</div>';
				}
			}
			//Stänger anslutningar
			$stmt->close();
			$conn->close();

		}
		//Kolla så att man faktiskt har tryckt på knappen
		else if (isset($_POST['login'])) {
			echo '<div id="error-msg">
					<p>Alla fält måste fyllas i!</p>
				</div>';
		}
		?>

		<!--FORM FÖR INLOGG-->
		<form method="POST">

			<header>
				<h1>Logga in</h1>
			</header>

			<div id="username-container">
				<label>Användarnamn eller email:</label>
				<input required type="text" name="username" placeholder="Skriv användarnamn eller email">
			</div>

			<div id="password-container">
				<label for="password">Lösenord:</label>
				<input required type="password" name="password" placeholder="Skriv lösenord">
			</div>

			<span><a href="php/requestPassword.php">Glömt lösenord? Återställ det!</a></span>

			<button type="submit" name="login">Logga in</button>

		</form>

		<!--FOOTER-->
		<?php
		include 'footer-html.php';
		?>
	</body>
</html>
