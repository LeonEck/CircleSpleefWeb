<?php
/*
	- Das Script liefert eine Tabelle mit den Nutzern in der aktuellen Lobby und ihren ReadyStatus
*/
session_start();
require 'dbconnect.php';

$result = $mysqli->query("SELECT * FROM users WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'");

echo '
<table class="table" style="text-align: center;">
	<tr>
		<th>Color</th>
		<th>Readystatus</th>
	</tr>
';

while($row = mysqli_fetch_array($result))
{
	if($row['color'] == '1'){
		$colordisp = '<a class="btn btn-danger disabled" role="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
	}else if($row['color'] == '2'){
		$colordisp = '<a class="btn btn-primary disabled" role="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
	}else if($row['color'] == '3'){
		$colordisp = '<a class="btn btn-success disabled" role="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
	}else if($row['color'] == '4'){
		$colordisp = '<a class="btn btn-warning disabled" role="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
	}
	if($row['isReadyInLobby'] == '0'){
		$readydisplay = '<a class="btn btn-primary btn-danger disabled"><span class="glyphicon glyphicon-remove"></span></a>';
	}else if($row['isReadyInLobby'] == '1'){
		$readydisplay = '<a class="btn btn-primary btn-success disabled"><span class="glyphicon glyphicon-ok"></span></a>';
	}
	echo '<tr>';
	echo '<td>' . $colordisp . '</td>';
	echo '<td>' . $readydisplay . '</td>';
	echo '</tr>';
}

echo '</table>';

?>