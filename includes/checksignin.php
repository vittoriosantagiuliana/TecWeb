<?php

    require_once "includes/check.php";
    require_once "includes/dbhandler.php";
    $connessione = connessione();

    $sql = "";
    if (isset($_POST["sign"])) {
        if (!$username = mysqli_real_escape_string($connessione, sanitizeString($_POST["user"]))) {
            $error_r_u = "Inserisci un nome utente";
        } elseif (!$password = mysqli_real_escape_string($connessione, sanitizeString($_POST["password"]))) {
            $error_r_p = "Inserisci una password valida";
        } elseif (strlen($password) > 20) {
            $error_r_p = "La password deve contenere al massimo 20 caratteri";
        } elseif (!$name = mysqli_real_escape_string($connessione, sanitizeString($_POST["name"]))) {
            $error_r_n = "Inserisci il tuo nome";
        } elseif (!$surname = mysqli_real_escape_string($connessione, sanitizeString($_POST["surname"]))) {
            $error_r_s = "Inserisci il tuo cognome";
        } elseif (!$birth = mysqli_real_escape_string($connessione, sanitizeString($_POST["date"]))) {
            $error_r_d = "Inserisci la tua data di nascita";
        } elseif (!$email = mysqli_real_escape_string($connessione, sanitizeEmail($_POST["email"]))) {
            $error_r_e = "Inserisci il tuo indirizzo mail";
        } elseif (!$type = mysqli_real_escape_string($connessione, sanitizeString($_POST["type"]))) {
            $error_r_t = "Scegli una delle alternative";
        } else {
            $searchNome = $connessione->query("SELECT * FROM utente WHERE Username_Ut='$username'");
            $searchMail = $connessione->query("SELECT * FROM utente WHERE Mail_Ut='$email'");
            $rowNome = mysqli_num_rows($searchNome);
            $rowMail = mysqli_num_rows($searchMail);
            if ($rowNome == 0 && $rowMail == 0) {
                if ($type == 'Utente') {
                    $sql = "INSERT INTO utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type')";
                } elseif (!$number = mysqli_real_escape_string($connessione, sanitizeNumber($_POST["num"]))) {
                    $error_g_n = "Inserisci il numero di componenti";
                } elseif (!$typeG = mysqli_real_escape_string($connessione, sanitizeString($_POST["choice"]))) {
                    $error_g_c = "Scegli una delle alternative";
                } elseif ($typeG == "no") {
                    $inserisciUtente = "INSERT INTO utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type');";
                    $inserisciGruppo = "INSERT INTO gruppo (NumPers_Gr) VALUES ($number);";
                    $connessione->query($inserisciUtente);
                    $connessione->query($inserisciGruppo);
                    $gruppo = $connessione->query("SELECT ID_Gr FROM gruppo ORDER BY ID_Gr DESC LIMIT 1;");
                    $idGruppo = mysqli_fetch_assoc($gruppo)["ID_Gr"];
                    $sql = "INSERT INTO utenteaccompagnatore VALUES ('$username','$idGruppo');";
                } elseif (!$classe = mysqli_real_escape_string($connessione, strtoupper(sanitizeString($_POST["class"])))) {
                    $error_g_cl = "Inserisci il nome della classe";
                } elseif (($_POST["scuole"]	 == "---") && ($_POST["newS"] == "")) {
                    $error_g_s = "Scegli un istituto dalla lista o aggiungine uno nuovo";
                } elseif (($_POST["scuole"] == "---") && ($_POST["citta"] == "---")) {
                    $error_g_s = "Scegli un istituto dalla lista o aggiungine uno nuovo";
                } elseif (($_POST["scuole"] == "---") && ($_POST["ind"] == "")) {
                    $error_g_s = "Scegli un istituto dalla lista o aggiungine uno nuovo";
                } elseif ($scuola = mysqli_real_escape_string($connessione, sanitizeString($_POST["newS"]))
                        && $cittaScuola = mysqli_real_escape_string($connessione, strtoupper(sanitizeString($_POST["citta"])))
                        && $indirizzoScuola = mysqli_real_escape_string($connessione, sanitizeString($_POST["ind"])) && $_POST["ind"] != ""
                        && $_POST["scuole"] == "---") {
                    $inserisciUtente = "INSERT INTO utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type');";
                    $inserisciGruppo = "INSERT INTO gruppo (NumPers_Gr) VALUES ('$number');";
                    $inserisciIstituto = "INSERT INTO istituto VALUES ('$scuola','$cittaScuola','$indirizzoScuola');";
                    $connessione->query($inserisciUtente);
                    $connessione->query($inserisciGruppo);
                    $connessione->query($inserisciIstituto);
                    $gruppo = $connessione->query("SELECT ID_Gr FROM gruppo ORDER BY ID_Gr DESC LIMIT 1;");
                    $idGruppo = mysqli_fetch_assoc($gruppo)["ID_Gr"];
                    $connessione->query("INSERT INTO classe VALUES('$idGruppo','$classe','$scuola','$cittaScuola');");
                    $sql = "INSERT INTO utenteaccompagnatore VALUES ('$username','$idGruppo');";
                } elseif ($_POST['class'] != '' && $_POST["scuole"] != "---") {
                    $scuola = mysqli_real_escape_string($connessione, sanitizeString($_POST["scuole"]));
                    $inserisciUtente = "INSERT INTO utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type');";
                    $inserisciGruppo = "INSERT INTO gruppo (NumPers_Gr) VALUES ('$number');";
                    $connessione->query($inserisciUtente);
                    $connessione->query($inserisciGruppo);
                    $cittaScuola = $connessione->query("SELECT Citta_Ist FROM istituto WHERE Nome_Ist='$scuola';");
                    $gruppo = $connessione->query("SELECT ID_Gr FROM gruppo ORDER BY ID_Gr DESC LIMIT 1;");
                    $idGruppo = mysqli_fetch_assoc($gruppo)["ID_Gr"];
                    $cittaScuola = strtoupper(mysqli_fetch_array($cittaScuola)["Citta_Ist"]);
                    $connessione->query("INSERT INTO classe VALUES('$idGruppo','$classe','$scuola','$cittaScuola');");
                    $sql = "INSERT INTO utenteaccompagnatore VALUES ('$username','$idGruppo');";
                }
                if ($sql != "") {
                    if ($result = $connessione->query($sql)) {
                        header("Location: correctsignin.php");
                    } else {
                        echo "Errore della query: " . $connessione->error;
                        exit();
                    }
                }
            } elseif ($rowNome > 0) {
                $error_n = "Nome utente gi&agrave; in uso";
            }
        }
    }
