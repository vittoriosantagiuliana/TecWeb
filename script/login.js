
window.onload = function () {
	var formGruppo = document.getElementById('gruppo');
	var formScuola = document.getElementById('scuola');
	var btnAccompagnatore = document.getElementById('btnAccompagnatore');
	var btnScuola = document.getElementById('btnScuolaSi');
	function checkGruppo() { formGruppo.style.display = btnAccompagnatore.checked ? "block" : "none"; }
	function checkScuola() { formScuola.style.display = btnScuola.checked ? "block" : "none"; }
	btnAccompagnatore.onclick = function () { checkGruppo(); }
	btnScuola.onclick = function () { checkScuola(); }
	document.getElementById('btnUtente').onclick = function () { checkGruppo(); }
	document.getElementById('btnScuolaNo').onclick = function () { checkScuola(); }
	checkGruppo();
	checkScuola();
}
