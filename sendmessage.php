<?php

	require_once "includes/check.php";
	require_once "includes/dbhandler.php";
	$connessione = connessione();
	if (!isset($_SESSION)) {
		session_start();
	}

	if (isset($_POST["sendmessage"])) {
		$name = mysqli_real_escape_string($connessione, sanitizeString($_POST['name']));
		$email = mysqli_real_escape_string($connessione, sanitizeEmail($_POST['email']));
		$message = mysqli_real_escape_string($connessione, sanitizeString($_POST['message']));
		$cat = mysqli_real_escape_string($connessione, sanitizeString($_POST['subject']));
		$today = date("Y-m-d");
		$sql = ("INSERT INTO messaggio(Categoria_Mes,Nome_Mes,Mail_Mes,Testo_Mes,Data_Mes) VALUES ('$cat','$name','$email','$message','$today');");
		if ($result = $connessione->query($sql)) {
			header("Location: contacts.php?done");
			exit();
		} else {
			header("Location: contacts.php?error=" . urlencode($connessione->error));
			exit();
		}
	}
