<?php include('includes/checkatt.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<title>Zoo - Attività</title>
		<meta name="title" content="Zoo"/>
		<meta name="description" content="Attivita' dello zoo"/>
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
			<p><a href="index.php">Home</a> &#124; Attivit&agrave;</p>
		</div>
		<div id="content">
			<?php if(isset($done)): ?>
				<div class="done"><h2>
				<?php echo $done; ?>
				</h2></div>
			<?php endif ?>
			<h2>Le nostre attivit&agrave;</h2>
			<?php while($singolaAtt = mysqli_fetch_array($listaAtt)){ ?>
				<div class="activitySection">
					<strong><?php echo $singolaAtt['Nome_Att']; ?></strong> -
					<img src="data:image/jpeg;base64,<?php echo base64_encode( $singolaAtt['Immagine_Att'] ); ?>" alt="<?php echo $singolaAtt["Nome_Att"]?>"/>
					<p>
						<?php echo $singolaAtt['Descrizione_Att'];?>
					</p>
				</div>
			<?php } ?>
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
			<?php if(isset($_SESSION) && $_SESSION["userName"]=="admin"):?>
				<form method="post" action="activities.php" id="addActivity" enctype="multipart/form-data">
					<fieldset>
						<legend>Aggiungi una nuova attivit&agrave;</legend>
						<label for="nomeAtt">Nome attivit&agrave;: </label>
						<input type="text" name="nomeAtt"/>
						<label for="descAtt">Descrizione attivit&agrave;: </label>
						<textarea name="descAtt" cols="30" rows="5"></textarea>
						<label for="imgAtt">Inserisci un'immagine per l'attivit&agrave;: </label>
						<input type="file" name="imgAtt" id="imgAtt" accept="image/png, image/jpeg"/>
						<input type="submit" name="addAtt" value="Aggiungi attivit&agrave;"/>
					</fieldset>
				</form>
			<?php endif ?>
		</div>
		<div id="footer"></div>
	</body>
</html>
