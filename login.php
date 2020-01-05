<?php

function listaScuole()
{
	$selectScuole = "<select name='scuole'>";
	while($scuola = mysqli_fetch_array($scuole))
	{
		$selectScuole .= "<option value=\"" . $scuola['Nome_Ist'] . "\">" .
			$scuola['Nome_Ist'] . " (" . $scuola['Citta_Ist'] . ")" .
			"</option>";
	}
	$selectScuole .= "</select>";
	return $selectScuole;
}

	session_start();
	require_once "includes/header.php";
	require_once "includes/footer.php";
	require_once "includes/checksignin.php";
	require_once "includes/checklogin.php";


	$output = file_get_contents("html/login.html");
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);

	$output = str_replace("<select name='scuole'/>", listaScuole(), $output);

	$output = str_replace("<h3 errorH/>", isset($error_m) ? "<h3 class=\"errorH\">" . $error_u . "</h3>" : "", $output);
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


	echo $output;

?>
