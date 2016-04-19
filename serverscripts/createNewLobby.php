<?php
/*
	- Das Script erstellt eine neue Lobby, mit dem Nutzer als Ersteller, der den Button gedrückt hat
*/
session_start();
require 'dbconnect.php';

$mysqli->query("INSERT INTO lobbys(creatorId) VALUES ('" . $_SESSION['uniqueUserId'] . "')");
$_SESSION['lobbyId'] = $mysqli->insert_id;
$mysqli->query("UPDATE users SET lobbyId =  '" . $_SESSION['lobbyId'] . "', color = '1' WHERE id = '" . $_SESSION['uniqueUserId'] . "'");

?>