<?php
	session_start();
	require_once "includes/dbhandler.php";
	$connessione = connessione();
	$animali=$connessione->query("SELECT * FROM animale ORDER BY Comune_An;");
	
	if(isset($_POST["addAnimal"])){
		$nome=mysqli_real_escape_string($connessione,$_POST['nomeA']);
		$scie=mysqli_real_escape_string($connessione,$_POST['scieA']);
		$ordine=mysqli_real_escape_string($connessione,$_POST['ordA']);
		$famiglia=mysqli_real_escape_string($connessione,$_POST['famA']);
		$habitat=mysqli_real_escape_string($connessione,$_POST['habA']);
		$riproduzione=mysqli_real_escape_string($connessione,$_POST['ripA']);
		$curiosita=mysqli_real_escape_string($connessione,$_POST['curioA']);
		$currfile = $_FILES['imgA']['tmp_name'];
		$filename = $_FILES['imgA']['name'];
		$data=fopen($currfile,'rb');
		$size=filesize($currfile);
		$contents=fread($data,$size);
		fclose($data);  
		$bin_data = addslashes($contents);
		$result=$connessione->query("INSERT INTO animale(Comune_An,Scientifico_An,Ordine_An,Famiglia_An,Habitat_An,Riproduzione_An,Curiosita_An,Immagine_An) VALUES ('$nome','$scie','$ordine','$famiglia','$habitat','$riproduzione','$curiosita','$bin_data');");
		if($result){
			header("Location: animals.php");
		}else{
			echo "Errore della query: ".$connessione->error;
			exit();
		}
	}
?>