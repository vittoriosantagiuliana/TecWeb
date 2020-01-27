<?php

	require_once "includes/header.php";
	require_once "includes/footer.php";
	require_once "includes/dbhandler.php";
	require_once "sendmessage.php";
	
	if (!isset($_SESSION)) {
		session_start();
	}
	$connessione = connessione();

	$risultato = isset($_GET["done"]) ? "<h2>Grazie del tuo messaggio! Verrai ricontattato al pi&ugrave; presto!</h2>" : "";
	if (isset($_GET["error"])) {
		$risultato = "<h2>Errore della query: " . urldecode($_GET["error"]) . "</h2>";
	}

	$valueUser = "";
	$valueEmail = "";
	if (isset($_SESSION["userName"])) {
        $userName = $_SESSION["userName"];
        $result = $connessione->query("SELECT Nome_Ut,Mail_Ut FROM utente WHERE Username_Ut='$userName';");
        $user = $result->fetch_assoc();
        $name = $user["Nome_Ut"];
        $email = $user["Mail_Ut"];
        $valueUser = "value=\""  . $name . "\"";
        $valueEmail =  "value=\""  . $email . "\"";
    }

	$output = file_get_contents("html/contacts.html");
	$output = str_replace("<meta/>", file_get_contents("html/head.html"), $output);
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output = str_replace("<h2 risultato/>", $risultato, $output);
	$output = str_replace("%ValueUsername%", $valueUser, $output);
	$output = str_replace("%ValueEmail%", $valueEmail, $output);

	echo $output;

?>
