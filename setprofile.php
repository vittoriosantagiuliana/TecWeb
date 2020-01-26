<?php

	require_once "includes/dbhandler.php";
	if (!isset($_SESSION)) {
		session_start();
	}
	if (!isset($_SESSION["userName"])) {
		header("Location: login.php");
		exit();
	}
	$connessione = connessione();
	
	$username = $_SESSION["userName"];
	$result = $connessione->query("SELECT Password_Ut,Nome_Ut,Cognome_Ut,Mail_Ut FROM utente WHERE Username_Ut='$username';");
	$user = $result->fetch_assoc;
	$password = $user["Password_Ut"];
	$nome = $user["Nome_Ut"];
	$cognome = $user["Cognome_Ut"];

	if (isset($_POST["modifica"])) {
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
		
		if ($result = $connessione->query($sql)) {
			header("Location: profile.php");
			exit();
		}
		else {
			header("Location: profile.php?error=" . urlencode($connessione->error));
			exit();
		}
	}
