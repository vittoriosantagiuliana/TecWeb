<?php
	require_once "includes/dbhandler.php";
	$connessione = connessione();

function listaAttivita() {
	global $connessione;

	$listaAtt=$connessione->query("SELECT Nome_Att, Descrizione_Att, Immagine_Att FROM attivita;");
	
	$attivita = "";
	while($singolaAtt = $listaAtt->fetch_assoc()) {
		$attivita .= 
		"<div class=\"activitySection\">
			<img src=\"data:image/jpeg;base64,%ImgB64%\" alt=\"%NomeAtt%\"/>
			<strong>%NomeAtt%</strong>
			&nbsp;&#45;&nbsp;
			<p>%DescrizioneAtt%</p>
		</div>";

		$attivita = str_replace("%NomeAtt%", $singolaAtt["Nome_Att"], $attivita);
		$attivita = str_replace("%ImgB64%", base64_encode($singolaAtt["Immagine_Att"]), $attivita);
		$attivita = str_replace("%DescrizioneAtt%", $singolaAtt["Descrizione_Att"], $attivita);
	}

	return $attivita;
}

function formAttivita() {
	global $connessione;
	$form = "";

	if (isset($_SESSION["userName"]) && $_SESSION["UtenteAccompagnatore"]) {
		$connessione->query("DROP VIEW IF EXISTS gruppoProva;
			CREATE VIEW gruppoProva AS SELECT UsernameUt_UA, ID_Gr, NumPers_Gr FROM gruppo, utenteaccompagnatore WHERE UsernameUt_UA='$username' AND IDGr_UA=ID_Gr;");
		$gruppo = $connessione->query("SELECT GP.UsernameUT_UA AS UsernameUT_UA, GP.ID_Gr AS ID_Gr,GP.NumPers_Gr AS NumPers_Gr,C.Nome_C AS Nome_C,C.NomeIst_C AS NomeIst_C FROM gruppoProva as GP LEFT JOIN classe as C on GP.ID_Gr=C.IDGr_C ORDER BY GP.ID_Gr");

		$form = "<form method=\"post\" action=\"activities.php\" id=\"registraAtt\">
					<fieldset>
						<legend>Iscrivi uno dei tuoi gruppi alle attivit&agrave;</legend>
						<label>Scegli una delle attivit&agrave;</label>
						<select name=\"att\">%SelectAttivita%</select>
						<br/>
						<label>Scegli il gruppo da iscrivere</label>
						<select name=\"group\">%SelectGruppo</select>
						<br/>
						<label>Scegli una data per l'attivit&agrave;</label>
						<input type=\"date\" name=\"data\"/>
						%ErroreData%
						<br/>
						<input type=\"submit\" name=\"add\" value=\"Iscrivi il gruppo\"/>
					</fieldset>
				</form>";

		$selectAttivita = "";
		while($attiv = mysqli_fetch_array($attivita))
			$selectAttivita .= "<option value=\"" . $attiv["ID_Att"] . "\">" . $attiv["Nome_Att"] . "</option>";
		
		$selectGruppo = "";
		while($gr = mysqli_fetch_array($gruppo)) {
			$selectGruppo .= "<option value=\"" . $gr["ID_Gr"] . "\">";
			if ($gr['Nome_C'] == NULL)
				$selectGruppo .= "Gruppo di " . $gr["NumPers_Gr"] . " persone";
			else
				$selectGruppo .= "Classe " . $gr["Nome_C"] . " dell'istituto " . $gr["NomeIst_C"] . " (" . $gr["NumPers_Gr"] . " persone)";
			$selectGruppo .= "</option>";
		}

		$erroreData = isset($errorD) ? "<div class=\"error\">" . $errorD . "</div>" : "";
		
		$form = str_replace("%SelectAttivita%", $selectAttivita, $form);
		$form = str_replace("%SelectGruppo%", $selectGruppo, $form);
		$form = str_replace("%ErroreData%", $erroreData, $form);
	}

	if (isset($_SESSION["userName"]) && $_SESSION["userType"] == "admin") {
		$form = "<form method=\"post\" action=\"activities.php\" id=\"addActivity\" enctype=\"multipart/form-data\">
				<legend>Aggiungi una nuova attivit&agrave;</legend>
				<label for=\"nomeAtt\">Nome attivit&agrave;: </label>
				<input type=\"text\" name=\"nomeAtt\"/>
				<label for=\"descAtt\">Descrizione attivit&agrave;: </label>
				<textarea name=\"descAtt\" cols=\"30\" rows=\"5\"></textarea>
				<label for=\"imgAtt\">Inserisci un'immagine per l'attivit&agrave;: </label>
				<input type=\"file\" name=\"imgAtt\" id=\"imgAtt\" accept=\"image/png, image/jpeg\"/>
				<input type=\"submit\" name=\"addAtt\" value=\"Aggiungi attivit&agrave;\"/>
			</form>";
	}
	return $form;
}

	require_once "includes/header.php";
	require_once "includes/footer.php";
	require_once "includes/checkatt.php";

	$output = file_get_contents("html/activities.html");
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);

	$prenotazioneEffettuata = isset($done) ? "<div class=\"done\"><h2>" . $done . "</h2></div>" : "";
	$output = str_replace("<h2 prenotazione/>", $prenotazioneEffettuata, $output);
	$output = str_replace("<div class=\"activitySection\"/>", listaAttivita(), $output);


	echo $output;
?>
