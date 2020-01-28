<?php
	
	require_once "includes/check.php";
	require_once "includes/dbhandler.php";
	$connessione = connessione();

	
	if (isset($_POST["log"])) {
		if (!$username = mysqli_real_escape_string($connessione, sanitizeString($_POST["user"]))) {
			$error_u = "Inserisci il nome utente";
		} elseif (!$password = mysqli_real_escape_string($connessione, sanitizeString($_POST["password"]))) {
			$error_p="Inserisci la password";
		} else {
			$sql = "SELECT * FROM utente WHERE Username_Ut='$username' and Password_Ut='$password'";
			if (!$result = $connessione->query($sql)) {
				$error_m = "Errore della query: " . $connessione->error;
			} elseif (mysqli_num_rows($result) == 1) {
				if (!isset($_SESSION)) {
					session_start();
				}
				$_SESSION["userName"] = $username;
				$_SESSION["userType"] = ($username == "admin") ? "admin" : "user";
				$sql = "SELECT UsernameUt_UA FROM utenteaccompagnatore WHERE UsernameUt_UA='$username'";
				if ($result = $connessione->query($sql)) {
					$_SESSION["UtenteAccompagnatore"] = mysqli_num_rows($result) > 0;
					header("Location: index.php");
					exit();
				} else {
					$error_m = "Errore della query: " . $connessione->error;
				}
			} else {
				$error_m="LOGIN FALLITO! Per favore riprova con altre credenziali oppure REGISTRATI";
			}
		}
	}
