<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    $tab_name = "utente";
    
    $connessione = new mysqli($host, $username, $password, $db_name);
    if ($connessione->connect_errno) {
        echo "Connessione fallita(".$connessione->connect_errno."):".$connessione->connect_error;
        exit();
    }
    
    if (isset($_SESSION["userName"])) {
        $username = $_SESSION["userName"];
    }
    $totI = 0;
    $totRA = 0;
    $totRB = 0;
    if (isset($_POST["buy"])) {
        $totI = mysqli_real_escape_string($connessione, $_POST["intero"]);
        $totRA = mysqli_real_escape_string($connessione, $_POST["ridottoA"]);
        $totRB = mysqli_real_escape_string($connessione, $_POST["ridottoB"]);
        $tot = $totI*12 + $totRB*8 + $totRA*10;
        if (($totI + $totRA + $totRB)>0) {
            $sql = "INSERT INTO Ticket(UsernameUt_T,NumInteri_T,NumRidottiB_T,NumRidottiA_T,CostoTot_T) VALUES('$username',$totI,$totRB,$totRA,$tot)";
            $result = $connessione->query($sql);
            if (!$result) {
                echo "Errore della query: " . $connessione->error;
                exit();
            } else {
                $done = "Grazie dell'acquisto!";
            }
        }
    }
