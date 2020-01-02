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
	
	$username=stripslashes($_POST["user"]);
	$password=stripslashes($_POST["password"]);
	$name=stripslashes($_POST["name"]);
	$surname=stripslashes($_POST["surname"]);
	$birth=stripslashes($_POST["date"]);
	$email=stripslashes($_POST["email"]);
	$type=stripslashes($_POST["type"]);
	$search=$connessione->query("SELECT * FROM Utente WHERE Username_Ut='$username' OR Email_Ut='$email'");
	if(!$search){
		if($type=="Utente")
			$sql=("INSERT INTO Utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type')");
		else
			$sql=("INSERT INTO Utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type'); INSERT INTO UtenteAccompagnatore VALUES ('$username', NULL);");
		$result=$connessione->query($sql);
		if(!$result){
			echo "Errore della query: ".$connessione->error;
			exit();
		}else{
			header("Location: correctSignin.php");
		}
	}else{
		echo "Nome utente o email gi&agrave; in uso!";
		exit();
	}
?>
