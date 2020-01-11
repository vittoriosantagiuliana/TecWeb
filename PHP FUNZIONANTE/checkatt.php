<?php
	$host="localhost";
	$username="root";
	$password="";
	$db_name="my_creolazoo";
	$tab_name="utente";
	
	$connessione=new mysqli($host,$username,$password,$db_name);
	if($connessione->connect_errno){
		echo "Connessione fallita(".$connessione->connect_errno."):".$connessione->connect_error;
		exit();
	}
	
	$username="prova2";//$_SESSION["userName"];
	$attivita=$connessione->query("SELECT ID_Att, Nome_Att from attivita ORDER BY Nome_Att");
	$connessione->query("DROP VIEW IF EXISTS gruppoProva; CREATE VIEW gruppoProva AS SELECT UsernameUt_UA, ID_Gr, NumPers_Gr FROM gruppo, utenteaccompagnatore WHERE UsernameUt_UA='$username' AND IDGr_UA=ID_Gr;");
	$gruppo=$connessione->query("SELECT GP.UsernameUT_UA AS UsernameUT_UA, GP.ID_Gr AS ID_Gr,GP.NumPers_Gr AS NumPers_Gr,C.Nome_C AS Nome_C,C.NomeIst_C AS NomeIst_C FROM gruppoProva as GP LEFT JOIN classe as C on GP.ID_Gr=C.IDGr_C ORDER BY GP.ID_Gr");
	if(isset($_POST["add"])){
		if($_POST["data"]==''){
			$errorD="Inserisci una data per la tua prenotazione!";
		}else{
			$idA=mysqli_real_escape_string($connessione,$_POST["att"]);
			$idG=mysqli_real_escape_string($connessione,$_POST["group"]);
			$date=mysqli_real_escape_string($connessione,$_POST["data"]);
			$today=new DateTime();
			$choice=new DateTime($date);
			if($choice<=$today){
				$errorD="Inserisci una data valida per la tua prenotazione!";
			}else{
				$sql="INSERT INTO partecipazione VALUES ('$idG','$idA','$date')";
				$result=$connessione->query($sql);
				if(!$result){
					echo "Errore della query: ".$connessione->error;
					exit();
				}else
					$done="Prenotazione effettuata!"; 
			}
		}
	}
?>