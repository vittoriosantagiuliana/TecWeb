<?php

function checkNumber ($n) {
	return filter_var($n, FILTER_VALIDATE_INT);
}

function checkEmail ($e) {
	return filter_var($e, FILTER_VALIDATE_EMAIL);
}
