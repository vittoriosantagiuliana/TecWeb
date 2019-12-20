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
		<link href="https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
		<script type="text/javascript" src="script/script.js"></script>
	</head>
	<body>
		<?php include("header.php"); ?>
		<div id="breadcrumb">
			<p><a href="index.php">Home</a> &#124; Contatti</p>
		</div>
		<div id="content">
		<div id="container">
  <h1>&bull; CONTATTACI! &bull;</h1>
  
  <div class="icon_wrapper">
        <img src="./images/logo.png" class="icon"/>
  </div>
  <form id="contact_form">
    <div class="name">
      <label name="name"></label>
      <input type="text" placeholder="Nome" name="name" id="name" required>
    </div>
    <div class="email">
      <label name="email"></label>
      <input type="email" placeholder="E-mail" name="email" id="email" required>
    </div>
    <div class="subject">
      <label name="subject"></label>
      <select placeholder="Vorrei scrivervi per..." name="subject" id="subject" required>
        <option disabled hidden selected>Vorrei scrivervi per...</option>
        <option>Informazioni sugli animali</option>
        <option>Orari apertura del parco</option>
        <option>Informazioni sulle attività del parco</option>
        <option>Organizzazione eventi</option>
        <option>Altro...</option>
      </select>
    </div>
    <div class="message">
      <label for="message"></label>
      <textarea name="message" placeholder="Il mio messaggio" id="message" cols="30" rows="5" required></textarea>
    </div>
    <div class="submit">
      <input type="submit" value="Invia" id="form_button" />
    </div>
  </form>
    </div>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>
