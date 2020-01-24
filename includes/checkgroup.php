<?php
	session_start();
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
	if(isset($_SESSION['userName'])){
		$username=$_SESSION['userName'];
	}
	$scuole=$connessione->query("SELECT Nome_Ist,Citta_Ist from istituto ORDER BY Citta_Ist");
	$sql='';
	if(isset($_POST["add"])){
		if($_POST["num"]==''){
			$error_g_n="Inserisci il numero di componenti";
		}else if(!isset($_POST["choice"])){
			$error_g_c="Scegli una delle alternative";
		}else{
			$number=mysqli_real_escape_string($connessione,$_POST["num"]);
			$typeG=mysqli_real_escape_string($connessione,$_POST["choice"]);
			if($typeG=="no"){
				$sql2="INSERT INTO Gruppo (NumPers_Gr) VALUES ($number);";
				$connessione->query($sql1);
				$connessione->query($sql2);
				$result1=$connessione->query("SELECT ID_Gr FROM Gruppo ORDER BY ID_Gr DESC LIMIT 1;");
				$id=mysqli_fetch_array($result1);
				$idG=$id['ID_Gr'];
				$sql="INSERT INTO UtenteAccompagnatore VALUES ('$username','$idG');";
			}else{
				if($_POST["class"]==''){
					$error_g_cl="Inserisci il nome della classe";
				}else if(($_POST["scuole"]=='---') && ($_POST["newS"]=='')){
					$error_g_s="Scegli un istituto dalla lista o aggiungine uno nuovo";
				}else if(($_POST["scuole"]=='---') && ($_POST["citta"]=='---')){
					$error_g_s="Scegli un istituto dalla lista o aggiungine uno nuovo";
				}else if(($_POST["scuole"]=='---') && ($_POST["ind"]=='')){
					$error_g_s="Scegli un istituto dalla lista o aggiungine uno nuovo";
				}else if(($_POST["newS"]!='' && $_POST["class"]!='' && $_POST["citta"]!='---' && $_POST["ind"]!='' && $_POST["scuole"]=='---')){
					$nomeC=mysqli_real_escape_string($connessione,$_POST["class"]);
					$nomeS=mysqli_real_escape_string($connessione,$_POST["newS"]);
					$cittaS=strtoupper(mysqli_real_escape_string($connessione,$_POST["citta"]));
					$indS=mysqli_real_escape_string($connessione,$_POST["ind"]);
					$sql2="INSERT INTO Istituto VALUES ('$nomeS','$cittaS','$indS');";
					$sql3="INSERT INTO Gruppo (NumPers_Gr) VALUES ('$number');";
					$connessione->query($sql2);
					$connessione->query($sql3);
					$result1=$connessione->query("SELECT ID_Gr FROM Gruppo ORDER BY ID_Gr DESC LIMIT 1;");
					$id=mysqli_fetch_array($result1);
					$idG=$id['ID_Gr'];
					$connessione->query("INSERT INTO Classe VALUES('$idG','$nomeC','$nomeS','$cittaS');");
					$sql="INSERT INTO UtenteAccompagnatore VALUES ('$username','$idG');";
				}else if($_POST["class"]!='' && $_POST["scuole"]!='---'){
					$nomeC=mysqli_real_escape_string($connessione,$_POST["class"]);
					$nomeI=mysqli_real_escape_string($connessione,$_POST["scuole"]);
					$sql1="INSERT INTO Utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type');";
					$sql2="INSERT INTO Gruppo (NumPers_Gr) VALUES ('$number');";
					$connessione->query($sql1);
					$connessione->query($sql2);
					$result1=$connessione->query("SELECT Citta_Ist FROM Istituto WHERE Nome_Ist='$nomeI';");
					$result2=$connessione->query("SELECT ID_Gr FROM Gruppo ORDER BY ID_Gr DESC LIMIT 1;");
					$id=mysqli_fetch_array($result1);
					$id2=mysqli_fetch_array($result2);
					$cittaI=strtoupper($id['Citta_Ist']);
					$idG=$id2['ID_Gr'];
					$connessione->query("INSERT INTO Classe VALUES('$idG','$nomeC','$nomeI','$cittaI');");
					$sql="INSERT INTO UtenteAccompagnatore VALUES ('$username','$idG');";
				}
			}
		}
		if($sql!=''){
			$result=$connessione->query($sql);
			if(!$result){
				echo "Errore della query: ".$connessione->error;
				exit();
			}else{
				$done='Gruppo registrato!';
			}
		}
	}
?>