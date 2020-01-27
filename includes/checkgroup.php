<?php
	
	require_once "includes/dbhandler.php";
	if (!isset($_SESSION)) {
		session_start();
	}
	if (isset($_SESSION["userName"])) {
		$username = $_SESSION["userName"];
	}
	$connessione = connessione();
	
	$sql = "";
	if (isset($_POST["add"])) {
		if ($_POST["num"] == "") {
			$error_g_n = "Inserisci il numero di componenti";
		} elseif (!isset($_POST["choice"])) {
			$error_g_c = "Scegli una delle alternative";
		} else {
			$number = mysqli_real_escape_string($connessione, $_POST["num"]);
			$typeG = mysqli_real_escape_string($connessione, $_POST["choice"]);
			if ($typeG == "no") {
				$sql="INSERT INTO gruppo (NumPers_Gr) VALUES ($number);";
				$connessione->query($sql);
				$result = $connessione->query("SELECT ID_Gr FROM gruppo ORDER BY ID_Gr DESC LIMIT 1;");
				$id = mysqli_fetch_assoc($result)["ID_Gr"];
				$sql = "INSERT INTO utenteaccompagnatore VALUES ('$username','$id');";
			} else {
				if ($_POST["class"] == "") {
					$error_g_cl = "Inserisci il nome della classe";
				} elseif (($_POST["scuole"] == "---") && ($_POST["newS"] == "")) {
					$error_g_s = "Scegli un istituto dalla lista o aggiungine uno nuovo";
				} elseif (($_POST["scuole"] == "---") && ($_POST["citta"] == "---")) {
					$error_g_s = "Scegli un istituto dalla lista o aggiungine uno nuovo";
				} elseif (($_POST["scuole"] == "---") && ($_POST["ind"] == "")) {
					$error_g_s = "Scegli un istituto dalla lista o aggiungine uno nuovo";
				} elseif (($_POST["newS"] != '' && $_POST["class"] != '' && $_POST["citta"] != '---' && $_POST["ind"] != '' && $_POST["scuole"] == '---')) {
					$nomeC = mysqli_real_escape_string($connessione, $_POST["class"]);
					$nomeS = mysqli_real_escape_string($connessione, $_POST["newS"]);
					$cittaS = strtoupper(mysqli_real_escape_string($connessione, $_POST["citta"]));
					$indS = mysqli_real_escape_string($connessione, $_POST["ind"]);
					$sql2 = "INSERT INTO Istituto VALUES ('$nomeS','$cittaS','$indS');";
					$sql3 = "INSERT INTO gruppo (NumPers_Gr) VALUES ('$number');";
					$connessione->query($sql2);
					$connessione->query($sql3);
					$result1=$connessione->query("SELECT ID_Gr FROM gruppo ORDER BY ID_Gr DESC LIMIT 1;");
					$id = mysqli_fetch_array($result1);
					$idG = $id['ID_Gr'];
					$connessione->query("INSERT INTO Classe VALUES('$idG','$nomeC','$nomeS','$cittaS');");
					$sql = "INSERT INTO utenteaccompagnatore VALUES ('$username','$idG');";
				} elseif ($_POST["class"] != '' && $_POST["scuole"] != '---') {
					$nomeC = mysqli_real_escape_string($connessione, $_POST["class"]);
					$nomeI = mysqli_real_escape_string($connessione, $_POST["scuole"]);
					$sql1 = "INSERT INTO Utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type');";
					$sql2 = "INSERT INTO gruppo (NumPers_Gr) VALUES ('$number');";
					$connessione->query($sql1);
					$connessione->query($sql2);
					$result1 = $connessione->query("SELECT Citta_Ist FROM Istituto WHERE Nome_Ist='$nomeI';");
					$result2 = $connessione->query("SELECT ID_Gr FROM gruppo ORDER BY ID_Gr DESC LIMIT 1;");
					$id = mysqli_fetch_array($result1);
					$id2 = mysqli_fetch_array($result2);
					$cittaI = strtoupper($id["Citta_Ist"]);
					$idG = $id2["ID_Gr"];
					$connessione->query("INSERT INTO Classe VALUES('$idG','$nomeC','$nomeI','$cittaI');");
					$sql = "INSERT INTO utenteaccompagnatore VALUES ('$username','$idG');";
				}
			}
		}
		if ($sql != '') {
			if ($result = $connessione->query($sql)) {
				$risultato = "Gruppo registrato!";
			} else {
				$risultato = "Errore della query: " . $connessione->error;
			}
		}
	}
