<?php
/*
	- Das Script liefert die Farbe des Nutzers zurück
*/
session_start();
require 'dbconnect.php';

$colorButtonTypeName = array("danger", "primary", "success", "warning");

$colorOfUser = $mysqli->query("SELECT color FROM users WHERE id = '" . $_SESSION['uniqueUserId'] . "'")->fetch_assoc();

for($colorId = 1; $colorId <= 4; $colorId++){
	if($colorOfUser['color'] == $colorId){
		$colorButton = generateColorButton($colorButtonTypeName[$colorId - 1]);
		echo "You are $colorButton";
		return;
	}
}


function generateColorButton($buttonType){
	return '<a class="btn btn-' . $buttonType . ' disabled" role="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
}

?>