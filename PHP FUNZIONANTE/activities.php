<?php include('checkatt.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<title>Zoo - Attività</title>
		<meta name="title" content="Zoo"/>
		<meta name="description" content="Animali dello zoo"/>
		<meta name="keywords" content="zoo, tecnologie web, progetto, animali"/>
		<meta name="language" content="italian it"/>
		<meta name="author" content="Alessio Barbiero"/>
		<link href="https://fonts.googleapis.com/css?family=Fredoka One" rel="stylesheet"/>
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
		<link href="https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
		<script type="text/javascript" src="script/script.js"></script>
	</head>
	<body>
		<div id="header"></div>
		<div id="breadcrumb">
			<p><a href="index.html">Home</a> &#124; Attivit&agrave;</p>
		</div>
		<div id="content">
			<?php if(isset($done)): ?>
				<div class="done"><h2>
				<?php echo $done; ?>
				</h2></div>
			<?php endif ?>
			<h2>Le nostre attivit&agrave;</h2>
			<div class="activitySection">
				<img src="images/activityDolphin.jpg" alt="immersione con delfini" />
				<p>
					IMMERSIONE CON I DELFINI - Nuotare con i delfini è una delle esperienze più emozionanti e divertenti che una persona possa vivere. Immergiti e impara a conoscere uno degli animali più intelligenti e giocosi presenti in natura. Seguiti dai nostri collaboratori, i visitatori (a gruppi di dieci) entreranno innanzitutto in una piscina per iniziare a interagire con i nostri delfini, in modo da comprendere rapidamente il loro comportamento. Successivamente, verrà consegnata una muta e un salvagente per iniziare questa indimenticabile immersione. <br>L'attività è aperta a tutti gli adulti e ai bambini dagli 8 anni in su. E' consigliato comunicare in anticipo la volontà di effettuare l'immersione il giorno della visita, in modo da poter garantire la disponibilità. Durata dell'attività: 45 minuti circa.
				</p>
			</div>
			<div class="activitySection">
				<img src="images/activityLion.jpg" alt="attività con leoni" />
				<p>
					INCONTRO RAVVICINATO CON I LEONI - Chi non ha mai sognato di accarezzare uno dei felini più grandi in natura? Allo Zoo Creola tutto ciò sarà possibile! Nel corso della visita allo zoo, in orari predefiniti (presenti nel volantino che verrà consegnato all'ingresso), i nostri visitatori più coraggiosi, insieme al nostro staff, potranno interagire e dare da mangiare ai nostri leoni! <br><br>L'attività è aperta a tutti gli adulti e ai bambini dai 10 anni in su accompagnati da un adulto.
				</p>
			</div>
			<div class="activitySection">
				<img src="images/activitySchool.jpg" alt="attività scuola" />
				<p>
					ATTIVITA' DIDATTICHE PER LE SCUOLE - Per tutte le scuole, saranno disponibili, alla fine della visita al parco, una serie di laboratori didattici e attività per imparare tutte le curiosità della natura e in particolare del mondo animale. I bambini potranno interagire con alcuni piccoli animali, toccare e studiare vari reperti tra cui fossili, ossa di animali e altri reperti per conoscere le degli animali dello zoo e di altri estinti da milioni di anni. <br><br>L'attività è dedicata a tutte le scuole e con un numero massimo di 25 bambini per turno. La prenotazione delle attività è obbligatoria e va comunicata al momento della prenotazione della visita allo zoo. Per le prenotazioni online, invece, è richiesta la compilazione di un form. Durata dell'attività: 1 ora circa
				</p>
			</div>
			<?php if(isset($_SESSION["userName"])&& $_SESSION["UtenteAccompagnatore"]): ?>
				<form method="post" action="activities.php" id="registraAtt">
					<fieldset>
						<legend>Iscrivi uno dei tuoi gruppi alle attivit&agrave;</legend>
						<label>Scegli una delle attivit&agrave;</label>
						<select name="att">
							<?php while($attiv = mysqli_fetch_array($attivita)){ ?>
								<option value='<?php echo $attiv['ID_Att']; ?>'><?php echo $attiv['Nome_Att']; ?></option>
							<?php }?>
						</select><br/>
						<label>Scegli il gruppo da iscrivere</label>
						<select name="group">
							<?php while($gr = mysqli_fetch_array($gruppo)){?>
								<option value='<?php echo $gr['ID_Gr']; ?>'><?php
									if($gr['Nome_C']==NULL){
										echo 'Gruppo di '.$gr['NumPers_Gr'].' persone';
									}else{
										echo 'Classe '.$gr['Nome_C'].' dell\'istituto '.$gr['NomeIst_C'].' ('.$gr['NumPers_Gr'].' persone)';
									} ?></option>
							<?php }?>
						</select><br/>
						<label>Scegli una data per l'attivit&agrave;</label>
						<input type="date" name="data"/>
						<?php if(isset($errorD)): ?>
							<div class="error"><?php echo $errorD; ?></div>
						<?php endif ?><br/><br/>
						<input type="submit" name="add" value="Iscrivi il gruppo"/>
					</fieldset>
				</form>
			<?php endif ?>
		</div>
		<div id="footer"></div>
	</body>
</html>