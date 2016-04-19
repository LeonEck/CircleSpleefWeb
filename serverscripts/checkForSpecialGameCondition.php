<?php
/*
	- Das Script überprüft ob die Lobby in der sich ein Nutzer befindet noch existiert
	- Wenn nicht wird der Nutzer resettet und zurück zur Startseite gebracht
*/
session_start();
require 'dbconnect.php';

if(!isset($_SESSION['lobbyId']) || !isset($_SESSION['inGame'])){
	echo '1';
}

$idstatus = $mysqli->query("SELECT lobbyId FROM users WHERE id = '" . $_SESSION['uniqueUserId'] . "'")->fetch_assoc();
$lobbystillthere = $mysqli->query("SELECT * FROM lobbys WHERE id = '" . $_SESSION['lobbyId'] . "'")->num_rows;
if($idstatus['lobbyId'] == '0' || $lobbystillthere == '0'){
	$mysqli->query("UPDATE users SET lobbyId = '0', color = '0', isReadyInLobby = '0', gameFieldPosition = 'N' WHERE id = '" . $_SESSION['uniqueUserId'] . "'");
	if($lobbystillthere == '0'){
		$mysqli->query("DELETE FROM gameFields WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'");
	}
	$mysqli->query("DELETE FROM lobbys WHERE playerCount = '0'");
	unset($_SESSION['lobbyId']);
	unset($_SESSION['inGame']);
	echo '1';
}else {
	echo '0';
}


?>