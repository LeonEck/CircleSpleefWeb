<?php
/*
	- Das Script überprüft ob die Lobby in der sich der Nutzer befindet in den Status InGame gewechselt hat
	- Wenn ja, wird dem Nutzer seine Startposition auf dem Spielfeld zugewiesen
*/
session_start();
require 'dbconnect.php';

$readystatus = $mysqli->query("SELECT isInGame FROM lobbys WHERE id = '" . $_SESSION['lobbyId'] . "'")->fetch_assoc();
if($readystatus['isInGame'] == '1' && !isset($_SESSION['inGame'])){
	$colorresult = $mysqli->query("SELECT color FROM users WHERE id = '" . $_SESSION['uniqueUserId'] . "'");
	$colorfetch = $colorresult->fetch_assoc();
	if($colorfetch['color'] == '1'){
		$mysqli->query("UPDATE users SET gameFieldPosition = 'c1r1' WHERE id = '" . $_SESSION['uniqueUserId'] . "'");
	}else if($colorfetch['color'] == '2'){
		$mysqli->query("UPDATE users SET gameFieldPosition = 'c5r1' WHERE id = '" . $_SESSION['uniqueUserId'] . "'");
	}else if($colorfetch['color'] == '3'){
		$mysqli->query("UPDATE users SET gameFieldPosition = 'c1r5' WHERE id = '" . $_SESSION['uniqueUserId'] . "'");
	}else if($colorfetch['color'] == '4'){
		$mysqli->query("UPDATE users SET gameFieldPosition = 'c5r5' WHERE id = '" . $_SESSION['uniqueUserId'] . "'");
	}
	echo '1';
	$_SESSION['inGame'] = '1';
}else {
	echo '0';
}


?>