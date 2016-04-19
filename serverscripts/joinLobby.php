<?php
/*
	- Mit diesem Script kann der Nutzer einer Lobby beitreten
*/
session_start();
require 'dbconnect.php';

$result = $mysqli->query("SELECT playerCount, isInGame FROM lobbys WHERE id = '" . $_POST["idOfLobbyToJoin"] . "'");
if($result->num_rows == 0) return;

$lobplayers = $result->fetch_assoc();
if($lobplayers['playerCount'] != '4' && $lobplayers['isInGame'] != '1'){
	$lobplayers['playerCount'] += 1;
	$mysqli->query("UPDATE lobbys SET playerCount = playerCount + 1 WHERE id = '" . $_POST["idOfLobbyToJoin"] . "'");
	$mysqli->query("UPDATE users SET lobbyId = '" . $_POST["idOfLobbyToJoin"] . "' , color = '" . $lobplayers['playerCount'] . "' WHERE id = '" . $_SESSION['uniqueUserId'] . "'");
	$_SESSION['lobbyId'] = $_POST["idOfLobbyToJoin"];
}

?>