<?php

	require_once "includes/dbhandler.php";
	$connessione = connessione();
	$tab_name = "utente";

	$username = '';
	$password = '';
	$name = '';
	$surname = '';
	$birth = '';
	$email = '';
	$type = '';
	if (isset($_POST["sign"])) {
		if ($_POST["user"] == "") {
			$error_r_u = "Inserisci un nome utente";
		} elseif ($_POST["password"] == "") {
			$error_r_p = "Inserisci una password valida";
		} elseif ($_POST["name"] == "") {
			$error_r_n = "Inserisci il tuo nome";
		} elseif ($_POST["surname"] == "") {
			$error_r_s = "Inserisci il tuo cognome";
		} elseif ($_POST["date"] == "") {
			$error_r_d = "Inserisci la tua data di nascita";
		} elseif (empty($_POST["email"]) || ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
			$error_r_e = "Inserisci il tuo indirizzo mail";
		} elseif (! isset($_POST["type"])) {
			$error_r_t = "Scegli una delle alternative";
		} else {
			$username = mysqli_real_escape_string($connessione, $_POST["user"]);
			$password = mysqli_real_escape_string($connessione, $_POST["password"]);
			if (strlen($password) > 20) {
				$pError = "La password deve contenere al massimo 20 caratteri";
			} else {
				$name = mysqli_real_escape_string($connessione, $_POST["name"]);
				$surname = mysqli_real_escape_string($connessione, $_POST["surname"]);
				$birth = mysqli_real_escape_string($connessione, $_POST["date"]);
				$email = mysqli_real_escape_string($connessione, $_POST["email"]);
				$type = mysqli_real_escape_string($connessione, $_POST["type"]);
				$search = $connessione->query("SELECT * FROM utente WHERE Username_Ut='$username'");
				$search2 = $connessione->query("SELECT * FROM utente WHERE Mail_Ut='$email'");
				$row1 = mysqli_num_rows($search);
				$row2 = mysqli_num_rows($search2);
				if ($row1 == 0 && $row2 == 0) {
					if ($type == 'Utente') {
						$sql = ("INSERT INTO utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type')");
					} else {
						if ($_POST["num"] == "") {
							$error_g_n = "Inserisci il numero di componenti";
						} elseif (! isset($_POST["choice"])) {
							$error_g_c = "Scegli una delle alternative";
						} else {
							$number = mysqli_real_escape_string($connessione, $_POST["num"]);
							$typeG = mysqli_real_escape_string($connessione, $_POST["choice"]);
							if ($typeG == "no") {
								$sql1 = "INSERT INTO utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type');";
								$sql2 = "INSERT INTO gruppo (NumPers_Gr) VALUES ($number);";
								$connessione->query($sql1);
								$connessione->query($sql2);
								$result1 = $connessione->query("SELECT ID_Gr FROM gruppo ORDER BY ID_Gr DESC LIMIT 1;");
								$id = mysqli_fetch_array($result1);
								$idG = $id['ID_Gr'];
								$sql = "INSERT INTO utenteaccompagnatore VALUES ('$username','$idG');";
							} else {
								if ($_POST["class"] == "") {
									$error_g_cl = "Inserisci il nome della classe";
								} elseif (($_POST["scuole"] == "---") && ($_POST["newS"] == "")) {
									$error_g_s = "Scegli un istituto dalla lista o aggiungine uno nuovo";
								} elseif (($_POST["scuole"] == "---") && ($_POST["citta"] == "---")) {
									$error_g_s = "Scegli un istituto dalla lista o aggiungine uno nuovo";
								} elseif (($_POST["scuole"] == "---") && ($_POST["ind"] == "")) {
									$error_g_s = "Scegli un istituto dalla lista o aggiungine uno nuovo";
								} elseif (($_POST["newS"] != "" && $_POST["class"] != "" && $_POST["citta"] != "---" && $_POST["ind"] != "" && $_POST["scuole"] == "---")) {
									$nomeC = mysqli_real_escape_string($connessione, $_POST["class"]);
									$nomeS = mysqli_real_escape_string($connessione, $_POST["newS"]);
									$cittaS = strtoupper(mysqli_real_escape_string($connessione, $_POST["citta"]));
									$indS = mysqli_real_escape_string($connessione, $_POST["ind"]);
									$sql1 = "INSERT INTO utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type');";
									$sql2 = "INSERT INTO istituto VALUES ('$nomeS','$cittaS','$indS');";
									$sql3 = "INSERT INTO gruppo (NumPers_Gr) VALUES ('$number');";
									$connessione->query($sql1);
									$connessione->query($sql2);
									$connessione->query($sql3);
									$result1 = $connessione->query('SELECT ID_Gr FROM gruppo ORDER BY ID_Gr DESC LIMIT 1;');
									$id = mysqli_fetch_array($result1);
									$idG = $id["ID_Gr"];
									$connessione->query("INSERT INTO classe VALUES('$idG','$nomeC','$nomeS','$cittaS');");
									$sql = "INSERT INTO utenteaccompagnatore VALUES ('$username','$idG');";
								} elseif ($_POST['class'] != '' && $_POST["scuole"] != "---") {
									$nomeC = mysqli_real_escape_string($connessione, $_POST["class"]);
									$nomeI = mysqli_real_escape_string($connessione, $_POST["scuole"]);
									$sql1 = "INSERT INTO utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type');";
									$sql2 = "INSERT INTO gruppo (NumPers_Gr) VALUES ('$number');";
									$connessione->query($sql1);
									$connessione->query($sql2);
									$result1 = $connessione->query("SELECT Citta_Ist FROM istituto WHERE Nome_Ist='$nomeI';");
									$result2 = $connessione->query('SELECT ID_Gr FROM gruppo ORDER BY ID_Gr DESC LIMIT 1;');
									$id = mysqli_fetch_array($result1);
									$id2 = mysqli_fetch_array($result2);
									$cittaI = strtoupper($id["Citta_Ist"]);
									$idG = $id2["ID_Gr"];
									$connessione->query("INSERT INTO classe VALUES('$idG','$nomeC','$nomeI','$cittaI');");
									$sql = "INSERT INTO utenteaccompagnatore VALUES ('$username','$idG');";
								}
							}
						}
					}
					if ($sql != "") {
						if ($result = $connessione->query($sql)) {
							header("Location: correctsignin.php");
						} else {
							echo "Errore della query: " . $connessione->error;
							exit();
						}
					}
				} elseif ($row1 > 0) {
					$error_n = "Nome utente gi&agrave; in uso";
				}
			}
		}
	}
