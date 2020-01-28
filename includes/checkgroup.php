<?php
    require_once "includes/check.php";
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
        if (!$number = mysqli_real_escape_string($connessione, sanitizeNumber($_POST["num"]))) {
            $error_g_n = "Inserisci il numero di componenti";
        } elseif (!$typeG = mysqli_real_escape_string($connessione, sanitizeString($_POST["choice"]))) {
            $error_g_c = "Scegli una delle alternative";
        } elseif ($typeG == "no") {
            $sql="INSERT INTO gruppo (NumPers_Gr) VALUES ($number);";
            $connessione->query($sql);
            $result = $connessione->query("SELECT ID_Gr FROM gruppo ORDER BY ID_Gr DESC LIMIT 1;");
            $id = mysqli_fetch_assoc($result)["ID_Gr"];
            $sql = "INSERT INTO utenteaccompagnatore VALUES ('$username','$id');";
        } elseif (!$classe = mysqli_real_escape_string($connessione, strtoupper(sanitizeString($_POST["class"])))) {
            $error_g_cl = "Inserisci il nome della classe";
        } elseif (($_POST["scuole"] == "---") && ($_POST["newS"] == "")) {
            $error_g_s = "Scegli un istituto dalla lista o aggiungine uno nuovo";
        } elseif (($_POST["scuole"] == "---") && ($_POST["citta"] == "---")) {
            $error_g_s = "Scegli un istituto dalla lista o aggiungine uno nuovo";
        } elseif (($_POST["scuole"] == "---") && ($_POST["ind"] == "")) {
            $error_g_s = "Scegli un istituto dalla lista o aggiungine uno nuovo";
        } elseif ($scuola = mysqli_real_escape_string($connessione, sanitizeString($_POST["newS"]))
				&& $cittaScuola = mysqli_real_escape_string($connessione, strtoupper(sanitizeString($_POST["citta"])))
				&& $indirizzoScuola = mysqli_real_escape_string($connessione, sanitizeString($_POST["ind"])) && $_POST["ind"] != ""
				&& $_POST["scuole"] == "---") {
            $inserisciIstituto = "INSERT INTO istituto VALUES ('$scuola','$citta','$indirizzoScuola');";
            $inserisciGruppo = "INSERT INTO gruppo (NumPers_Gr) VALUES ('$number');";
            $connessione->query($inserisciIstituto);
            $connessione->query($inserisciGruppo);
            $gruppo = $connessione->query("SELECT ID_Gr FROM gruppo ORDER BY ID_Gr DESC LIMIT 1;");
            $idGruppo = mysqli_fetch_array($gruppo)["ID_Gr"];
            $connessione->query("INSERT INTO classe VALUES('$idGruppo','$classe','$scuola','$citta');");
            $sql = "INSERT INTO utenteaccompagnatore VALUES ('$username','$idGruppo');";
        } elseif ($_POST["class"] != '' && $_POST["scuole"] != '---') {
            $scuola = mysqli_real_escape_string($connessione, sanitizeString($_POST["scuole"]));
            $inserisciGruppo = "INSERT INTO gruppo (NumPers_Gr) VALUES ('$number');";
            $connessione->query($inserisciGruppo);
            $citta = $connessione->query("SELECT Citta_Ist FROM istituto WHERE Nome_Ist='$scuola';");
            $gruppo = $connessione->query("SELECT ID_Gr FROM gruppo ORDER BY ID_Gr DESC LIMIT 1;");
            $citta = mysqli_fetch_array($citta)["Citta_Ist"];
            $idGruppo = mysqli_fetch_array($gruppo)["ID_Gr"];
            $connessione->query("INSERT INTO classe VALUES('$idGruppo','$classe','$scuola','$citta');");
            $sql = "INSERT INTO utenteaccompagnatore VALUES ('$username','$idGruppo');";
        }
        if ($sql != "") {
            if ($result = $connessione->query($sql)) {
                $risultato = "Gruppo registrato!";
                $_SESSION["UtenteAccompagnatore"] = true;
            } else {
                $risultato = "Errore della query: " . $connessione->error;
            }
        }
    }
