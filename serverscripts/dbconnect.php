<?php
/*
	- Verbindungsscript zur Datenbank
*/
$mysqli = new mysqli("localhost", "root", "<!!Hier-Passwort-Einfuegen!!>", "circlespleef");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>