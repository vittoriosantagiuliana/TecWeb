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
			'Home' => 'home.php',
			'Storia' => 'history.php',
			'Animali' => 'animals.php',
			'Attivit&agrave;' => 'activities.php',
			'Contatti' => 'contacts.php',
			'Come raggiungerci' => 'maps.php',
			'Accedi' => 'login.php'
		);

		$output = "<div id=\"navbar\">";
		$output .= "<a href=\"#\" class=\"fa fa-times-circle\" id=\"closeBtn\" title=\"close menu\"></a>";
		foreach ($page as $nome => $indirizzo) {
			$output .= basename($_SERVER['PHP_SELF']) == $indirizzo ? "<a id=\"current\">" : "<a href=\"$indirizzo\">";
			$output .= $nome . "</a>";
		}
		$output .= "</div>";

		return $output;
	}
}
	
?>
