<?php
include 'include/main-include.php';
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

	</head>

	<body>
		<!--TILLBAKA-->
			<nav id="back-nav">
				<ul>
					<li><a href="../index.php">Hem</a></li>
				</ul>
			</nav>
		
		<header>
			<h1 style="text-align: center; width: 100%; padding: 3% 0 1% 0;">Lyckades!</h1>
		</header>

		<?php
		//Kolla ifall ett errormeddelande finns
		if (isset($_GET['success-msg'])) {
			echo "<div id='success-msg'><p>" . $_GET['success-msg'] . "</p><div>";
		}
		?>
		
	</body>
</html>