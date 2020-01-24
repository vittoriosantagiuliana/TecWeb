<?php

	require_once "includes/header.php";
	require_once "includes/footer.php";
	require_once "sendmessage.php";
	if (!isset($_SESSION)) {
		session_start();
	}

	$inviato = isset($done) ? "<h2>" . $done . "</h2>" : "";
	

	$output = file_get_contents("html/contacts.html");
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output = str_replace("<h2 inviato/>", $inviato, $output);
	if (isset($_SESSION["userName"])) {
		$output = str_replace("%ValueUsername%", $name, $output);
		$output = str_replace("%ValueEmail%", $email, $output);
	}

	echo $output;

?>
