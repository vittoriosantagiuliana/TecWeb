<?php
	require_once "includes/header.php";
	require_once "includes/footer.php";
	require_once "includes/dbhandler.php";
	
	$connessione = connessione();
	if (!isset($_GET["animal"])) {
		header("Location: notfound.php");
		exit();
	}
	$idAnimale = mysqli_real_escape_string($connessione, urldecode($_GET["animal"]));
	$sql = "SELECT * FROM animale WHERE Comune_An = \"$idAnimale\";";
	if (!$result = $connessione->query($sql)) {
		header("Location: notfound.php");
		exit();
	}
	if (mysqli_num_rows($result) != 1) {
		header("Location: notfound.php");
		exit();
	}
	$animale = $result->fetch_assoc();
	$nome = $animale["Comune_An"];
	$nomescientifico = $animale["Scientifico_An"];
	$ordine = $animale["Ordine_An"];
	$famiglia = $animale["Famiglia_An"];
	$habitat = $animale["Habitat_An"];
	$riproduzione = $animale["Riproduzione_An"];
	$curiosita = $animale["Curiosita_An"];
	$immagine = base64_encode($animale["Immagine_An"]);


	$output = file_get_contents("html/animaldetails.html");
	$output = str_replace("<meta/>", file_get_contents("html/head.html"), $output);
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	
	$output = str_replace("%Nome%", $nome, $output);
	$output = str_replace("%NomeScientifico%", $nomescientifico, $output);
	$output = str_replace("%Ordine%", $ordine, $output);
	$output = str_replace("%Famiglia%", $famiglia, $output);
	$output = str_replace("%Habitat%", $habitat, $output);
	$output = str_replace("%Riproduzione%", $riproduzione, $output);
	$output = str_replace("%Curiosita%", $curiosita, $output);
	$output = str_replace("%Immagine%", $immagine, $output);
	
	echo $output;
?>
