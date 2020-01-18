<?php
	require_once "includes/dbhandler.php";
	$connessione = connessione();
	
	$username='';
	$password='';
	$name='';
	$surname='';
	$birth='';
	$email='';
	$type='';
	$scuole=$connessione->query("SELECT Nome_Ist,Citta_Ist from istituto ORDER BY Citta_Ist");
	$sql='';
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
									$search2=$connessione->query("SELECT * FROM Utente WHERE Mail_Ut='$email'");
									if($search) $row1=mysqli_num_rows($search); else $row=0;
									if($search2) $row2=mysqli_num_rows($search2); else $row2=0;
									if($row1==0 && $row2==0){
										if($type=="Utente")
											$sql=("INSERT INTO Utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type')");
										else{
											if($_POST["num"]==''){
												$error_g_n="Inserisci il numero di componenti";
											}else if(!isset($_POST["choice"])){
												$error_g_c="Scegli una delle alternative";
											}else{
												$number=mysqli_real_escape_string($connessione,$_POST["num"]);
												$typeG=mysqli_real_escape_string($connessione,$_POST["choice"]);
												if($typeG=="no"){
													$sql1="INSERT INTO Utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type');";
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
														$sql1="INSERT INTO Utente VALUES ('$username','$password','$name','$surname','$email','$birth','$type');";
														$sql2="INSERT INTO Istituto VALUES ('$nomeS','$cittaS','$indS');";
														$sql3="INSERT INTO Gruppo (NumPers_Gr) VALUES ('$number');";
														$connessione->query($sql1);
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
										}//if_else
									if($sql!=''){
										$result=$connessione->query($sql);
										if(!$result){
											echo "Errore della query: ".$connessione->error;
											exit();
										}else{
											header("Location: correctSignin.php");
									}}
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