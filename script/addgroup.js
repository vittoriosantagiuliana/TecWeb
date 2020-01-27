
function groupForm () {
	var formScuola = document.getElementById('scuola');
	var btnScuola = document.getElementById('btnScuolaSi');
	function checkScuola() { formScuola.style.display = btnScuola.checked ? "block" : "none"; }
	btnScuola.onclick = function () { checkScuola(); }
	document.getElementById('btnScuolaNo').onclick = function () { checkScuola(); }
	checkScuola();
}
