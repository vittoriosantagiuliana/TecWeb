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
	$userR=$connessione->query("SELECT Password_Ut,Nome_Ut,Cognome_Ut,Mail_Ut FROM utente WHERE Username_Ut='$username';");
	$user=mysqli_fetch_array($userR);
	$password=$user["Password_Ut"];
	$nome=$user["Nome_Ut"];
	$cognome=$user["Cognome_Ut"];
	$email=$user["Mail_Ut"];
	//if($_SESSION["UtenteAccompagnatore"]){
		$connessione->query("DROP VIEW IF EXISTS gruppoProva; CREATE VIEW gruppoProva AS SELECT UsernameUt_UA, ID_Gr, NumPers_Gr FROM gruppo, utenteaccompagnatore WHERE UsernameUt_UA='$username' AND IDGr_UA=ID_Gr;");
		$gruppi=$connessione->query("SELECT GP.UsernameUT_UA AS UsernameUT_UA, GP.ID_Gr AS ID_Gr,GP.NumPers_Gr AS NumPers_Gr,C.Nome_C AS Nome_C,C.NomeIst_C AS NomeIst_C FROM gruppoProva as GP LEFT JOIN classe as C on GP.ID_Gr=C.IDGr_C ORDER BY GP.ID_Gr");
	//}
	if(isset($_POST["mod"])){
		$newName=$_POST["name"];
		$newSurname=$_POST["surname"];
		$newPassword=$_POST["password"];
		if($newName=='')
			$newName=$nome;
		if($newSurname=='')
			$newSurname=$cognome;
		if($newPassword=='')
			$newPassword=$password;
		$sql=("UPDATE utente SET Nome_Ut='$newName',Cognome_Ut='$newSurname',Password_Ut='$newPassword' WHERE Username_Ut='$username';");
		$result=$connessione->query($sql);
		if(!$result){
			echo "Errore della query: ".$connessione->error;
			exit();
		}else{
			header("Location: profile.php");
		}
	}
?>