<?php
/*
	- Das Script prüft die infoFlag Variable in der Datebank und gibt entsprechende Informationen aus
*/
session_start();
require 'dbconnect.php';

$infoflagresult = $mysqli->query("SELECT infoFlag FROM users WHERE id = '" . $_SESSION['uniqueUserId'] . "'")->fetch_assoc()['infoFlag'];

if($infoflagresult == '1'){
	echo '<div class="alert alert-danger" role="alert">You lost the game.</div>';
}else if($infoflagresult == '2'){
	echo '<div class="alert alert-success" role="alert">You won the game!</div>';
}

$mysqli->query("UPDATE users SET infoFlag = '0' WHERE id = '" . $_SESSION['uniqueUserId'] . "'");

?>