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
	
	$username=$_POST["user"];
	$password=$_POST["password"];
	
	$username=stripslashes($username);
	$password=stripslashes($password);
	
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
		echo "Identificazione non riuscita: nome utente o password errati<br/>";
		echo "Torna a pagine di <a href=\"login.php\">login</a>";
	}//else
?>