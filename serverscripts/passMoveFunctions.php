<?php
/*
	- Mit diesen Funktionen wird anhand des aktuellen Nutzers der nächste Nutzer gesucht, der am Zug ist
*/
function tryToPassToColor($colorToPassTo, $currentLobbyId){
	global $mysqli;

	$countcheckertmp = $mysqli->query("SELECT id FROM users WHERE lobbyId = '" . $currentLobbyId . "' AND color = '" . $colorToPassTo . "'");
	$countchecker = $countcheckertmp->num_rows;
	if($countchecker >= 1){
		$newplayeridtmp = $countcheckertmp->fetch_assoc();
		$newplayerid = $newplayeridtmp['id'];
		$mysqli->query("UPDATE gameFields SET currentTurnUserId = '" . $newplayerid . "' WHERE lobbyId = '" . $currentLobbyId . "'");
		return true;
	}

	return false;
}

function passMoveByCurrentColor($currentColor, $currentLobbyId){
	global $mysqli;

	$nextColor = $currentColor + 1;
	if($nextColor == 5){
		$nextColor = 1;
	}
	while($nextColor != $currentColor){
		if(tryToPassToColor($nextColor, $currentLobbyId)){
			return;
		}
		$nextColor++;
		if($nextColor == 5){
			$nextColor = 1;
		}
	}

	$mysqli->query("UPDATE users SET lobbyId = '0', infoFlag = '2' WHERE id = '" . $_SESSION['uniqueUserId'] . "'");
	$mysqli->query("DELETE FROM gameFields WHERE lobbyId = '" . $currentLobbyId . "'");
}

?>