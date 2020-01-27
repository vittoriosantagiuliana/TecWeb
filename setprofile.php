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
	$user = mysqli_fetch_array($result);
	$password = $user["Password_Ut"];
	$nome = $user["Nome_Ut"];
	$cognome = $user["Cognome_Ut"];

	if (isset($_POST["modifica"])) {
		$newName=$nome;
		$newSurname=$cognome;
		$newPassword=$password;
		if(isset($_POST["name"]) && $_POST["name"]!='')
			$newName = $_POST["name"];
		if(isset($_POST["surname"]) && $_POST["surname"]!='')
			$newSurname = $_POST["surname"];
		if(isset($_POST["password"]) && $_POST["password"]!='')
			$newPassword = $_POST["password"];
		$sql = ("UPDATE utente SET Nome_Ut='$newName',Cognome_Ut='$newSurname',Password_Ut='$newPassword' WHERE Username_Ut='$username';");
		
		if ($result = $connessione->query($sql)) {
			header("Location: user.php");
			exit();
		}
		else {
			header("Location: profile.php?error=" . urlencode($connessione->error));
			exit();
		}
	}
