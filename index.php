<?php
session_start();
require 'includes/head.php';
require 'serverscripts/dbconnect.php';

function generateUniqueID(){
	global $mysqli;
	$mysqli->query("INSERT INTO users() VALUES()");
	$_SESSION['uniqueUserId'] = $mysqli->insert_id;
	unset($_SESSION['lobbyId']);
	unset($_SESSION['inGame']);
}

function generateContainerHead(){
	echo'
	<div class="container" style="text-align:center">
	';
}

function generateIndexScreen(){
	echo'
	<div class="row top5">
		<div class="col-xs-12">
			<div id="infoStatusDisplay"></div>
		</div>
	</div>
	<div class="row top60">
		<div class="col-xs-12">
			<a href id="createNewLobbyButton" class="btn btn-lg btn-primary">
				Create new lobby</a>
		</div>
	</div>
	</div>
	<div class="row top60">
		<div id="circleSpleefWebLobbyDisplay" class="col-xs-12"></div>
	</div>
	<div class="row top60">
		<div class="col-xs-2"></div>
		<div class="col-xs-8">
			<h3 style="text-align:center">Anleitung</h3>
			<p>
				CircleSpleef ist ein Mehrspielerspiel für bis zu 4 Spielern.
				<br>
				Jeder Spieler kann eine Lobby erstellen oder einer offenen Lobby beitreten.
				<br>
				Wenn alle Spieler in einer Lobby bereit sind (sie also ihren "Readystatus" auf grün gesetzt haben), startet das Spiel.
				<br>
				Für ein Spiel werden mindestens 2 Spieler benötigt.
				<br>
				Wenn das Spiel startet wird jedem Spieler das Spielfeld angezeigt, sowie seine eigene Farbe und die des Spielers der gerade am Zug ist.
				<br>
				Folgende Farben werden an die Spieler vergeben: Rot, Blau, Grün und Gelb. In dieser Reihenfolge wird auch der Zug weitergegeben.
				<br>
				Wenn ein Spieler am Zug ist, kann er auf eines seiner benachbarten Felder ziehen.
				<br>
				Als benachbartes Feld gelten nur Felder die direkt an das momentane Feld des Spielers angrenzen, also sind diagonale Züge nicht erlaubt.
				<br>
				Wenn ein Spieler seinen Zug gemacht hat, verringert sich das Leben des Feldes von dem er kommt um die Menge an Spielern die sich beim Verlassen auf dem Feld befunden haben.
				<br>
				Als Beispiel: Wenn ein Spieler mit 2 anderen auf einem Feld mit dem Leben 4 sitzt und wegzieht, ändert sich das Leben des Feldes von dem er wegzieht zu 1.
				<br>
				Wenn das Leben eines Feldes auf 0 oder weniger fällt, verlieren alle Spieler, die zu diesem Zeitpunkt auf dem Feld sind, das Spiel und kehren zur Lobby zurück.
				<br>
				Ziel des Spiels ist es am Ende als Einziger noch übrig zu sein.
				<br>
				Damit die Spieler nicht einfach nur abwarten, müssen sie, wenn sie am Zug sind, ein Feld weiter rücken. Sollte dies nicht mehr möglich sein, verlieren sie das Spiel.
			</p>
		</div>
		<div class="col-xs-2"></div>
	</div>
	';
}

function generateLobbyScreen(){
	echo'
	<div class="row top60">
		<div class="col-xs-5 col-md-6">
			<a href id="leaveLobbyButton" class="btn btn-lg btn-danger">
				Leave lobby</a>
		</div>
		<div class="col-xs-7 col-md-6">
			<a href class="btn btn-lg btn-danger lobby-readyup-btn">
				Change Readystatus</a>
		</div>
	</div>
	<div class="row top60">
		<div class="col-xs-12">
			<div id="circleSpleefCurrentLobbyDisplay"></div>
		</div>
	</div>
	';
}

function generateInGameScreen(){
	echo'
	<div class="row top10">
		<div class="col-xs-4">
			<a href class="btn btn-lg btn-danger ingame-leave-btn">Leave game</a>
		</div>
		<div class="col-xs-4">
			<div id="yourColorDisplay"></div>
		</div>
		<div class="col-xs-4">
			<div id="whosTurnDisplay"></div>
		</div>
	</div>
	<div id="gameFieldDisplay"></div>
	';
}

function generateScriptBeginTag(){
	echo'
	<script type="text/javascript">
	';
}

function generateScriptEndTag(){
	echo'
	</script>
	';
}

