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
	
	if(isset($_POST["log"])){
		if($_POST["user"]==''){
			$error_u="Inserisci il nome utente";
		}else if($_POST["password"]==''){
			$error_p="Inserisci la password";
		}else{
			$username=mysqli_real_escape_string($connessione,$_POST["user"]);
			$password=mysqli_real_escape_string($connessione,$_POST["password"]);
			$sql="SELECT * FROM $tab_name WHERE Username_Ut='$username' and Password_Ut='$password'";
			$result=$connessione->query($sql);
			if(!$result){
				echo "Errore della query: ".$connessione->error;
				exit();
			}
			$conta=mysqli_num_rows($result);
			if($conta==1){
				session_start();
				$_SESSION['user']=$username;
				$_SESSION['password']=$password;
				header("Location: index.php");		
			}else{
				$error_m="LOGIN FALLITO! Per favore riprova con altre credenziali oppure REGISTRATI";
			}//else
		}
	}
?>
