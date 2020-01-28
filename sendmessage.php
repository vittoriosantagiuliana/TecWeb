<?php

	require_once "includes/check.php";
	require_once "includes/dbhandler.php";
	$connessione = connessione();
	if (!isset($_SESSION)) {
		session_start();
	}

	if (isset($_POST["sendmessage"])) {
		if (!$name = mysqli_real_escape_string($connessione, sanitizeString($_POST['name']))) {
			header("Location: contacts.php?error=" . urlencode("Inserisci un nome valido"));
			exit();
		} elseif (!$email = mysqli_real_escape_string($connessione, sanitizeEmail($_POST['email']))) {
			header("Location: contacts.php?error=" . urlencode("Inserisci una mail valida"));
			exit();
		} elseif (!$message = mysqli_real_escape_string($connessione, sanitizeString($_POST['message']))) {
			header("Location: contacts.php?error=" . urlencode("Inserisci un messaggio"));
			exit();
		} elseif (!$cat = mysqli_real_escape_string($connessione, sanitizeString($_POST['subject']))) {
			header("Location: contacts.php?error=" . urlencode("Seleziona una categoria"));
			exit();
		} else {
			$today = date("Y-m-d H:i:s");
			$sql = ("INSERT INTO messaggio(Categoria_Mes,Nome_Mes,Mail_Mes,Testo_Mes,Data_Mes) VALUES ('$cat','$name','$email','$message','$today');");
			if ($result = $connessione->query($sql)) {
				header("Location: contacts.php?done");
				exit();
			} else {
				header("Location: contacts.php?error=" . urlencode($connessione->error));
				exit();
			}
		}
	}
