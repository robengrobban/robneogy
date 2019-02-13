<?php  
include 'include/main-include.php';
include 'include/clear-data.php';
include 'include/session-start.php';


//kolla att deras verikey stämmer.
//använd POST för att hämta ut deras lösenord och sätt det som ['']

//update user set password det dom skriver
//låt dem sedan skriva in nytt lösenord, med POST sätt det nya.

//Kolla ifall användaren är inloggad
include 'include/is-logged-in.php';
if ( isLoggedIn() ) {
	header("Location: ../index.php");
}

if (isset($_GET['userEmail'])&& isset($_GET['userName'])&& isset($_GET['veriKey'])) {
	$email = clearData($_GET['userEmail']);
	$name = clearData($_GET['userName']);
	$key = clearData($_GET['veriKey']);

	include 'include/connect-database.php';
	$stmt = $conn->prepare("SELECT count(*) FROM account WHERE mail = ? AND username = ? AND veriKey = ? "); 
	$stmt->bind_param("sss",$email, $name, $key);
	$stmt->execute();

	$res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['count(*)'];


	if ($res != 1) {
			header("Location: error.php?error-msg=Åtkomst nekad!");	
	}
	

	$stmt->close();
	$conn->close();

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
#pungsäck
if (isset($_POST['reset'])&& isset($_POST['password']) &&isset($_POST['password-rep'])) {
	
}

?>
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
			
			<button type="submit" name="reset">Återställ Lösenord</button>

		</form>

</body>
</html>