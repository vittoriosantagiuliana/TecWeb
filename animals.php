<?php
	/*require_once "includes/header.php";
	require_once "includes/footer.php";

	$output = file_get_contents("html/animals.html");
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);

	echo $output;*/
?>
<?php include('includes/addAnimal.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Zoo - Animali</title>
	<meta name="title" content="Zoo"/>
	<meta name="description" content="Home page dello zoo"/>
	<meta name="keywords" content="zoo, tecnologie web, progetto, animali"/>
	<meta name="language" content="italian it"/>
	<meta name="viewport" content="width=device-width">
	<meta name="author" content="Alessio Barbiero, Matteo Lattanzio, Vittorio Santagiuliana, Federico Caretta"/>
	<link href="https://fonts.googleapis.com/css?family=Fredoka One" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/css?family=Luckiest+Guy" rel="stylesheet"/>
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" media="print" href="css/print.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
	<script type="text/javascript" src="script/script.js"></script>
</head>
	<body>
		<div id="header"></div>
		<div id="breadcrumb">
			<p><a href="index.php">Home</a> &#124; Attivit&agrave;</p>
		</div>
		<div id="content">
			<h2>I nostri animali</h2>
			<div id="animalsContainer">
			<?php while($animale=mysqli_fetch_array($animali)){?>
					<div class="animalsImg">
						<p><?php echo $animale['Comune_An']; ?></p>
						<a href="./animals/<?php echo $animale["Comune_An"];?>.php"><img class="transiction" src="data:image/jpeg;base64,<?php echo base64_encode( $animale['Immagine_An'] ); ?>" alt="<?php echo $animale["Comune_An"];?>"/></a>
					</div>
			<?php } ?>
			</div>
			<?php if(isset($_SESSION["userName"]) && $_SESSION["userName"]=="admin"):?>
				<form method="post" action="animals.php" id="addAnimal" enctype="multipart/form-data">
					<fieldset>
						<legend>Aggiungi un nuovo animale</legend>
						<label for="nomeA">Nome Comune: </label>
						<input type="text" name="nomeA"/>
						<label for="scieA">Nome Scientifico: </label>
						<input type="text" name="scieA"/>
						<label for="ordA">Ordine: </label>
						<input type="text" name="ordA"/>
						<label for="famA">Famiglia: </label>
						<input type="text" name="famA"/>
						<label for="habA">Habitat: </label>
						<textarea name="habA" cols="30" rows="2"></textarea>
						<label for="ripA">Riproduzione: </label>
						<textarea name="ripA" cols="30" rows="2"></textarea>
						<label for="curioA">Curiosit&agrave;: </label>
						<textarea name="curioA" cols="30" rows="2"></textarea>
						<label for="imgA">Inserisci un'immagine per l'animale: </label>
						<input type="file" name="imgA" id="imgA" accept="image/png, image/jpeg"/>
						<input type="submit" name="addAnimal" value="Aggiungi animale"/>
					</fieldset>
				</form>
			<?php endif ?>
		</div>
		<div id="footer"></div>
	</body>
</html>

