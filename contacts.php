<?php
	include('includes/sendMessage.php');
	
	
	require_once "includes/header.php";
	require_once "includes/footer.php";
/*
	$output = file_get_contents("html/contacts.html");
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);

	echo $output;
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<title>Zoo - Contatti</title>
		<meta name="title" content="Zoo"/>
		<meta name="description" content="Contatti dello zoo"/>
		<meta name="keywords" content="zoo, tecnologie web, progetto, animali"/>
		<meta name="language" content="italian it"/>
		<meta name="viewport" content="width=device-width">
		<meta name="author" content="Alessio Barbiero"/>
		<link href="https://fonts.googleapis.com/css?family=Fredoka One" rel="stylesheet"/>
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
		<link href="https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="css/style.css"/>
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" media="print" href="css/print.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
		<script type="text/javascript" src="script/script.js"></script>
	</head>
	<body>
		<div id="header"></div>
		<div id="breadcrumb">
			<p><a href="index.php">Home</a> &#124; Contatti</p>
		</div>
		<div id="content">
				<?php if(isset($ok)): ?>
					<h1><?php echo $ok; ?></h1>
				<?php endif ?>
			<div id="contactText">
				<p>Per qualsiasi domanda relativa il parco, le sue strutture o i suoi servizi, non esitare a contattarci!
					Compila il modulo qui sotto e il nostro staff ti risponderà entro 24 ore!</p><br></br>
					<p><strong>Telefono:</strong> 049 xxxxxxx<br></br><strong>Email:</strong> zoo@zoocreola.it</p>
			</div>
			<div id="container">
				<h2>&bull; CONTATTACI! &bull;</h2>
				<div class="icon_wrapper">
					<img src="./images/logo.png" class="icon"/>
				</div>
				<form id="contact_form" method="post" action="contacts.php">
					<div class="name">
						<label name="name"></label>
						<input type="text" placeholder="Nome" name="name" id="name" required <?php if(isset($_SESSION['userName'])): ?> value="<?php echo $name; ?>" <?php endif ?>>
					</div>
					<div class="email">
						<label name="email"></label>
						<input type="email" placeholder="E-mail" name="email" id="email" required <?php if(isset($_SESSION['userName'])): ?> value="<?php echo $email; ?>" <?php endif ?>>
					</div>
					<div class="subject">
						<label name="subject"></label>
						<select placeholder="Vorrei scrivervi per..." name="subject" id="subject" required>
							<option disabled hidden selected>Vorrei scrivervi per...</option>
							<option value="INFORMAZIONI ANIMALI">Informazioni sugli animali</option>
							<option value="ORARI APERTURA">Orari apertura del parco</option>
							<option value="INFORMAZIONI ATTIVITA">Informazioni sulle attività del parco</option>
							<option value="EVENTI">Organizzazione eventi</option>
							<option value="ALTRO">Altro...</option>
						</select>
					</div>
					<div class="message">
						<label for="message"></label>
						<textarea name="message" placeholder="Il mio messaggio" id="message" cols="30" rows="5" required></textarea>
					</div>
					<div class="submit">
					<input type="submit" value="Invia" name="form_button" />
					</div>
				</form>
			</div>
			<div id="googleMaps">
				<h1>Come raggiungerci</h1>
				<div class="map-responsive"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2801.030142285919!2d11.744632215765485!3d45.40873174516357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x477ed8813499be6d%3A0x4ca23e9253266609!2sMontagnola%20Di%20Caretta!5e0!3m2!1sen!2sit!4v1579336355890!5m2!1sen!2sit" width="800" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>
					<p>Zoo Creola <br>Via Montagnola di Caretta 1<br>Saccolongo(PD)<br>049xxxxxxx</p>
					<p>Per raggiungere il parco, all'incrocio a Mestrino tra la statale e via Angelo Candeo, girare a destra e poi subito a sinistra in via Martignon. Seguire la strada fino alla Chiesa di Creola, dove poi saranno presenti tutte le indicazioni per raggiungere la Montagnola di Caretta</p>
			</div>
		</div>
		<div id="footer"></div>
	</body>
</html>
