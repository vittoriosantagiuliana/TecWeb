<?php

	if (!isset($_SESSION)) {
		session_start();
	}
	if (!isset($_SESSION["userName"]) || !isset($_POST["buy"])) {
		header("Location: schedule.php");
		exit();
	}
	require_once "includes/check.php";
	require_once "includes/dbhandler.php";
	$connessione = connessione();
	$username = $_SESSION["userName"];

	$totI = mysqli_real_escape_string($connessione, sanitizeNumber($_POST["intero"]));
	$totRA = mysqli_real_escape_string($connessione, sanitizeNumber($_POST["ridottoA"]));
	$totRB = mysqli_real_escape_string($connessione, sanitizeNumber($_POST["ridottoB"]));
	if ($totI == 0 && $totRA == 0 && $totRB == 0) {
		header("Location: schedule.php");
	}
	$totale = $totI * 12 + $totRB * 8 + $totRA * 10;
	$sql = "INSERT INTO ticket(UsernameUt_T,NumInteri_T,NumRidottiB_T,NumRidottiA_T,CostoTot_T) VALUES('$username',$totI,$totRB,$totRA,$totale)";
	if ($connessione->query($sql)) {
		header("Location: schedule.php?result=" . urlencode("Grazie dell'acquisto!"));
		exit();
	} else {
		header("Location: schedule.php?result=" . urlencode("Errore della query: " . $connessione->error));
		exit();
	}
