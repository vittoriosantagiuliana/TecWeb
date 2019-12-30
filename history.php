<?php
	require_once "header.php";
	require_once "footer.php";

	$output = file_get_contents("html/history.html");
	$output = str_replace('<div id="header"></div>', Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);

	echo $output;
?>
