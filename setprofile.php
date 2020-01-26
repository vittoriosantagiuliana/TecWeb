<?php

	require_once "includes/dbhandler.php";
	$connessione = connessione();
	if (!isset($_SESSION)) {
		session_start();
	}
	$tab_name="utente";
	
	if (isset($_SESSION["userName"])) {
		$username = $_SESSION["userName"];
		$userR = $connessione->query("SELECT Password_Ut,Nome_Ut,Cognome_Ut,Mail_Ut FROM utente WHERE Username_Ut='$username';");
		$user = mysqli_fetch_array($userR);
		$password = $user["Password_Ut"];
		$nome = $user["Nome_Ut"];
		$cognome = $user["Cognome_Ut"];
		$email = $user["Mail_Ut"];
	}
	if (isset($_POST["mod"])) {
		$newName = $_POST["name"];
		$newSurname = $_POST["surname"];
		$newPassword = $_POST["password"];
		if ($newName == '') {
			$newName = $nome;
		}
		if ($newSurname == '') {
			$newSurname = $cognome;
		}
		if ($newPassword == '') {
			$newPassword = $password;
		}
		$sql = ("UPDATE utente SET Nome_Ut='$newName',Cognome_Ut='$newSurname',Password_Ut='$newPassword' WHERE Username_Ut='$username';");
		$result = $connessione->query($sql);
		if (!$result) {
			echo "Errore della query: ".$connessione->error;
			exit();
		} else {
			header("Location: profile.php");
		}


		if ($result = $connessione->query($sql)) {
			header("Location: profile.php");
			exit();
		}
		else {
			header("Location: contacts.php?error=" . urldecode($connessione->error));
			exit();
		}

	}
