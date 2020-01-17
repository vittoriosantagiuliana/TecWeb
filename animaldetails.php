<?php
	require_once "includes/header.php";
	require_once "includes/footer.php";
	require_once "includes/dbhandler.php";
	
	$connessione = connessione();
	$tab_name="animali";
	if (!isset($_GET["animal"])) {
		header("Location: notfound.php");
		exit();
	}
	$idAnimale = mysqli_real_escape($connessione, $_GET["animal"]);
	$sql = "SELECT * FROM $tab_name WHERE NomeComune = $idAnimale";
	if (!$result = $connessione->query($sql)) {
		header("Location: notfound.php");
		exit();
	}
	if (mysqli_num_rows($result) != 1) {
		header("Location: notfound.php");
		exit();
	}
	$animale = $result->fetch_assoc();
	$nome = $animale["NomeComune"];
	$nomescientifico = $animale["NomeScientifico"];
	$ordine = $animale["Ordine"];
	$famiglia = $animale["Famiglia"];
	$habitat = $animale["Habitat"];
	$riproduzione = $animale["Riproduzione"];
	$curiosita = $animale["Curiosita"];
	$imgpath = $animale["ImagePath"];


	$output = file_get_contents("html/animaldetails.html");
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	
	$output = str_replace("%Nome%", $nome, $output);
	$output = str_replace("%NomeScientifico%", $nomescientifico, $output);
	$output = str_replace("%Ordine%", $ordine, $output);
	$output = str_replace("%Famiglia%", $famiglia, $output);
	$output = str_replace("%Habitat%", $habitat, $output);
	$output = str_replace("%Riproduzione%", $riproduzione, $output);
	$output = str_replace("%Curiosita%", $curiosita, $output);
	$output = str_replace("%ImgPath%", $imgpath, $output);

	echo $output;
?>