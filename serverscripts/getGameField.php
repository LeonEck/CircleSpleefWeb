<?php
/*
	- Dieses Script liefert das aktuelle Spielfeld zurück
	- Das Spielfeld wird anhand der gameField Tabelle aus der Datenbank aktualisiert
*/
session_start();
require 'dbconnect.php';

echo '<div class="row top30">';

$lifetmpresult = $mysqli->query("SELECT * FROM gameFields WHERE lobbyId = '" . $_SESSION['lobbyId'] . "'");
$fieldlife = $lifetmpresult->fetch_assoc();

$positiontmpresult = $mysqli->query("SELECT * FROM users WHERE lobbyId = '" . $_SESSION['lobbyId'] . "' AND color = '1'");
$fieldpositiontmp = $positiontmpresult->fetch_assoc();
$positionred = $fieldpositiontmp['gameFieldPosition'];
$positiontmpresult = $mysqli->query("SELECT * FROM users WHERE lobbyId = '" . $_SESSION['lobbyId'] . "' AND color = '2'");
$fieldpositiontmp = $positiontmpresult->fetch_assoc();
$positionblue = $fieldpositiontmp['gameFieldPosition'];
$positiontmpresult = $mysqli->query("SELECT * FROM users WHERE lobbyId = '" . $_SESSION['lobbyId'] . "' AND color = '3'");
$fieldpositiontmp = $positiontmpresult->fetch_assoc();
$positiongreen = $fieldpositiontmp['gameFieldPosition'];
$positiontmpresult = $mysqli->query("SELECT * FROM users WHERE lobbyId = '" . $_SESSION['lobbyId'] . "' AND color = '4'");
$fieldpositiontmp = $positiontmpresult->fetch_assoc();
$positionyellow = $fieldpositiontmp['gameFieldPosition'];

generateGameField();



function getStyleString($columnName){
	global $fieldlife, $positionred, $positionblue, $positiongreen, $positionyellow;

	if($fieldlife[$columnName] == '5'){
		if($positionred == $columnName){
			if($positionblue == $columnName){
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life5all';
					}else{
						return 'life5redbluegreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life5redblueyellow';
					}else{
						return 'life5redblue';
					}
				}
			}else{
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life5redgreenyellow';
					}else{
						return 'life5redgreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life5redyellow';
					}else{
						return 'life5red';
					}
				}
			}
		}else{
			if($positionblue == $columnName){
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life5bluegreenyellow';
					}else{
						return 'life5bluegreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life5blueyellow';
					}else{
						return 'life5blue';
					}
				}
			}else{
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life5greenyellow';
					}else{
						return 'life5green';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life5yellow';
					}else{
						return 'life5';
					}
				}
			}
		}
	}else if($fieldlife[$columnName] == '4'){
		if($positionred == $columnName){
			if($positionblue == $columnName){
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life4all';
					}else{
						return 'life4redbluegreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life4redblueyellow';
					}else{
						return 'life4redblue';
					}
				}
			}else{
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life4redgreenyellow';
					}else{
						return 'life4redgreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life4redyellow';
					}else{
						return 'life4red';
					}
				}
			}
		}else{
			if($positionblue == $columnName){
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life4bluegreenyellow';
					}else{
						return 'life4bluegreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life4blueyellow';
					}else{
						return 'life4blue';
					}
				}
			}else{
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life4greenyellow';
					}else{
						return 'life4green';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life4yellow';
					}else{
						return 'life4';
					}
				}
			}
		}
	}else if($fieldlife[$columnName] == '3'){
		if($positionred == $columnName){
			if($positionblue == $columnName){
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life3all';
					}else{
						return 'life3redbluegreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life3redblueyellow';
					}else{
						return 'life3redblue';
					}
				}
			}else{
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life3redgreenyellow';
					}else{
						return 'life3redgreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life3redyellow';
					}else{
						return 'life3red';
					}
				}
			}
		}else{
			if($positionblue == $columnName){
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life3bluegreenyellow';
					}else{
						return 'life3bluegreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life3blueyellow';
					}else{
						return 'life3blue';
					}
				}
			}else{
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life3greenyellow';
					}else{
						return 'life3green';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life3yellow';
					}else{
						return 'life3';
					}
				}
			}
		}
	}else if($fieldlife[$columnName] == '2'){
		if($positionred == $columnName){
			if($positionblue == $columnName){
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life2all';
					}else{
						return 'life2redbluegreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life2redblueyellow';
					}else{
						return 'life2redblue';
					}
				}
			}else{
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life2redgreenyellow';
					}else{
						return 'life2redgreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life2redyellow';
					}else{
						return 'life2red';
					}
				}
			}
		}else{
			if($positionblue == $columnName){
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life2bluegreenyellow';
					}else{
						return 'life2bluegreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life2blueyellow';
					}else{
						return 'life2blue';
					}
				}
			}else{
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life2greenyellow';
					}else{
						return 'life2green';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life2yellow';
					}else{
						return 'life2';
					}
				}
			}
		}
	}else if($fieldlife[$columnName] == '1'){
		if($positionred == $columnName){
			if($positionblue == $columnName){
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life1all';
					}else{
						return 'life1redbluegreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life1redblueyellow';
					}else{
						return 'life1redblue';
					}
				}
			}else{
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life1redgreenyellow';
					}else{
						return 'life1redgreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life1redyellow';
					}else{
						return 'life1red';
					}
				}
			}
		}else{
			if($positionblue == $columnName){
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life1bluegreenyellow';
					}else{
						return 'life1bluegreen';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life1blueyellow';
					}else{
						return 'life1blue';
					}
				}
			}else{
				if($positiongreen == $columnName){
					if($positionyellow == $columnName){
						return 'life1greenyellow';
					}else{
						return 'life1green';
					}
				}else{
					if($positionyellow == $columnName){
						return 'life1yellow';
					}else{
						return 'life1';
					}
				}
			}
		}
	}else {
		return 'clear';
	}
}


function generateOneField($column, $row){
	$gifName = getStyleString('c' . $column . 'r' . $row .'');
	$gifPath = "'css/imgcirclespleef/$gifName.gif'";
	echo '<div id="' . $row . '-' . $column . '" class="col-xs-1 default-gamefield active-gamefield" style="background-image: url(' . $gifPath . ');"></div>';
}

function generateGameField(){
	for($ro = 1; $ro <= 5; $ro++){
		for($col = 1; $col <= 5; $col++){
			generateOneField($col, $ro);
		}
		echo '</div>';
		if($ro != 5){
			echo '<div class="row top10">';
		}
	}
}

?>