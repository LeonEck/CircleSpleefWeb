<?php
/*
	- Das Script überprüft ob das Feld auf das ein Nutzer ziehen möchte, ein nach den Spielregeln korrekter Zug wäre
	- Wenn der Zug korrekt wäre, wird er ausgeführt und die Berechtigung zu ziehen wird an den nächsten Nutzer weitergegeben
*/
session_start();
require 'dbconnect.php';
require 'passMoveFunctions.php';

$currentUserPosition = $mysqli->query("SELECT gameFieldPosition FROM users WHERE id = '" . $_SESSION['uniqueUserId'] . "'")->fetch_assoc()['gameFieldPosition'];

$nextFieldPosition = $_POST['idOfFieldToTurnTo'];

$idturnplayer = $mysqli->query("SELECT currentTurnUserId FROM gameFields WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'")->fetch_assoc();

if($idturnplayer['currentTurnUserId'] != $_SESSION['uniqueUserId']) return;
if(!checkIfNextFieldIsInsideOfGameField()) return;
if(!checkIfNextFieldIsOnADirectlyConnectedColumn()) return;
if(!checkIfNextFieldIsOnADirectlyConnectedRow()) return;
if(!checkIfNextFieldIsDiagonalConnected()) return;
if(!checkIfNextFieldIsTheSameTheUserIsOn()) return;

$verifiedNewPosition = 'c' . $nextFieldPosition{2} . 'r' . $nextFieldPosition{0};
$lifeOfNewPosition = $mysqli->query("SELECT " . $verifiedNewPosition . " FROM gameFields WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'")->fetch_assoc()[$verifiedNewPosition];
if($lifeOfNewPosition < 1) return;

$amountOfPlayersOnField = $mysqli->query("SELECT * FROM users WHERE lobbyId = '" . $_SESSION['lobbyId'] . "' AND gameFieldPosition = '" . $currentUserPosition . "'")->num_rows;
$mysqli->query("UPDATE users SET gameFieldPosition = '" . $verifiedNewPosition . "' WHERE id = '" . $_SESSION['uniqueUserId'] . "'");

$currentLifeOfField = $mysqli->query("SELECT " . $currentUserPosition . " FROM gameFields WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'")->fetch_assoc()[$currentUserPosition];
$currentLifeOfField -= $amountOfPlayersOnField;
if($currentLifeOfField <= 0){
	$currentLifeOfField = 0;
	$mysqli->query("UPDATE users SET lobbyId = '0', infoFlag = '1' WHERE gameFieldPosition = '" . $currentUserPosition . "' AND lobbyId = '" . $_SESSION['lobbyId'] . "'");
	$mysqli->query("UPDATE lobbys SET playerCount = playerCount - " . $mysqli->affected_rows . " WHERE id = '" . $_SESSION['lobbyId'] . "'");
	if($mysqli->query("SELECT playerCount FROM lobbys WHERE id = '" . $_SESSION['lobbyId'] . "'")->fetch_assoc()['playerCount'] <= 1){
		$mysqli->query("DELETE FROM lobbys WHERE id = '" . $_SESSION['lobbyId'] . "'");
	}
}

$mysqli->query("UPDATE gameFields SET " . $currentUserPosition . " = '" . $currentLifeOfField . "' WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'");

$currentColor = $mysqli->query("SELECT color FROM users WHERE id = '" . $_SESSION['uniqueUserId'] . "'")->fetch_assoc()['color'];

passMoveByCurrentColor($currentColor, $_SESSION['lobbyId']);



function checkIfNextFieldIsInsideOfGameField(){
	global $nextFieldPosition;
	return ($nextFieldPosition{0} >= 0 || $nextFieldPosition{0} <= 5) && ($nextFieldPosition{2} >= 0 || $nextFieldPosition{2} <= 5);
}

function checkIfNextFieldIsOnADirectlyConnectedColumn(){
	global $nextFieldPosition, $currentUserPosition;
	return (($currentUserPosition{1} - $nextFieldPosition{2}) <= 1 && ($currentUserPosition{1} - $nextFieldPosition{2}) >= -1);
}

function checkIfNextFieldIsOnADirectlyConnectedRow(){
	global $nextFieldPosition, $currentUserPosition;
	return (($currentUserPosition{3} - $nextFieldPosition{0}) <= 1 && ($currentUserPosition{3} - $nextFieldPosition{0}) >= -1);
}

function checkIfNextFieldIsDiagonalConnected(){
	global $nextFieldPosition, $currentUserPosition;
	return ($currentUserPosition{1} - $nextFieldPosition{2} != $currentUserPosition{3} - $nextFieldPosition{0});
}

function checkIfNextFieldIsTheSameTheUserIsOn(){
	global $nextFieldPosition, $currentUserPosition;
	return (($currentUserPosition{1} == $nextFieldPosition{2} && $currentUserPosition{3} != $nextFieldPosition{0}) || ($currentUserPosition{1} != $nextFieldPosition{2} && $currentUserPosition{3} == $nextFieldPosition{0}));
}

?>