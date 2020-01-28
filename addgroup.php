<?php

	require_once "includes/header.php";
	require_once "includes/footer.php";
	require_once "includes/dbhandler.php";
	require_once "includes/checkgroup.php";
	if (!isset($_SESSION)) {
		session_start();
	}
	if (!isset($_SESSION["userName"])) {
		header("Location: login.php");
		exit();
	}
	$connessione = connessione();
function listaScuole()
{
	global $connessione;
	$scuole = $connessione->query("SELECT Nome_Ist, Citta_Ist FROM istituto");
	
	$selectScuole = "<select name=\"scuole\">
						<option value=\"---\">- - -</option>";
	while ($scuola = $scuole->fetch_assoc()) {
		$selectScuole .= "<option value=\"" . $scuola["Nome_Ist"] . "\">" .
			$scuola["Nome_Ist"] . " (" . $scuola["Citta_Ist"] . ")" .
			"</option>";
	}
	$selectScuole .= "</select>";
	return $selectScuole;
}

	$output = file_get_contents("html/addgroup.html");
	$output = str_replace("<meta/>", file_get_contents("html/head.html"), $output);
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output = str_replace("<h2 risultato/>", isset($risultato) ? $risultato : "", $output);
	$output = str_replace("<div error_g_n/>", isset($error_g_n) ? "<div class=\"error\">" . $error_g_n . "</div>" : "", $output);
	$output = str_replace("<div error_g_c/>", isset($error_g_c) ? "<div class=\"error\">" . $error_g_c . "</div>" : "", $output);
	$output = str_replace("<div error_g_cl/>", isset($error_g_cl) ? "<div class=\"error\">" . $error_g_cl . "</div>" : "", $output);
	$output = str_replace("<select name=\"scuole\"/>", listaScuole(), $output);

	echo $output;
