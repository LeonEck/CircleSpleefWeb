<?php
/*
	- Durch dieses Script verlässt der Nutzer das aktuelle Spiel
	- Das Spiel passt sich automatisch an, indem es den Zug an den nächsten Spieler weitergibt
*/
session_start();
require 'dbconnect.php';
require 'passMoveFunctions.php';

$result = $mysqli->query("SELECT * FROM users WHERE id = '" . $_SESSION['uniqueUserId'] . "'");

while($row = mysqli_fetch_array($result)) {
	$currentid = $row['id'];
	$currentlobbyid = $row['lobbyId'];
	$currentColor = $row['color'];

	$mysqli->query("DELETE FROM users WHERE id = '" . $currentid . "'");
	$mysqli->query("UPDATE lobbys SET playerCount = playerCount - 1 WHERE id = '" . $currentlobbyid . "'");
	$mysqli->query("DELETE FROM lobbys WHERE playerCount = '0'");

	$ingamelobbytopass = $mysqli->query("SELECT * FROM gameFields WHERE lobbyId = '" . $currentlobbyid . "'")->fetch_assoc();
	if($ingamelobbytopass['currentTurnUserId'] == $currentid){
		$ingamelobbyid = $ingamelobbytopass['id'];
		passMoveByCurrentColor($currentColor, $currentlobbyid);
	}
}

$mysqli->query("DELETE FROM lobbys WHERE playerCount = '1' AND isInGame = '1'");

$result = $mysqli->query("SELECT * FROM gameFields");
while($row = mysqli_fetch_array($result)) {
	if($mysqli->query("SELECT * FROM lobbys WHERE id = '" . $row['lobbyId'] . "'")->num_rows == 0){
		$mysqli->query("DELETE FROM gameFields WHERE lobbyId = '" . $row['lobbyId'] . "'");
	}
}

?>