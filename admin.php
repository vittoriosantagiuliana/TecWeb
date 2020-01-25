<?php
	require_once "includes/header.php";
	require_once "includes/footer.php";
	if (!isset($_SESSION)) {
		session_start();
	}
	if (!isset($_SESSION["userName"])) {
		header("Location: home.php");
	}
	if ($_SESSION["userType"] != "admin") {
		header("Location: user.php");
	}

	$output = file_get_contents("html/admin.html");
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);

	echo $output;
?>
