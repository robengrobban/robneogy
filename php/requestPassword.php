<?php
include 'include/main-include.php';
include 'include/session-start.php';
include 'include/clear-data.php';

//Kolla ifall användaren är inloggad
include 'include/is-logged-in.php';
if ( isLoggedIn() ) {
	header("Location: ../index.php");
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
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/nav.css">
		<link rel="stylesheet" type="text/css" href="../css/skapaKonto.css">

	</head>
	<body>
		<!--TILLBAKA-->
		<nav id="back-nav">
			<ul>
				<li><a href="index.php">Hem</a></li>
			</ul>
		</nav>

		<?php
		//Kolla ifall man har klickat på återställ konto
		if ( isset($_POST['email']) && isset($_POST['reset']) ) {
			//Hämta mail
			$mail = clearData($_POST['email']);

			if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

				include 'include/connect-database.php';
				//Kolla ifall emailen är använd
				//Förbered en fråga
				$stmt = $conn->prepare('SELECT * FROM account WHERE mail = ?');
				$stmt->bind_param("s", $mail);
				$stmt->execute();

				//Spara reslutatet
				$res = $stmt->get_result();

				//Kolla ifall det finns några svar.
				if ( $res && $res->num_rows > 0 ) {
					//Skicka ett mail
					$row = $res->fetch_all(MYSQLI_ASSOC)[0];

					//Generera en veri key
					$veriKey = '';
					for( $i = 0; $i < 1000; $i++ ) {
					   $veriKey .= chr( rand( 65, 90 ) );
					}
					//Hämta användarnamn
					$userName = $row['username'];

					//Sätt in i databasen
					$stmt = $conn->prepare("UPDATE account SET veriKey = ? WHERE username = ? AND mail = ?");
					$stmt->bind_param("sss", $veriKey, $userName, $mail);
					$stmt->execute();

					//Skicka mailet
					// the message
					$url = "http://213.114.234.40/gymnasiearbete/robneogy/php/resetPassword.php";
					$link = $url . "?userEmail=" . $mail . "&userName=" . $userName . "&veriKey=" . $veriKey;
					$msg = "
					<html>
					  <body>
					  	<p>ÅTERSTÄLL NU!</p>
					  	<a href=\"".$link."\">Min länk</a>
					  </body>
					</html>
					";
					$headers  = "From: robotwarsnackagymnasium@gmail.com\r\n";
					$headers .= "Content-type: text/html\r\n";

					// send email
					$res = mail("robert.englund@edu.nacka.se","My subject",$msg, $headers);
					if ($res) {
						header("Location: success.php?success-msg=Ett mail har skickats till " . $mail . " med instruktioner om hur du kan återställa ditt lösenord.");
					}
					else {
						header("Location: error.php?error-msg=Kunde inte skicka mailet. Försök senare!");
					}

				} else {
					//Det fanns inte en sådan mail
					echo '<div id="error-msg">
							<p>Email addressen finns inte!</p>
						</div>';
				}

				//Stäng ansluitningat
				$stmt->close();
				$conn->close();

			} else {
				echo '<div id="error-msg">
						<p>Du skrev inte in en email!</p>
					</div>';
			}
		} else if ( isset($_POST['reset']) ) {
			echo '<div id="error-msg">
					<p>Du måste skriva in din email!</p>
				</div>';
		}
		?>

		<!--FROM FÖR INLOGG-->
		<form method="POST">

			<header>
				<h1>Återställ konto</h1>
			</header>

			<div id=email-container>
				<label for="email">Email:</label>
				<input required type="email" name="email" placeholder="Skriv email address">
			</div>

			<button type="submit" name="reset">Återställ</button>

		</form>

	</body>
</html>
