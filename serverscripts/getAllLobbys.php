<?php
/*
	- Das Script liefert in einer Tabelle eine List aller offenen Lobbys die noch nicht im Spiel sind
*/
session_start();
require 'dbconnect.php';

$result = $mysqli->query("SELECT * FROM lobbys WHERE isInGame = '0'");

echo '
<table class="table" style="text-align: center;">
	<tr>
		<th>Player count</th>
		<th>Join</th>
	</tr>
';

while($row = mysqli_fetch_array($result))
{
	echo '<tr>';
	echo '<td>' . $row['playerCount'] . '</td>';
	echo '<td> <a href id=' . $row['id'] . ' class="btn btn-lg btn-primary lobby-join-btn">Join</a></td>';
	echo '</tr>';
}

echo '</table>';

?>