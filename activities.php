<?php
	require_once "includes/header.php";
	require_once "includes/footer.php";
	require_once "includes/checkatt.php";
	require_once "includes/dbhandler.php";
	$connessione = connessione();
	if (!isset($_SESSION)) {
		session_start();
	}

function listaAttivita() {
	global $connessione;

	$listaAtt=$connessione->query("SELECT Nome_Att, Descrizione_Att, Immagine_Att FROM attivita;");

	$attivita = "";
	while ($singolaAtt = $listaAtt->fetch_assoc()) {
		$attivita .=
		"<div class=\"activitySection\">
			<img src=\"data:image/jpeg;base64,%ImgB64%\" alt=\"%NomeAtt%\"/>
			<strong>%NomeAtt%</strong>
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
		$form = "<form method=\"post\" action=\"activities.php\" id=\"registraAtt\">
					<fieldset>
						<legend>Iscrivi uno dei tuoi gruppi alle attivit&agrave;</legend>
						<div>
							<label>Scegli una delle attivit&agrave;</label>
							<select name=\"att\">%SelectAttivita%</select>
						</div>
						<div>
							<label>Scegli il gruppo da iscrivere</label>
							<select name=\"group\">%SelectGruppo%</select>
						</div>
						%ErroreData%
						<div>
							<label>Scegli una data per l'attivit&agrave;</label>
							<input type=\"date\" name=\"data\"/>
						</div>
						<input type=\"submit\" name=\"add\" value=\"Iscrivi il gruppo\"/>
					</fieldset>
				</form>";

		$username = $_SESSION["userName"];
		
		$gruppi = $connessione->query("SELECT ID_Gr AS ID, NumPers_Gr AS NumeroPersone, Nome_C AS Classe, NomeIst_C AS Istituto FROM utenteaccompagnatore INNER JOIN gruppo ON IDGr_UA = ID_Gr LEFT OUTER JOIN classe ON ID_Gr = IDGr_C WHERE UsernameUt_UA = '$username';");

		$listaAttivita=$connessione->query("SELECT ID_Att, Nome_Att FROM attivita;");

		$selectAttivita = "";
		while ($attivita = $listaAttivita->fetch_assoc()) {
			$selectAttivita .= "<option value=\"" . $attivita["ID_Att"] . "\">" . $attivita["Nome_Att"] . "</option>";
		}

		$selectGruppo = "";
		while ($gruppo = $gruppi->fetch_assoc()) {
			$selectGruppo .= "<option value=\"" . $gruppo["ID"] . "\">";
			if ($gruppo["Classe"] == null) {
				$selectGruppo .= "Gruppo di " . $gruppo["NumeroPersone"] . " persone";
			} else {
				$selectGruppo .= "Classe " . $gruppo["Classe"] . " dell'istituto " . $gruppo["Istituto"] . " (" . $gruppo["NumeroPersone"] . " persone)";
			}
			$selectGruppo .= "</option>";
		}

		$erroreData = isset($errorD) ? "<div class=\"error\">" . $errorD . "</div>" : "";

		$form = str_replace("%SelectAttivita%", $selectAttivita, $form);
		$form = str_replace("%SelectGruppo%", $selectGruppo, $form);
		$form = str_replace("%ErroreData%", $erroreData, $form);
	}

	if (isset($_SESSION["userName"]) && $_SESSION["userType"] == "admin") {
		$form = "<form method=\"post\" action=\"activities.php\" id=\"addActivity\" enctype=\"multipart/form-data\">
				<fieldset>
					<legend>Aggiungi una nuova attivit&agrave;</legend>
					<div>
						<label for=\"nomeAtt\">Nome attivit&agrave;: </label>
						<input type=\"text\" name=\"nomeAtt\" id=\"nomeAtt\"/>
					</div>
					<div>
						<label for=\"descAtt\">Descrizione attivit&agrave;: </label>
						<textarea id=\"descAtt\" name=\"descAtt\" cols=\"30\" rows=\"5\"></textarea>
					</div>
					<div>
						<label for=\"imgAtt\">Inserisci un'immagine per l'attivit&agrave;: </label>
						<input type=\"file\" name=\"imgAtt\" id=\"imgAtt\" accept=\"image/png, image/jpeg\"/>
					</div>
					<input type=\"submit\" name=\"addAtt\" value=\"Aggiungi attivit&agrave;\"/>
				</fieldset>
			</form>";
	}
	return $form;
}

	$output = file_get_contents("html/activities.html");
	$output = str_replace("<meta/>", file_get_contents("html/head.html"), $output);
	$output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);

	$prenotazioneEffettuata = isset($done) ? "<div class=\"done\"><h2>" . $done . "</h2></div>" : "";
	$output = str_replace("<h2 prenotazione/>", $prenotazioneEffettuata, $output);
	$output = str_replace("<div activitySection/>", listaAttivita(), $output);
	$output = str_replace("<div activityForm/>", formAttivita(), $output);

	// mitigazione errori/warning html5
	$output = str_replace("xml:lang=\"en\"", "lang=\"en\"", $output);
	$output = str_replace("script type=\"text/javascript\"", "script", $output);

	echo $output;
