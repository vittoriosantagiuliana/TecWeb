<?php
	require_once "includes/dbhandler.php";
	$connessione = connessione();
	if (!isset($_SESSION)) {
		session_start();
	}
	
	if (isset($_POST["add"])) {
		if ($_POST["data"]=='') {
			$errorD="Inserisci una data per la tua prenotazione!";
		} else {
			$idA = mysqli_real_escape_string($connessione, $_POST["att"]);
			$idG = mysqli_real_escape_string($connessione, $_POST["group"]);
			$date = mysqli_real_escape_string($connessione, $_POST["data"]);
			$today = new DateTime();
			$choice = new DateTime($date);
			if ($choice <= $today) {
				$errorD = "Inserisci una data valida per la tua prenotazione!";
			} else {
				$sql = "INSERT INTO partecipazione VALUES ('$idG','$idA','$date')";
				$result = $connessione->query($sql);
				if (!$result) {
					echo "Errore della query: ".$connessione->error;
					exit();
				} else {
					$done="Prenotazione effettuata!";
				}
			}
		}
	}
	if (isset($_POST["addAtt"])) {
		$nomeAtt = $_POST['nomeAtt'];
		$descAtt = $_POST['descAtt'];
		$currfile = $_FILES['imgAtt']['tmp_name'];
		$filename = $_FILES['imgAtt']['name'];
		$data=fopen($currfile, 'rb');
		$size=filesize($currfile);
		$contents=fread($data, $size);
		fclose($data);
		$bin_data = addslashes($contents);
		  
		$result=$connessione->query("INSERT INTO attivita(Nome_Att,Descrizione_Att,Immagine_Att) VALUES ('$nomeAtt','$descAtt','$bin_data')");
		if ($result) {
			header("Location: activities.php");
		} else {
			echo "Errore della query: " . $connessione->error;
			exit();
		}
	}
