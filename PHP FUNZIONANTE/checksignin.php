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
	
	$username=' ';
	$password='';
	$name='';
	$surname='';
	$birth='';
	$email='';
	$type='';
	$scuole=$connessione->query("SELECT Nome_Ist,Citta_Ist from istituto");
	if(isset($_POST["sign"])){
		if($_POST["user"]==''){
			$error_r_u="Inserisci un nome utente";
		}else if($_POST["password"]==''){
			$error_r_p="Inserisci una password valida";
			}else if($_POST["name"]==''){
				$error_r_n="Inserisci il tuo nome";
				}else if($_POST["surname"]==''){
					$error_r_s="Inserisci il tuo cognome";
					}else if($_POST["date"]==''){
						$error_r_d="Inserisci la tua data di nascita";
						}else if($_POST["email"]==''){
							$error_r_e="Inserisci il tuo indirizzo mail";
							}else if(!isset($_POST["type"])){
								$error_r_t="Scegli una delle alternative";
							}else{
								$username=mysqli_real_escape_string($connessione,$_POST["user"]);
								$password=mysqli_real_escape_string($connessione,$_POST["password"]);
								if(strlen($password)>20){
									$pError="La password deve contenere al massimo 20 caratteri";
								}else{
									$name=mysqli_real_escape_string($connessione,$_POST["name"]);
									$surname=mysqli_real_escape_string($connessione,$_POST["surname"]);
									$birth=mysqli_real_escape_string($connessione,$_POST["date"]);
									$email=mysqli_real_escape_string($connessione,$_POST["email"]);
									$type=mysqli_real_escape_string($connessione,$_POST["type"]);
									$search=$connessione->query("SELECT * FROM Utente WHERE Username_Ut='$username'");
									$search2=$connessione->query("SELECT * FROM Utente WHERE Email_Ut='$email'");
									$row1=mysqli_num_rows($search);
									$row2=mysqli_num_rows($search2);
									if($row1==0 && $row2==0){
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
										if($row1>0)
											$error_n="Nome utente gi&agrave; in uso";
										else
											$error_e="Email gi&agrave; in uso";
									}
								}
		}
	}
?>