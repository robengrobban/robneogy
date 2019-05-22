<?php
include 'php/include/main-include.php';
include 'php/include/session-start.php';

//Kollar ifall adminen är inloggad
if ( !isset($_SESSION['admin-loggedIn']) ) {
	header("Location: index.php");
}

//Ladda ner information om kommentaren
include 'php/include/clear-data.php';
$commentId = clearData($_GET['id']);
include 'php/include/connect-database.php';
$stmt = $conn->prepare("SELECT comments.*, account.username FROM comments, account WHERE comments.accountId = ?");
$stmt->bind_param("i", $commentId);
$stmt->execute();

$commentInfo = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];


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

		<div>
			<?php
			//Visa information om kommentaren
			echo '<h1>Kommentar med id '.$commentId.'</h1>';
			echo '<h2>Kommenterad av <a href="viewUser.php?id='.$commentInfo['accountId'].'">'.$commentInfo['username'].'</a></h2>';
			
			echo '<fieldset><legend>Kommentar</legend>'.$commentInfo['content'].'</fieldset>';

			?>
		</div>

		<form method="POST">
			<label>Godkänn borttagning<input type="checkbox" name="input-check"></label>
			<button type="submit" name="skicka-tabort">Ta bort kommentar</button>
			<?php
			//Kolla så att godkänn knappen är klickad och knappen
			if ( isset($_POST['skicka-tabort']) && isset($_POST['input-check']) ) {
				//Uppdatera innehållet
				$stmt = $conn->prepare("UPDATE comments SET content = ? WHERE id = ?");
				$a = "[DENNA KOMMENTAR HAR BLIVIT BORTTAGEN AV EN ADMINISTRATÖR]";
				$stmt->bind_param("si", $a, $commentId);
				$stmt->execute();
			}
			?>
		</form>

	</body>
</html>
