<?php
	require_once "includes/dbhandler.php";
	$connessione = connessione();
	if (!isset($_SESSION)) {
		session_start();
	}

	if (isset($_POST['form_button'])) {
		if (!isset($_SESSION['userName'])) {
			$name = mysqli_real_escape_string($connessione, $_POST['name']);
			$email = mysqli_real_escape_string($connessione, $_POST['email']);
		}
		$message = mysqli_real_escape_string($connessione, $_POST['message']);
		$cat = mysqli_real_escape_string($connessione, $_POST['subject']);
		$today = new DateTime();
		$sql = ("INSERT INTO messaggio(Categoria_Mes,Nome_Mes,Mail_Mes,Testo_Mes) VALUES ('$cat','$name','$email','$message','$today');");
		if ($result = $connessione->query($sql)) {
			header("Location: contacts.php?done");
			exit();
		}
		else {
			header("Location: contacts.php?error=" . urlencode($connessione->error));
			exit();
		}

	}
