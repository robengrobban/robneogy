<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';
include 'php/include/clear-data.php';

//Kolla efter användaren
if ( !isset($_GET['user']) ) {
	//header("Location: index.php");
}
$targetUser = $_GET['user'];
include 'php/include/connect-database.php';
//Hämmta användarens information
$stmt = $conn->prepare("SELECT * FROM account WHERE username = ?");
$stmt->bind_param("s", $targetUser);
$stmt->execute();
$res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
if ( $res == null ) {
	header("Location: index.php");
}

//Hämta användarens profil bild
$imageURL = $res['imageURL'];

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

		<div id="user-form-container">
			<div id="user-image-container">
				<div id="user-image" <?php if (isset($imageURL)) { echo "style='background-image: url(uploads/".$imageURL.");cursor:default;'"; } ?>></div>
			</div>

			<form id="user-info">

				<header>
					<h1><?php echo $res['username'] ?></h1>
				</header>

				<div class="form-container">
					<label>Förnamn:</label>
					<input disabled="disabled" readonly="readonly" name="firstname" type="text" value="<?php echo $res['firstname'] ?>">
				</div>

				<div class="form-container">
					<label>Efternamn:</label>
					<input disabled="disabled" readonly="readonly" name="lastname" type="text" value="<?php echo $res['lastname'] ?>">
				</div>

				<div class="form-container">
					<label>Email:</label>
					<input disabled="disabled" readonly="readonly" name="email" type="email" value="<?php echo $res['mail'] ?>">
				</div>

			</form>
		</div>

	</body>
</html>