function generateScriptIndexScreen(){
	echo'
	var lobbyCreateButton = document.getElementById("createNewLobbyButton");
	var lobbyCreateFunction = function() {
		$.ajax({
			type: "Post",
			url: "serverscripts/createNewLobby.php"
		});
	}
	lobbyCreateButton.addEventListener("click", lobbyCreateFunction, false);

	$(document).on("click", ".lobby-join-btn",function(){
		$.ajax({
			type: "Post",
			url: "serverscripts/joinLobby.php",
			data: {idOfLobbyToJoin: $(this).attr("id")}
		});
	});

	var XHR = new XMLHttpRequest();
	function getAllLobbys() {
		XHR.open("POST", "serverscripts/getAllLobbys.php", true);
		XHR.send(null);
		XHR.onreadystatechange = updateLobbys;
	}
	function updateLobbys() {
		if(XHR.readyState == 4) {
			document.getElementById("circleSpleefWebLobbyDisplay").innerHTML = XHR.responseText;
		}
	}

	function getInfoState() {
		$.ajax({
			type: "Post",
			url: "serverscripts/getInfoState.php",
			success: function (data) {
				document.getElementById("infoStatusDisplay").innerHTML = data;
			}
		});
	}

	setInterval(getAllLobbys, 500);

	$(document).ready(function(){
		getAllLobbys();
		getInfoState();
	});
	';
}

function generateScriptInLobby(){
	echo'
	$("#leaveLobbyButton").click(function(){
		$.ajax({
			type: "Post",
			url: "serverscripts/leaveLobby.php"
		});
	});

	$(".lobby-readyup-btn").click(function(){
		$.ajax({
			type: "Post",
			url: "serverscripts/changeReadyStatusInLobby.php"
		});
	});
	';
}

function generateScriptLobby(){
	echo'
	function getCurrentLobby() {
		$.ajax({
			type: "Post",
			url: "serverscripts/getCurrentLobby.php",
			success: function (data) {
				document.getElementById("circleSpleefCurrentLobbyDisplay").innerHTML = data;
			}
		});
	}

	function checkIfInGame() {
		$.ajax({
			type: "Post",
			url: "serverscripts/checkIfCurrentLobbyIsInGame.php",
			success: function (data) {
				if(data == "1"){
					location.reload();
				}
			}
		});
	}

	setInterval(getCurrentLobby, 500);
	setInterval(checkIfInGame, 500);

	$(document).ready(function(){
		getCurrentLobby();
	});
	';
}

function generateScriptInGame(){
	echo'
	function refreshAll() {
		$.ajax({
			type: "Post",
			url: "serverscripts/getGameField.php",
			success: function (data) {
				var str1 = document.getElementById("gameFieldDisplay").innerHTML;
				if(data != str1){
					document.getElementById("gameFieldDisplay").innerHTML = data;
				}
			}
		});

		$.ajax({
			type: "Post",
			url: "serverscripts/getWhosTurnItIs.php",
			success: function (data) {
				if(document.getElementById("whosTurnDisplay").innerHTML != data){
					document.getElementById("whosTurnDisplay").innerHTML = data;
				}
			}
		});

		$.ajax({
			type: "Post",
			url: "serverscripts/checkForSpecialGameCondition.php",
			success: function (data) {
				if(data == "1"){
					location.reload();
				}
			}
		});

		$.ajax({
			type: "Post",
			url: "serverscripts/checkIfOutOfMoves.php",
			success: function (data) {
				if(data == "1"){
					location.reload();
				}
			}
		});
	}

	function getUsersColor() {
		$.ajax({
			type: "Post",
			url: "serverscripts/getUsersColor.php",
			success: function (data) {
				if(document.getElementById("yourColorDisplay").innerHTML != data){
					document.getElementById("yourColorDisplay").innerHTML = data;
				}
			}
		});
	}

	setInterval(refreshAll, 500);

	$(document).ready(function(){
		getUsersColor();
	});

	$("#gameFieldDisplay").on("click", ".active-gamefield",function(){
		$.ajax({
			type: "Post",
			url: "serverscripts/checkForValidTurn.php",
			data: {idOfFieldToTurnTo: $(this).attr("id")}
		});
	});

	$(".ingame-leave-btn").click(function(){
		$.ajax({
			type: "Post",
			url: "serverscripts/leaveGame.php",
			success: function (data) {
				location.reload();
			}
		});
	});
	';
}

// Give the user a unique ID
if(!isset($_SESSION['uniqueUserId'])){
	generateUniqueID();
}else {
	// If the user has a unique id, check if it is still valid
	if($mysqli->query("SELECT id FROM users WHERE id = '" . $_SESSION['uniqueUserId'] . "'")->num_rows == '0'){
		generateUniqueID();
	}
}

generateContainerHead();

// If the user is not in a lobby give him the option to create one or join one
if(!isset($_SESSION['lobbyId'])){
	generateIndexScreen();
}else if(!isset($_SESSION['inGame'])){
	// When the user has a lobby, show him his lobby
	generateLobbyScreen();
}else{
	generateInGameScreen();
}

generateScriptBeginTag();

if(!isset($_SESSION['lobbyId'])){
	generateScriptIndexScreen();
}else {
	generateScriptInLobby();
	if(!isset($_SESSION['inGame'])){
		generateScriptLobby();
	}else {
		generateScriptInGame();
	}
}

generateScriptEndTag();

require 'includes/footer.php';

?>
