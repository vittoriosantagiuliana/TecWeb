<?php include('buyticket.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<title>Zoo - Orari e biglietti</title>
		<meta name="title" content="Zoo"/>
		<meta name="description" content="Mappa dello zoo"/>
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
			<p><a href="index.php">Home</a> &#124; Orario</p>
    </div>
		<div id="content">
			<?php if(isset($done)):?>
				<div class="done"><h2>
			<?php echo $done; ?>
				</h2></div>
			<?php endif ?>
			<p>ORARI INVERNALI<br/><br/>

			L'orario invernale è in vigore dal 15 Ottobre fino al 15 Maggio. Tra il 15 Novembre e il 15 Febbraio, il parco sarà aperto esclusivamente
			dal venerdì alla domenica (compresa).<br/><br/>

			Lunedì-Sabato: 10:00-16:00<br/>
			Domenica: 10:00-17:00<br/><br/>

			ORARI ESTIVI<br/><br/>

			L'orario estivo è in vigore dal 15 Maggio al 15 Ottobre.<br/><br/>

			Lunedì-Sabato: 9:00-20:00<br/>
			Domenica: 9:00-20.30<br/><br/>

			Il parco sarà aperto tutto l'anno, ad eccezione dei seguenti giorni:<br/>
			- 1 e 6 Gennaio (Primo dell'anno ed Epifania)<br/>
			- 12 Aprile (Pasqua)<br/>
			- 1 Maggio (Festa del lavoro)<br/>
			- 25 Dicembre (Natale)<br/><br/>

			Si avvisano inoltre i visitatori che l'ingresso all'interno del parco sarà possibile fino ad un'ora e mezza prima della chiusura.<br/>
			Si ricorda che per la visita dell'intero parco (escluse eventuali attività) sono necessarie circa due ore.<br/><br/>

			La direzione si riserva il diritto di modificare gli orari di apertura e chiusura in caso di problemi tecnici o condizioni meteo avverse. Ogni chiusura straordinaria verrà comunicata
			sul sito e sui social il prima possibile.<br/><br/>

			Per tutte le informazioni relative la vendita dei biglietti, vi rimandiamo alla pagina dedicata.</p>
			<?php if(isset($_SESSION['userName'])): ?>
			<form method="post" action="schedule.php" id="ticket">
				<fieldset>
					<legend>Acquista biglietti</legend>
					<table>
						<tr>
							<th>Prodotto</th><th>Quantit&agrave;</th><th>Prezzo unitario</th>
						</tr>
						<tr>
							<td>Biglietto intero</td><td><select name="intero"><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></td><td>12.00€</td>
						</tr>
						<tr>
							<td>Biglietto ridotto &lpar;under 10&rpar;</td><td><select name="ridottoB"><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></td><td>8.00€</td>
						</tr>
						<tr>
							<td>Biglietto ridotto &lpar;over 65&rpar;</td><td><select name="ridottoA"><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></td><td>10.00€</td>
						</tr>
					</table>
					<input type="submit" name="buy" value="Acquista"/>
				</fieldset>
			</form>
			<?php endif ?>
		</div>
		<div id="footer"></div>
	</body>
</html>