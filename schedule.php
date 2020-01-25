<?php
    require_once "includes/header.php";
    require_once "includes/footer.php";
    if (!isset($_SESSION))
    	session_start();

    if (isset($_SESSION["userName"])) {
    	$formAcquisto = "<form method=\"post\" action=\"schedule.php\" id=\"ticket\">
			<fieldset>
				<legend>Acquista biglietti</legend>
				<table>
					<tr>
						<th>Prodotto</th><th>Quantit&agrave;</th>
						<th>Prezzo unitario</th>
					</tr>
					<tr>
						<td>Biglietto intero</td>
						<td>
							<select name=\"intero\">
								<option value=\"0\">0</option>
								<option value=\"1\">1</option>
								<option value=\"2\">2</option>
								<option value=\"3\">3</option>
								<option value=\"4\">4</option>
								<option value=\"5\">5</option>
								<option value=\"6\">6</option>
								<option value=\"7\">7</option>
								<option value=\"8\">8</option>
								<option value=\"9\">9</option>
								<option value=\"10\">10</option>
						</td>
						<td>12.00€</td>
					</tr>
					<tr>
						<td>Biglietto ridotto &lpar;under 10&rpar;</td>
						<td>
							<select name=\"ridottoB\">
								<option value=\"0\">0</option>
								<option value=\"1\">1</option>
								<option value=\"2\">2</option>
								<option value=\"3\">3</option>
								<option value=\"4\">4</option>
								<option value=\"5\">5</option>
								<option value=\"6\">6</option>
								<option value=\"7\">7</option>
								<option value=\"8\">8</option>
								<option value=\"9\">9</option>
								<option value=\"10\">10</option>
						</td>
						<td>8.00€</td>
					</tr>
					<tr>
						<td>Biglietto ridotto &lpar;over 65&rpar;</td>
						<td>
							<select name=\"ridottoA\">
							<option value=\"0\">0</option>
							<option value=\"1\">1</option>
							<option value=\"2\">2</option>
							<option value=\"3\">3</option>
							<option value=\"4\">4</option>
							<option value=\"5\">5</option>
							<option value=\"6\">6</option>
							<option value=\"7\">7</option>
							<option value=\"8\">8</option>
							<option value=\"9\">9</option>
							<option value=\"10\">10</option>
						</td>
						<td>10.00€</td>
					</tr>
				</table>
				<input type=\"submit\" name=\"buy\" value=\"Acquista\"/>
			</fieldset>
		</form>";
	}
	else {
    		$formAcquisto = "<p>Per l'acquisto dei biglietti effettuare il <span xml:lang=\"en\">login</span> o registrare un nuovo <span xml:lang=\"en\">account</span>";
	}

    $output = file_get_contents("html/schedule.html");
    $output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
    $output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
    $acquistoEffettuato = isset($done) ? "<div class=\"done\"><h2>" . $done . "</h2></div>" : "";
    $output = str_replace("<h2 acquisto/>", $acquistoEffettuato, $output);
    $output = str_replace("<form acquisto/>", $formAcquisto, $output);


    echo $output;
