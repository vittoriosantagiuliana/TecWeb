<?php include('includes/setprofile.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<title>Zoo - Profilo</title>
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
			<p><a href="index.html">Home</a> &#124; Profilo</p>
		</div>
		<div id="content">
		<?php if(isset($_SESSION["userName"]) && $_SESSION["userName"]!="admin"): ?>
			<h1>I tuoi dati</h1>
			<h2>Benvenuto, <?php echo $username; ?> </h2>
			<form method="post" action="profile.php" id="profile">
				<label>Username:</label>
					<input type="text" name="user" readonly="readonly" placeholder="<?php echo $username; ?>"/><br/>
				<label>Password:</label>
					<input type="password" name="password" placeholder="<?php echo $password; ?>"/><br/>
				<label>Nome:</label>
					<input type="text" name="name" placeholder="<?php echo $nome; ?>"/><br/>
				<label>Cognome:</label>
					<input type="text" name="surname" placeholder="<?php echo $cognome; ?>"/><br/>
				<label>Email:</label>
					<input type="text" name="email" readonly="readonly" placeholder="<?php echo $email; ?>"/><br/>
				<input type="submit" name="mod" value="Modifica i dati"/>
			</form>
			<?php if($_SESSION["UtenteAccompagnatore"]): ?>
				<h3>I tuoi gruppi</h3><br/>
				<?php while ($gr=mysqli_fetch_array($gruppi)){ ?>
					<p>
					<?php if($gr['Nome_C']==NULL){ ?>
						<strong>Tipologia gruppo: </strong>gruppo generico<br/>
						<strong>Numero di persone: </strong><?php echo $gr['NumPers_Gr']; ?><br/>
					<?php }else{ ?>
						<strong>Tipologia gruppo: </strong>classe scolastica<br/>
						<strong>Numero di persone: </strong><?php echo $gr['NumPers_Gr']; ?><br/>
						<strong>Nome classe: </strong><?php echo $gr['Nome_C']; ?><br/>
						<strong>Nome istituto: </strong><?php echo $gr['NomeIst_C']; ?><br/>
					<?php } ?>
					<?php
						$el=$gr['ID_Gr'];
						$attivita=$connessione->query("SELECT A.Nome_Att AS Nome_Att,P.Data_P AS Data_P FROM partecipazione AS P JOIN attivita as A on P.IDAtt_P=A.ID_Att WHERE P.IDGr_P='$el';");
						while($att=mysqli_fetch_array($attivita)){?>
							<strong>Attivit&agrave; svolta o prenotata: </strong> <?php echo $att['Nome_Att']; ?> in data <?php echo $att['Data_P']; ?><br/>
						<?php } ?>
					<br/><br/></p>
				<?php } ?>
			<?php endif ?>
		<?php endif ?>
		<?php if(isset($_SESSION["userName"]) && $_SESSION["userName"]=="admin"): ?>
			<h1>Pagina amministrazione</h1>
			<h2>Totale incassi dai biglietti online: <?php echo $totale['totale']; ?> euro</h2>
			<h3>Lista attivit&agrave; prenotate: </h3><br/>
			<?php while($pren = mysqli_fetch_array($prenotazioni)){ ?>
				<p>
					<strong>Attivit&agrave;: </strong><?php echo $pren['att']; ?><br/>
					<strong>Data: </strong><?php echo $pren['data']; ?><br/>
					<strong>Numero partecipanti: </strong><?php echo $pren['persone']; ?><br/><br/><br/>
				</p>
			<?php } ?>
			<h3>Lista messaggi in arrivo: </h3><br/>
			<?php while($mess = mysqli_fetch_array($messaggi)){ ?>
				<p>
					<strong>Data e ora: </strong><?php echo $mess['Data_Mes']; ?><br/>
					<strong>Categoria: </strong><?php echo $mess['Categoria_Mes']; ?><br/>
					<strong>Nome mittente: </strong><?php echo $mess['Nome_Mes']; ?><br/>
					<strong>E-mail mittente: </strong><?php echo $mess['Mail_Mes']; ?><br/>
					<strong>Messaggio: </strong><?php echo $mess['Testo_Mes']; ?><br/><br/><br/>
				</p>
			<?php } ?>
			<!--<div id="filter">
				<form method="post" action="profile.php" id="filter">
					<label>Filtra le attivit&agrave; in base al mese e all'anno</label>
					<select name="month">
						<option value="1">Gennaio</option>
						<option value="2">Febbraio</option>
						<option value="3">Marzo</option>
						<option value="4">Aprile</option>
						<option value="5">Maggio</option>
						<option value="6">Giugno</option>
						<option value="7">Luglio</option>
						<option value="8">Agosto</option>
						<option value="9">Settembre</option>
						<option value="10">Ottobre</option>
						<option value="11">Novembre</option>
						<option value="12">Dicembre</option>
					</select>
					<select name="year">
						<option value="2020">2020</option>
						<option value="2019">2019</option>
						<option value="2018">2018</option>
						<option value="2017">2017</option>
						<option value="2016">2016</option>
						<option value="2015">2015</option>
						<option value="2014">2014</option>
					</select>
					<input type="submit" name="mth" value="Filtra"/>
					<input type="submit" name="all" value="Mostra tutti"/>
				</form>
			</div>-->
		<?php endif ?>
		</div>
		</div>
		<div id="footer"></div>
	</body>
</html>