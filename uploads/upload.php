<?php
include '../php/include/main-include.php';
include '../php/include/session-start.php';

//Kolla ifall användaren inte är inloggad
include '../php/include/is-logged-in.php';
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
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/nav.css">
		<link rel="stylesheet" type="text/css" href="../css/upload.css">


	</head>
	<body>

		<!--TILLBAKA-->
		<nav id="back-nav">
			<ul>
				<li><a href="../index.php">Hem</a></li>
			</ul>
		</nav>

		<?php
		//Ifall man har laddat upp en bild
		if ( isset($_FILES['the-file']) && isset($_POST['upload-image']) ) {
			//Specifiera variabler
			$targetDir = "";
			$targetFile = $targetDir . $_SESSION['user-name'] . basename($_FILES['the-file']['name']);
			//Kolla fil typ
			$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

			//Kolla bildens format
			$supportetFileTypes = ['jpg','png','jpeg','gif'];
			$supportetFileTypesText = "";
			$correctFileType = false;
			for ($i = 0; $i < count($supportetFileTypes); $i++) {
				if ($imageFileType == $supportetFileTypes[$i]) {
					$correctFileType = true;
				}
				$supportetFileTypesText .= $supportetFileTypes[$i] . " ";
			}
			if ( !$correctFileType ) {
				echo '<div id="error-msg">
						<p>Filen du förstöke ladda upp är inte stödd. Dessa filer stöds: '.$supportetFileTypesText.'.</p>
					</div>';
			} else {

				//Kolla bildens storlek
				if ( $_FILES['the-file']['size'] > 5000000 ) {
					echo '<div id="error-msg">
							<p>Filen är för stor. Max bild fil är 5MB!</p>
						</div>';
				} else {
					//Ladd upp bilden
					if ( move_uploaded_file($_FILES['the-file']['tmp_name'], $targetFile) ) {
						//Ladda upp filens namn till databasen
						include '../php/include/connect-database.php';
						$stmt = $conn->prepare("UPDATE account SET imageURL = ? WHERE id = ?");
						$stmt->bind_param("si", $targetFile, $_SESSION['user-id']);
						$stmt->execute();

						//Stäng anslutningar
						$stmt->close();
						$conn->close();

						//Skicka tillbaka användaren till startsidan
						header("Location: ../konto.php");
					} else {
						echo '<div id="error-msg">
								<p>Ett oväntat fel uppstod vid uppladningen av filen!</p>
							</div>';
					}
				}

			}
		}
		?>


		<form method="POST" enctype="multipart/form-data" id="upload-image-container">
			<input type="file" name="the-file">
			<button type="submit" name="upload-image">Ladda upp bild</button>
		</form>

	</body>
</html>
