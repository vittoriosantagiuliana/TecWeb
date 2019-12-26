<?php

class Header
{
	public static function build()
	{
		$output = file_get_contents("html/header.html");
		$output = str_replace("<div id=\"navbar\"></div>", Header::navbar(), $output);
		return $output;
	}

	public static function navbar()
	{
		$page = $arrayName = array(
			'Home' => 'index.php',
			'Storia' => 'history.php',
			'Animali' => 'animals.php',
			'Attivit&agrave;' => 'activities.php',
			'Contatti' => 'contacts.php',
			'Log In' => 'login.php'
		);

		$output = "<div id=\"navbar\">";
		$output .= "<a href=\"#\" id=\"closeBtn\" class=\"fa fa-times-circle menuControl\" title=\"close menu\"></a>";
		foreach ($page as $nome => $indirizzo) {
			$output .= "<a href=\"$indirizzo\"";
			$output .= basename($_SERVER['PHP_SELF']) == $indirizzo ? " id=\"current\">" : ">";
			$output .= $nome . "</a>";
		}
		$output .= "</div>";

		return $output;
	}
}
	
?>
