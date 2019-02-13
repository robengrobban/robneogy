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
		<link rel="stylesheet" type="text/css" href="css/skapakonto.css">

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
		if ( isset($_POST['create']) &&
			isset($_POST['firstname']) && clearData($_POST['firstname']) != "" &&
			isset($_POST['lastname']) && clearData($_POST['lastname']) != "" &&
			isset($_POST['username']) && clearData($_POST['username']) != "" &&
			isset($_POST['email']) && clearData($_POST['email']) != "" &&
			isset($_POST['password']) && clearData($_POST['password']) != "" &&
			isset($_POST['password-rep']) && clearData($_POST['password-rep']) != "")
		{
			//Spara datan och rensa den
			$userFirstname = clearData($_POST['firstname']);
			$userLastname = clearData($_POST['lastname']);
			$userName = clearData($_POST['username']);
			$userEmail = clearData($_POST['email']);
			$userPassword = clearData($_POST['password']);
			$userPasswordRep = clearData($_POST['password-rep']);

			//Kontrolera att lösenorden stämmer
			if ( $userPassword == $userPasswordRep ) {
				//Stämmer, fortsätt

				//Kolla så att lösenordet är 8 tecken långt och siffra
				if ( preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,100}$/', $userPassword) ) {
					//Funkar, forstätt

					//Validera att emailen är en korrekt email
					if ( filter_var($userEmail, FILTER_VALIDATE_EMAIL) ) {
						//Funkar, forstätt

						//Kolla så att användarnamnet inte redan finns

						//Anslut till databas
						include 'php/include/connect-database.php';

						//Förbered en fråga
						$stmt = $conn->prepare('SELECT username FROM account WHERE username = ?');
						$stmt->bind_param("s", $userName);
						$stmt->execute();

						//Spara reslutatet
						$res = $stmt->get_result();

						//Kolla ifall det finns några svar.
						if ( $res && $res->num_rows > 0 ) {
							//Finns ett konto! Avbryt
							echo '<div id="error-msg">
									<p>Användarnamnet är redan upptaget!</p>
								</div>';
						} else {
							//Kolla ifall emailen är använd
							//Förbered en fråga
							$stmt = $conn->prepare('SELECT username FROM account WHERE mail = ?');
							$stmt->bind_param("s", $userEmail);
							$stmt->execute();

							//Spara reslutatet
							$res = $stmt->get_result();

							//Kolla ifall det finns några svar.
							if ( $res && $res->num_rows > 0 ) {
								//Finns ett konto! Avbryt
								echo '<div id="error-msg">
										<p>Email addressen är redan upptagen!</p>
									</div>';
							} else {
								//Skapa konto
								$stmt = $conn->prepare("INSERT INTO account (username, mail, firstname, lastname, password) VALUES (?,?,?,?,?)");
								$stmt->bind_param("sssss", $userName, $userEmail, $userFirstname, $userLastname, $userPassword);

								//Hasha lösenordet
								$userPassword = password_hash($userPassword, PASSWORD_DEFAULT);

								//Skapa konto
								$stmt->execute();

								//Hämta ID för skapade kontot
								$stmt = $conn->prepare("SELECT id FROM account WHERE username = ?");
								$stmt->bind_param("s", $userName);
								$stmt->execute();
								//Spara id
								$userId = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['id'];

								//Spara i sessionen våra värden
								$_SESSION['user-id'] = $userId;
								$_SESSION['user-name'] = $userName;
								$_SESSION['user-email'] = $userEmail;
								$_SESSION['user-firstname'] = $userFirstname;
								$_SESSION['user-lastname'] = $userLastname;

								//Stäng anslutningar
								$stmt->close();
								$conn->close();

								//Lyckades
								header("Location: php/success.php?success-msg=Hej! " . $userFirstname . " " . $userLastname . ". Ditt konto med namnet " . $userName . " har skapats!");
								}
						}

						//Stäng anslutningar
						$stmt->close();
						$conn->close();
					} else {
						//Funkar inte, error
						echo '<div id="error-msg">
							<p>Måster skriva in en korrekt email!</p>
						</div>';
					}

				} else {
					//Funkar inte, error
					echo '<div id="error-msg">
						<p>Lösenorden måste vara 8 tecken långt, inte fler än 100. Måste innehålla bokstäver och siffror!</p>
					</div>';
				}


			} else {
				//Stämmer inte, error
				echo '<div id="error-msg">
						<p>Lösenorden måste vara samma!</p>
					</div>';
			}

		}
		//Kolla så att man faktiskt har tryckt på knappen
		else if (isset($_POST['create'])) {
			echo '<div id="error-msg">
					<p>Alla fält måste fyllas i!</p>
				</div>';
		}

		?>
		
		<!--FROM FÖR INLOGG-->
		<form method="POST">

			<header>
				<h1>Skapa konto</h1>
			</header>

			<div id=firstname-container>
				<label for="firstname">Förnamn:</label>
				<input required type="text" name="firstname" placeholder="Skriv förnamn">
			</div>

			<div id="lastname-container">
				<label for="lastname">Efternamn:</label>
				<input required type="text" name="lastname" placeholder="Skriv efternamn">
			</div>

			<div id="username-container">
				<label for="username">Användarnamn:</label>
				<input required type="text" name="username" placeholder="Skriv användarnamn">
			</div>

			<div id=email-container>
				<label for="email">Email:</label>
				<input required type="email" name="email" placeholder="Skriv email address">
			</div>

			<div id="password-container">
				<label for="password">Lösenord:</label>
				<input required type="password" name="password" placeholder="Skriv lösenord">

				<label for="password-rep">Återupprepa lösenord:</label>
				<input required type="password" name="password-rep" placeholder="Upprepa lösenord">
			</div>

			<div id="agreement-container">
				<span>Genom att skapa ett konto <strong><u>godtjäner jag</u></strong> "Robot Wars Nacka Gymnasiums" <a href="agreement/pp.html" target="_blank"><strong>Sekretesspolicy</strong></a> och <a href="agreement/tos.html" target="_blank"><strong>Användarvillkor.</strong></a></span>
			</div>

			<button type="submit" name="create">Skapa konto</button>

		</form>

		<!--FOOTER-->
		<?php
		include 'footer-html.php';
		?>
	</body>
</html>
