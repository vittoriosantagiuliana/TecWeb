<?php
    require_once "includes/header.php";
    require_once "includes/footer.php";
	require_once "includes/buyticket.php";
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
						<td><input type=\"number\" name=\"intero\" min=\"0\" max=\"10\"/></td>
						<td>12.00€</td>
					</tr>
					<tr>
						<td>Biglietto ridotto (under 10)</td>
						<td><input type=\"number\" name=\"ridottoB\" min=\"0\" max=\"10\"/></td>
						<td>8.00€</td>
					</tr>
					<tr>
						<td>Biglietto ridotto (over 65)</td>
						<td><input type=\"number\" name=\"ridottoA\" min=\"0\" max=\"10\"/></td>
						<td>10.00€</td>
					</tr>
				</table>
				<input type=\"submit\" name=\"buy\" value=\"Acquista\"/>
			</fieldset>
		</form>";
	}
	else {
    		$formAcquisto = "<p>Per l'acquisto dei biglietti effettuare il <a href=\"login.php\"><span xml:lang=\"en\">login</span> o registrare un nuovo <span xml:lang=\"en\">account</span></a>";
	}

    $output = file_get_contents("html/schedule.html");
	$output = str_replace("<meta/>", file_get_contents("html/head.html"), $output);
    $output = str_replace("<div id=\"header\"></div>", Header::build(), $output);
    $output = str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
    $acquistoEffettuato = isset($done) ? "<div class=\"done\"><h2>" . $done . "</h2></div>" : "";
    $output = str_replace("<h2 acquisto/>", $acquistoEffettuato, $output);
    $output = str_replace("<form acquisto/>", $formAcquisto, $output);


    echo $output;
