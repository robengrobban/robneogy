<?php
//Kolla så att användaren är inlåggad
function isLoggedIn() {
	return ( isset($_SESSION['user-id']) && isset($_SESSION['user-name']) && isset($_SESSION['user-email']) && isset($_SESSION['user-firstname']) && isset($_SESSION['user-lastname']) );
}
?>
