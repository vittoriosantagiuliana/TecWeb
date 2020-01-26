<?php

	require_once "includes/header.php";
	require_once "includes/footer.php";
	require_once "includes/dbhandler.php";
	if (!isset($_SESSION)) {
		session_start();
	}
	if (!isset($_SESSION["userName"])) {
		header("Location: home.php");
		exit();
	}
	if ($_SESSION["userType"] != "admin") {
		header("Location: user.php");
		exit();
	}

	$connessione = connessione();
	$conto = $connessione->query("SELECT SUM(CostoTot_T) AS totale FROM ticket");
	$totale = ($conto->fetch_assoc())["totale"];

function listaPrenotazioni() {
	global $connessione;
	$prenotazioni = $connessione->query("SELECT G.NumPers_Gr AS persone, A.Nome_Att AS att, P.Data_P AS data FROM partecipazione AS P JOIN gruppo AS G on P.IDGr_P=G.ID_Gr JOIN attivita AS A on P.IDAtt_P=A.ID_Att;");

	$output = "";
	while ($prenotazione = $prenotazioni->fetch_assoc()) {
		$output .= "<p>
				<strong>Attivit&agrave;: </strong>" . $prenotazione["att"] . "<br/>
				<strong>Data: </strong>" . $prenprenotazione["data"] . "<br/>
				<strong>Numero partecipanti: </strong>" . $prenotazione["persone"] . "<br/>
			</p>";
	}
	return $output;
}
function listaMessaggi() {
	global $connessione;
	$messaggi = $connessione->query("SELECT * FROM messaggio ORDER BY Data_Mes");

	$output = "";
	while ($messaggio = $messaggi->fetch_assoc()) {
		$output .= "<p>
				<strong>Data e ora: </strong>" . $messaggio["Data_Mes"] . "<br/>
				<strong>Categoria: </strong>" . $prenmessaggio["Categoria_Mes"] . "<br/>
				<strong>Nome mittente: </strong>" . $messaggio["Nome_Mes"] . "<br/>
				<strong>E-mail mittente: </strong>" . $messaggio["Mail_Mes"] . "<br/>
				<strong>Messaggio: </strong>" . $messaggio["Testo_Mes"] . "<br/>
			</p>";
	}
	return $output;
}


	$output = file_get_contents("html/admin.html");
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output = str_replace("%Totale%", $totale, $output);
	$output = str_replace("<p prenotazioni />", listaPrenotazioni(), $output);
	$output = str_replace("<p messaggi />", listaMessaggi(), $output);

	echo $output;
?>
