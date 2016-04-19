<?php
/*
	- Das Script liefert zurück welcher Nutzer gerade am Zug ist
*/
session_start();
require 'dbconnect.php';

$idturnplayer = $mysqli->query("SELECT currentTurnUserId FROM gameFields WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'")->fetch_assoc();

if($idturnplayer['currentTurnUserId'] == $_SESSION['uniqueUserId']){
	echo 'It is your turn!';
}else {
	$colorturnplayertmp = $mysqli->query("SELECT color FROM users WHERE lobbyId = '" . $_SESSION['lobbyId'] . "' AND id = '" . $idturnplayer['currentTurnUserId'] . "'");
	$colorturnplayer = $colorturnplayertmp->fetch_assoc();
	if($colorturnplayer['color'] == '1'){
		$colordisp = '<a class="btn btn-danger disabled" role="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
	}else if($colorturnplayer['color'] == '2'){
		$colordisp = '<a class="btn btn-primary disabled" role="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
	}else if($colorturnplayer['color'] == '3'){
		$colordisp = '<a class="btn btn-success disabled" role="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
	}else if($colorturnplayer['color'] == '4'){
		$colordisp = '<a class="btn btn-warning disabled" role="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
	}
	echo "It is $colordisp turn!";
}


?>