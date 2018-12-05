<?php
//Funktion för att rensa data som exempelvis en användare skriver in.
function clearData( $data ) {

	$data = trim( $data );

	$data = stripslashes( $data );

	$data = htmlspecialchars( $data );

	return $data;

}
?>