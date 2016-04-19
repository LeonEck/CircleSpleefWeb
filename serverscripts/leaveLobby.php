<?php
/*
	- Durch das Script verlässt der Nutzer die aktuelle Lobby
*/
session_start();
require 'dbconnect.php';

$result = $mysqli->query("SELECT isInGame FROM lobbys WHERE id = '" . $_SESSION['lobbyId'] . "'");
$ingamestatus = $result->fetch_assoc();
if($ingamestatus['isInGame'] != '1'){
	$mysqli->query("UPDATE lobbys SET playerCount = playerCount - 1 WHERE id = '" . $_SESSION['lobbyId'] . "'");
	$mysqli->query("DELETE FROM lobbys WHERE playerCount = '0'");
	$mysqli->query("UPDATE users SET lobbyId = '0' , color = '0', isReadyInLobby = '0' WHERE id = '" . $_SESSION['uniqueUserId'] . "'");
	unset($_SESSION['lobbyId']);
}

?>