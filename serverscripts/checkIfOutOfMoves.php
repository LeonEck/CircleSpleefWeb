<?php
/*
	- Das Script prüft ob der Nutzer keine Möglichkeit mehr hat einen weiteren Zug auszuführen
	- Wenn er keinen Zug mehr machen kann, verliert er das Spiel
*/
session_start();
require 'dbconnect.php';

$currentposition = $mysqli->query("SELECT gameFieldPosition FROM users WHERE id = '" . $_SESSION['uniqueUserId'] . "'")->fetch_assoc()['gameFieldPosition'];

$maxsides = 4;
$deadsides = 0;

$helper = $currentposition{1} - 1;
$leftpos = 'c' . $helper . 'r' . $currentposition{3};
$helper = $currentposition{1} + 1;
$rightpos = 'c' . $helper . 'r' . $currentposition{3};
$helper = $currentposition{3} - 1;
$uppos = 'c' . $currentposition{1} . 'r' . $helper;
$helper = $currentposition{3} + 1;
$downpos = 'c' . $currentposition{1} . 'r' . $helper;

// Left
if($leftpos{1} != '0' && $leftpos{1} != '6'){
	$tmpResult = $mysqli->query("SELECT " . $leftpos . " FROM gameFields WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'");
	$tmpRealResult = $tmpResult->fetch_assoc();
	if($tmpRealResult[$leftpos] == '0'){
		$deadsides++;
	}
}else {
	$maxsides--;
}

// Right
if($rightpos{1} != '0' && $rightpos{1} != '6'){
	$tmpResult = $mysqli->query("SELECT " . $rightpos . " FROM gameFields WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'");
	$tmpRealResult = $tmpResult->fetch_assoc();
	if($tmpRealResult[$rightpos] == '0'){
		$deadsides++;
	}
}else {
	$maxsides--;
}

// Up
if($uppos{3} != '0' && $uppos{3} != '6'){
	$tmpResult = $mysqli->query("SELECT " . $uppos . " FROM gameFields WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'");
	$tmpRealResult = $tmpResult->fetch_assoc();
	if($tmpRealResult[$uppos] == '0'){
		$deadsides++;
	}
}else {
	$maxsides--;
}

// Down
if($downpos{3} != '0' && $downpos{3} != '6'){
	$tmpResult = $mysqli->query("SELECT " . $downpos . " FROM gameFields WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'");
	$tmpRealResult = $tmpResult->fetch_assoc();
	if($tmpRealResult[$downpos] == '0'){
		$deadsides++;
	}
}else {
	$maxsides--;
}

if($maxsides == $deadsides){
	$mysqli->query("UPDATE users SET lobbyId = '0', infoFlag = '1' WHERE id = '" . $_SESSION['uniqueUserId'] . "'");
	$mysqli->query("UPDATE lobbys SET playerCount = playerCount - " . $mysqli->affected_rows . " WHERE id = '" . $_SESSION['lobbyId'] . "'");
	$tmpResult = $mysqli->query("SELECT playerCount FROM lobbys WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'");
	$tmpCount = $tmpResult->num_rows;
	if($tmpCount <= 1){
		$mysqli->query("UPDATE users SET lobbyId = '0', infoFlag = '2' WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'");
	}
	echo '1';
}

?>