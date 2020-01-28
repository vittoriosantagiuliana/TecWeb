<?php

function checkNumber ($n) {
	return filter_var($n, FILTER_VALIDATE_INT);
}

function checkEmail ($e) {
	return filter_var($e, FILTER_VALIDATE_EMAIL);
}

function sanitizeNumber ($n) {
	$temp = filter_var($n, FILTER_SANITIZE_NUMBER_INT);
	return $temp > 0 ? $temp : 0;
}

function sanitizeEmail ($e) {
	return filter_var($e, FILTER_SANITIZE_EMAIL);
}

function sanitizeString ($s) {
	return filter_var(trim($s), FILTER_SANITIZE_STRING);
}
