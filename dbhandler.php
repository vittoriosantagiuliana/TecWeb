<?php

function connessione()
{
	$host = "localhost";
	$username = "root";
	$password = "";
	$db_name = "my_creolazoo";

	$connessione = new mysqli($host, $username, $password, $db_name);
	if ($connessione->connect_errno) {
		echo "Connessione fallita(" . $connessione->connect_errno . "):" . $connessione->connect_error;
		exit();
	}
	else
		return $connessione;
}

?>
