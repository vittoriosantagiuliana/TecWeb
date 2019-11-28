<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<title>Zoo - Contatti</title>
		<meta name="title" content="Zoo"/>
		<meta name="description" content="Contatti dello zoo"/>
		<meta name="keywords" content="zoo, tecnologie web, progetto, animali"/>
		<meta name="language" content="italian it"/>
		<meta name="author" content="Alessio Barbiero"/>
		<link href="https://fonts.googleapis.com/css?family=Fredoka One" rel="stylesheet"/>
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
		<link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
	</head>
	<body>
		<?php include("header.php"); ?>
		<div id="breadcrumb">
			<p><a href="index.html">Home</a> &#124; Contatti</p>
		</div>
		<div id="content">
			<div id="contactForm">
				<form>
					<fieldset>
						<legend>Contattaci</legend>
						Email:<br/>
						<input type="email" name="Email" placeholder="latuamail@gmail.com"/><br/>
						Nome e Cognome:<br/>
						<input type="text" name="name" placeholder="Ombretta Gaggi"/><br/>
						Il tuo messaggio:<br/>
						<input type="text" name="text" placeholder="Il tuo messaggio"/>
						<br/>
						<input type="submit" name="send" value="Invia"/>
					</fieldset>
				</form>	
			</div>
			<div id="address">
				<h2>Come raggiungerci</h2>
				<p>Via delle seghe 69<br/>Saccolongo &#40;PD&#41;<br/>35030 Italia<br/>+39 123456789<br/></p>
			</div>
			<img class="googleMaps" src="./images/gmaps.png" alt="indirizzo" />
		</div>
		<div id="footer">
			<p>Seguici sui social per tutte le novità sul parco!</p>
			<center data-parsed="">
				<a href="#" class="fa fa-facebook" title="Facebook"></a>
				<a href="#" class="fa fa-twitter" title="Twitter"></a>
				<a href="#" class="fa fa-google" title="Google+"></a>
				<a href="#" class="fa fa-linkedin" title="Linkedin"></a>
				<a href="#" class="fa fa-instagram" title="Instagram"></a>
				<a href="#" class="fa fa-pinterest" title="Pinterest"></a>
			</center>
			<p><span xml:lan="en">All rights reserved</span> - Alessio Barbiero, Federico Caretta, Matteo Lattanzio, Vittorio Santagiuliana</p>
			<p> Zoo Creola, Via delle Seghe 69 Saccolongo(PD), 049xxxxxxx</p>
		</div>
	</body>
</html>