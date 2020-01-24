<?php
	require_once "includes/header.php";
	require_once "includes/footer.php";

	$output = file_get_contents("html/correctsignin.html");
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);

	echo $output;
?>
