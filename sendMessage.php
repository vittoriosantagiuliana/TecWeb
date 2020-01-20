<?php
	session_start();
	include('includes/dbhandler.php');
	$connessione=connessione();
	
	if(isset($_SESSION['userName'])){
		$un=$_SESSION['userName'];
		$user=$connessione->query("SELECT Nome_Ut,Mail_Ut FROM utente WHERE Username_Ut='$un';");
		$user=mysqli_fetch_array($user);
		$name=$user['Nome_Ut'];
		$email=$user['Mail_Ut'];
	}
	if(isset($_POST['form_button'])){
		if(!isset($_SESSION['userName'])){
			$name=mysqli_real_escape_string($connessione,$_POST['name']);
			$email=mysqli_real_escape_string($connessione,$_POST['email']);
		}
		$message=mysqli_real_escape_string($connessione,$_POST['message']);
		$cat=mysqli_real_escape_string($connessione,$_POST['subject']);
		$today=new DateTime();
		$sql=("INSERT INTO messaggio(Categoria_Mes,Nome_Mes,Mail_Mes,Testo_Mes) VALUES ('$cat','$name','$email','$message','$today');");
		$result=$connessione->query($sql);
		if(!$result){
				echo "Errore della query: ".$connessione->error;
				exit();
		}else
			$done="Grazie del tuo messaggio! Verrai ricontattato al pi&ugrave; presto!";
	}
?>