<?php
/*
	- Das Script toggelt den ReadyStatus des Spielers, der den Button drückt
	- Es wird geprüft ob alle Spieler ready sind und wenn dies der Fall ist, wird das Spiel gestartet
*/
session_start();
require 'dbconnect.php';

if($mysqli->query("SELECT isInGame FROM lobbys WHERE id = '" . $_SESSION['lobbyId'] . "'")->fetch_assoc()['isInGame'] != '0') return;

if($mysqli->query("SELECT isReadyInLobby FROM users WHERE id = '" . $_SESSION['uniqueUserId'] . "'")->fetch_assoc()['isReadyInLobby'] != '0'){
	$mysqli->query("UPDATE users SET isReadyInLobby = '0' WHERE id = '" . $_SESSION['uniqueUserId'] . "'");
}else{
	$mysqli->query("UPDATE users SET isReadyInLobby = '1' WHERE id = '" . $_SESSION['uniqueUserId'] . "'");
}

$count = $mysqli->query("SELECT * FROM users WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'");
$result = $mysqli->query("SELECT * FROM users WHERE lobbyId = '" . $_SESSION['lobbyId'] . "' AND isReadyInLobby = '1'");
if($result->num_rows == $count->num_rows && $result->num_rows != '1'){
	$mysqli->query("INSERT INTO gameFields(lobbyId, currentTurnUserId) VALUES ('" . $_SESSION['lobbyId'] . "', '" . $_SESSION['uniqueUserId'] . "')");
	$mysqli->query("UPDATE lobbys SET isIngame = '1' WHERE id = '" . $_SESSION['lobbyId'] . "'");
}

?>