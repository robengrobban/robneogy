<?php  
include 'include/main-include.php';
include 'php/include/clear-data.php';

//kolla att deras verikey stämmer.
//använd POST för att hämta ut deras lösenord och sätt det som ['']

//update user set password det dom skriver
//låt dem sedan skriva in nytt lösenord, med POST sätt det nya.


if (isset($_GET['userEmail'])&& isset($_GET['userName'])&& isset($_GET['veriKey'])) {
	
}
else{
	header("Location: error.php?error-msg=Åtkomst nekad!");
}




?>
<!DOCTYPE html>
<html>
<head>
	<title>Robot Wars Nacka Gymnasium</title>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!--FONT LÄNK-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

		<!--STIL MED CSS-->
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/nav.css">
		<link rel="stylesheet" type="text/css" href="../css/rsPw.css">

		
</head>
<body>
		<!--TILLBAKA-->
		<nav id="back-nav">
			<ul>
				<li><a href="index.php">Hem</a></li>
			</ul>
		</nav>

		<!--FROM FÖR INLOGG-->
		<form method="POST">

			<header>
				<h1>Återställ Lösenord</h1>
			</header>
			
			<div id="password-container">
				<label for="password">Lösenord:</label>
				<input required type="password" name="password" placeholder="Skriv lösenord">


				<label for="password-rep">Återupprepa lösenord:</label>
				<input required type="password" name="password-rep" placeholder="Upprepa lösenord">
			</div>
			
			<button type="submit" name="create">Återställ Lösenord</button>

		</form>

</body>
</html>