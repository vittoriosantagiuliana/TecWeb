<?php

	require_once "includes/header.php";
	require_once "includes/footer.php";
	require_once "includes/checksignin.php";
	require_once "includes/checklogin.php";
	require_once "includes/dbhandler.php";
	$connessione = connessione();

	if (!isset($_SESSION)) {
		session_start();
	}

function listaScuole() {
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

	$output = file_get_contents("html/login.html");
	$output = str_replace("<meta/>", file_get_contents("html/head.html"), $output);
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);

	$output = str_replace("<h3 errorH/>", isset($error_m) ? "<h3 class=\"errorH\">" . $error_m . "</h3>" : "", $output);
	$output = str_replace("<div error_u/>", isset($error_u) ? "<div class=\"error\">" . $error_u . "</div>" : "", $output);
	$output = str_replace("<div error_p/>", isset($error_p) ? "<div class=\"error\">" . $error_p . "</div>" : "", $output);
	$output = str_replace("<div error_r_u/>", isset($error_r_u) ? "<div class=\"error\">" . $error_r_u . "</div>" : "", $output);
	$output = str_replace("<div error_n/>", isset($error_n) ? "<div class=\"error\">" . $error_n . "</div>" : "", $output);
	$output = str_replace("<div error_r_p/>", isset($error_r_p) ? "<div class=\"error\">" . $error_r_p . "</div>" : "", $output);
	$output = str_replace("<div error_r_n/>", isset($error_r_n) ? "<div class=\"error\">" . $error_r_n . "</div>" : "", $output);
	$output = str_replace("<div error_r_s/>", isset($error_r_s) ? "<div class=\"error\">" . $error_r_s . "</div>" : "", $output);
	$output = str_replace("<div error_r_d/>", isset($error_r_d) ? "<div class=\"error\">" . $error_r_d . "</div>" : "", $output);
	$output = str_replace("<div error_r_e/>", isset($error_r_e) ? "<div class=\"error\">" . $error_r_e . "</div>" : "", $output);
	$output = str_replace("<div error_e/>", isset($error_e) ? "<div class=\"error\">" . $error_e . "</div>" : "", $output);
	$output = str_replace("<div error_r_t/>", isset($error_r_t) ? "<div class=\"error\">" . $error_r_t . "</div>" : "", $output);
	$output = str_replace("<div error_g_n/>", isset($error_g_n) ? "<div class=\"error\">" . $error_g_n . "</div>" : "", $output);
	$output = str_replace("<div error_g_c/>", isset($error_g_c) ? "<div class=\"error\">" . $error_g_c . "</div>" : "", $output);
	$output = str_replace("<div error_g_cl/>", isset($error_g_cl) ? "<div class=\"error\">" . $error_g_cl . "</div>" : "", $output);
	$output = str_replace("<select name=\"scuole\"/>", listaScuole(), $output);

	// mitigazione errori/warning html5
	$output = str_replace("xml:lang=\"en\"", "lang=\"en\"", $output);
	$output = str_replace("script type=\"text/javascript\"", "script", $output);

	echo $output;
