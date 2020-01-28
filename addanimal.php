<?php
	if (!isset($_SESSION)) {
		session_start();
	}
	if (!isset($_SESSION["userName"]) || $_SESSION["userType"] != "admin" || !isset($_POST["addAnimal"])) {
		header("Location: animals.php");
		exit();
	}
	require_once "includes/check.php";
	require_once "includes/dbhandler.php";
	$connessione = connessione();
	
	$connessione = connessione();
	$nome = mysqli_real_escape_string($connessione, sanitizeString($_POST['nomeA']));
	$scie = mysqli_real_escape_string($connessione, sanitizeString($_POST['scieA']));
	$ordine = mysqli_real_escape_string($connessione, sanitizeString($_POST['ordA']));
	$famiglia = mysqli_real_escape_string($connessione, sanitizeString($_POST['famA']));
	$habitat = mysqli_real_escape_string($connessione, sanitizeString($_POST['habA']));
	$riproduzione = mysqli_real_escape_string($connessione, sanitizeString($_POST['ripA']));
	$curiosita = mysqli_real_escape_string($connessione, sanitizeString($_POST['curioA']));
	$currfile = $_FILES['imgA']['tmp_name'];
	$filename = $_FILES['imgA']['name'];
	$data = fopen($currfile, 'rb');
	$size = filesize($currfile);
	$contents = fread($data, $size);
	fclose($data);
	$bin_data = addslashes($contents);
	$sql = "INSERT INTO animale(Comune_An,Scientifico_An,Ordine_An,Famiglia_An,Habitat_An,Riproduzione_An,Curiosita_An,Immagine_An) VALUES ('$nome','$scie','$ordine','$famiglia','$habitat','$riproduzione','$curiosita','$bin_data');";
	if ($result = $connessione->query($sql)) {
		header("Location: animals.php");
		exit();
	} else {
		echo "Errore della query: " . $connessione->error;
		header("Refresh: 5; URL=animals.php");
		exit();
	}
