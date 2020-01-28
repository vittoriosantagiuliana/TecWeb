<?php
	require_once "includes/header.php";
	require_once "includes/footer.php";
	require_once "includes/dbhandler.php";
	if (!isset($_SESSION)) {
		session_start();
	}
	if (!isset($_SESSION["userName"])) {
		header("Location: login.php");
		exit();
	}
	if ($_SESSION["userType"] == "admin") {
		header("Location: admin.php");
		exit();
	}
	$connessione = connessione();

	$username = $_SESSION["userName"];
	$result = $connessione->query("SELECT Password_Ut,Nome_Ut,Cognome_Ut,Mail_Ut FROM utente WHERE Username_Ut='$username';");
	$user = $result->fetch_assoc();
	$password = $user["Password_Ut"];
	$nome = $user["Nome_Ut"];
	$cognome = $user["Cognome_Ut"];
	$email = $user["Mail_Ut"];

function listaBiglietti() {
	global $username, $connessione;
	$biglietti=$connessione->query("SELECT * FROM ticket where UsernameUt_T = '$username';");
	if ($biglietti->num_rows > 0) {
		$output = "<h3>I tuoi biglietti</h3>";
		while ($biglietto = $biglietti->fetch_assoc()) {
			$output .= "<div class=\"biglietto\">
					<h4>Transazione numero " . $biglietto["ID_T"] . " - spesa totale: " . $biglietto["CostoTot_T"] . " euro</h4>
					<ul>
						<li>Numero biglietti interi: " . $biglietto["NumInteri_T"] . "</li>
						<li>Numero biglietti bambini: " . $biglietto["NumRidottiB_T"] . "</li>
						<li>Numero biglietti anziani: " . $biglietto["NumRidottiA_T"] . "</li>
					</ul>
				</div>";
		}
	}
	else {
		$output = "";
	}
	return $output;
}

function listaGruppi() {
	global $username, $connessione;
	$output = "<p>";

	$gruppi = $connessione->query("SELECT ID_Gr AS ID, NumPers_Gr AS NumeroPersone, Nome_C AS Classe, NomeIst_C AS Istituto FROM utenteaccompagnatore INNER JOIN gruppo ON IDGr_UA = ID_Gr LEFT OUTER JOIN classe ON ID_Gr = IDGr_C;");

	while ($gruppo = $gruppi->fetch_assoc()) {
		if ($gruppo["Classe"] == NULL) {
			$output .= "<strong>Tipologia gruppo: </strong>gruppo generico<br/>
			<strong>Numero di persone: </strong>" . $gruppo["NumeroPersone"] . "<br/>";
		} else {
			$output .= "<strong>Tipologia gruppo: </strong>classe scolastica<br/>
			<strong>Numero di persone: </strong>" . $gruppo["NumeroPersone"] . "<br/>
			<strong>Nome classe: </strong>" . $gruppo["Classe"] . "<br/>
			<strong>Nome istituto: </strong>" . $gruppo["Istituto"] . "<br/>";
		}
		$idGruppo = $gruppo["ID"];
		$result = $connessione->query("SELECT A.Nome_Att AS Nome_Att,P.Data_P AS Data_P FROM partecipazione AS P JOIN attivita as A on P.IDAtt_P=A.ID_Att WHERE P.IDGr_P='$idGruppo';");
		while ($attivita = $result->fetch_assoc()) {
			$output .="<strong>Attivit&agrave; svolta o prenotata: </strong>" . $attivita['Nome_Att'] . " in data " . $attivita["Data_P"] . "<br/>";
		}
			$output .="<br/><br/>";
	}
	$output .= "</p>";

	return $output;
}
function accompagnatore() {
	return "<h3>I tuoi gruppi</h3><br/>
		<p>
			Per aggiungere un nuovo gruppo <a href=\"addgroup.php\">vai alla pagina dedicata!</a>
		</p><br/>" . listaGruppi();
}

	$errore = isset($_GET["error"]) ? "<h2>Errore nella query: " . urldecode($_GET["error"]) . "</h2>" : "";
	$sezioneAccompagnatore = $_SESSION["UtenteAccompagnatore"] ? accompagnatore() : "";

	$output = file_get_contents("html/user.html");
	$output = str_replace("<meta/>", file_get_contents("html/head.html"), $output);
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output = str_replace("%Username%", $username, $output);
	$output = str_replace("%Nome%", $nome, $output);
	$output = str_replace("%Cognome%", $cognome, $output);
	$output = str_replace("%Email%", $email, $output);
	$output = str_replace("<h2 error/>", $errore, $output);
	$output = str_replace("<p biglietti/>", listaBiglietti(), $output);	
	$output = str_replace("<p accompagnatore/>", $sezioneAccompagnatore, $output);

	echo $output;
?>
