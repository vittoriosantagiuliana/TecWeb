<?php

	require_once "includes/dbhandler.php";
	$connessione = connessione();
	$tab_name = "utente";
	
	if (isset($_POST["log"])) {
		if ($_POST["user"] == '') {
			$error_u = "Inserisci il nome utente";
		} else if ($_POST["password"] == ''){
			$error_p = "Inserisci la password";
		} else {
			$username = mysqli_real_escape_string($connessione,$_POST["user"]);
			$password = mysqli_real_escape_string($connessione,$_POST["password"]);
			$sql = "SELECT * FROM $tab_name WHERE Username_Ut='$username' and Password_Ut='$password'";
			if (!$result = $connessione->query($sql))
				exit("Errore della query: " . $connessione->error);
			if (mysqli_num_rows($result) == 1) {
				if (!isset($_SESSION)) { session_start(); }
				$_SESSION["userName"] = $username;
				$_SESSION["userType"] = ($username == "admin") ? "admin" : "user";
				$sql = "SELECT UsernameUt_UA FROM utenteaccompagnatore WHERE UsernameUt_UA='$username'";
				if (!$result = $connessione->query($sql))
					exit("Errore della query: " . $connessione->error);
				$_SESSION["UtenteAccompagnatore"] = mysqli_num_rows($result) > 0;
				header("Location: index.php");
				exit();
			} else {
				$error_m="LOGIN FALLITO! Per favore riprova con altre credenziali oppure REGISTRATI";
			}
		}
	}
?>

