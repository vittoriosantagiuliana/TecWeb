<?php
	require_once "includes/header.php";
	require_once "includes/footer.php";
	require_once "includes/dbhandler.php";
	$connessione = connessione();
	if (!isset($_SESSION))
			session_start();

function listaAnimali() {
	global $connessione;
	$output = "";
	if (!$animali = $connessione->query("SELECT * FROM animale ORDER BY Comune_An;")) {
		header("Location: notfound.php");
		exit();
	}
	while ($animale = $animali->fetch_assoc()) {
		$nomeAnimale = $animale["Comune_An"];
		$output .= "<div class=\"animalsImg\">
			 <p>" . $nomeAnimale . "</p>
			 <a href=\"animaldetails.php?animal=" . urlencode($nomeAnimale) . "\">
				 <img class=\"transiction\" src=\"data:image/jpeg;base64," . base64_encode($animale["Immagine_An"]) . "\" alt=\"" . $nomeAnimale . "\"/>
			 </a>
		 </div>";
	}
	return $output;
}

if (isset($_SESSION["userName"]) && $_SESSION["userType"]=="admin")
	$adminForm = "<form method=\"post\" action=\"includes/animals.php\" id=\"addAnimal\" enctype=\"multipart/form-data\">
		<fieldset>
			<legend>Aggiungi un nuovo animale</legend>
			<div>
				<label for=\"nomeA\">Nome Comune: </label>
				<input type=\"text\" name=\"nomeA\" id=\"nomeA\"/>
			</div>
			<div>
				<label for=\"scieA\">Nome Scientifico: </label>
				<input type=\"text\" name=\"scieA\" id=\"scieA\"/>
			</div>
			<div>
				<label for=\"ordA\">Ordine: </label>
				<input type=\"text\" name=\"ordA\" id=\"ordA\"/>
			</div>
			<div>
				<label for=\"famA\">Famiglia: </label>
				<input type=\"text\" name=\"famA\" id=\"famA\"/>
			</div>
			<div>
				<label for=\"habA\">Habitat: </label>
				<textarea name=\"habA\" id=\"habA\" cols=\"30\" rows=\"2\"></textarea>
			</div>
			<div>
				<label for=\"ripA\">Riproduzione: </label>
				<textarea name=\"ripA\" id=\"ripA\" cols=\"30\" rows=\"2\"></textarea>
			</div>
			<div>
				<label for=\"curioA\">Curiosit&agrave;: </label>
				<textarea name=\"curioA\" id=\"curioA\" cols=\"30\" rows=\"2\"></textarea>
			</div>
			<div>
				<label for=\"imgA\">Inserisci un'immagine per l'animale: </label>
				<input type=\"file\" name=\"imgA\" id=\"imgA\" accept=\"image/png, image/jpeg\"/>
			</div>
			<input type=\"submit\" name=\"addAnimal\" value=\"Aggiungi animale\"/>
		</fieldset>
	</form>";
else
	$adminForm = "";

	$output = file_get_contents("html/animals.html");
	$output = str_replace("<meta/>", file_get_contents("html/head.html"), $output);
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output = str_replace("<div class=\"animalsImg\"/>", listaAnimali(), $output);
	$output = str_replace("<form admin/>", $adminForm, $output);


	echo $output;
?>
