<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';
include 'php/include/clear-data.php';

//Kolla ifall användaren inte är inloggad
include 'php/include/is-logged-in.php';
if ( !isLoggedIn() ) {
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
		<link rel="stylesheet" type="text/css" href="css/konto.css">

	</head>
	<body>
		<!--TILLBAKA-->
		<nav id="back-nav">
			<ul>
				<li><a href="index.php">Hem</a></li>
			</ul>
		</nav>

		<?php
		if ( isset($_POST['change']) && isset($_POST['firstname']) && clearData($_POST['firstname']) != "" && isset($_POST['lastname']) && clearData($_POST['lastname']) != "" ) {
			//Hämta data
			$firstnameIn = clearData($_POST['firstname']);
			$lastnameIn = clearData($_POST['lastname']);

			//Anslut till databas
			include 'php/include/connect-database.php';

			//Förbered än fråga
			$stmt = $conn->prepare('UPDATE account SET firstname = ?, lastname = ? WHERE id = ?');
			$stmt->bind_param("ssi", $firstnameIn, $lastnameIn, $_SESSION['user-id']);
			$stmt->execute();

			//Spara nya resultatet
			$_SESSION['user-firstname'] = $firstnameIn;
			$_SESSION['user-lastname'] = $lastnameIn;

			//Ladda om sidan
			header("Location: konto.php");

		} else if (isset($_POST['change'])) {
			echo '<div id="error-msg">
					<p>Alla fält måste vara i fyllda!</p>
				</div>';
		}
		?>

		<form method="POST" id="user-image-container">
			<div id="user-image">
				<div id="upload-new"><button type="submit" name="upload-image">Ladda upp ny bild</button></div>
			</div>
		</form>

		<form method="POST" id="user-info">

			<header>
				<h1><?php echo $_SESSION['user-name'] ?></h1>
			</header>

			<div class="form-container">
				<label>Förnamn:</label>
				<input required name="firstname" type="text" value="<?php echo $_SESSION['user-firstname'] ?>">
			</div>

			<div class="form-container">
				<label>Efternamn:</label>
				<input required name="lastname" type="text" value="<?php echo $_SESSION['user-lastname'] ?>">
			</div>

			<div class="form-container">
				<label>Email:</label>
				<input disabled="disabled" readonly="readonly" name="email" type="email" value="<?php echo $_SESSION['user-email'] ?>">
			</div>

			<button name='change' type="submit">Uppdatera information</button>
		</form>

	</body>
</html>
