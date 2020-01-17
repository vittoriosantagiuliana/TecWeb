<?php
	require_once "includes/header.php";
	require_once "includes/footer.php";
	require_once "includes/dbhandler.php";
	
	$connessione = connessione();
	$tab_name="animali";
	if (isset($_GET["animal"])) {
		$idAnimale = mysqli_real_escape($connessione, $_GET["animal"]);
		$sql = "SELECT * FROM $tab_name WHERE NomeComune = $idAnimale";
		$result=$connessione->query($sql);

		$output = file_get_contents("html/animaldetails.html");
		$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
		$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);

		echo $output;
	}
	else
		header("Location: notfound.php");
?>