<?php
	require_once "includes/dbhandler.php";
	$connessione = connessione();
	$tab_name="utente";
	
	$username='';
	$password='';
	$name='';
	$surname='';
	$birth='';
	$email='';
	$type='';
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
						}else if(empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
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