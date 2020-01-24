<?php

class Header
{
	public static function build()
	{
		if (!isset($_SESSION)) {
			session_start();
		}
		$output = file_get_contents("html/header.html");
		$output = str_replace("<div id=\"navbar\"></div>", Header::navbar(), $output);
		return $output;
	}

	public static function navbar()
	{
		$page = array(
			'Home' => 'home.php',
			'Storia' => 'history.php',
			'Animali' => 'animals.php',
			'Orari e biglietti'=> 'schedule.php',
			'Attivit&agrave;' => 'activities.php',
			'Contatti' => 'contacts.php',
		);

		if (isset($_SESSION["userType"])) {
			$page['Esci'] = 'logout.php';
		}
		if (isset($_SESSION["userType"]) && $_SESSION["userType"] == "user") {
			$page['Area personale'] = 'user.php';
		} elseif (isset($_SESSION["userType"]) && $_SESSION["userType"] == "admin") {
			$page['Amministrazione'] = 'admin.php';
		} else {
			$page['Accedi'] = 'login.php';
		}

		$output = "<div id=\"navbar\">";
		$output .= "<i href=\"#\" class=\"fa fa-times-circle\" id=\"closeBtn\" title=\"close menu\"></i>";
		foreach ($page as $nome => $indirizzo) {
			$output .= basename($_SERVER['PHP_SELF']) == $indirizzo ? "<a id=\"current\">" : "<a href=\"$indirizzo\">";
			$output .= $nome . "</a>";
		}
		$output .= "</div>";

		return $output;
	}
}
