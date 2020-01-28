
function groupForm () {
	var formScuola = document.getElementById('scuola');
	var btnScuola = document.getElementById('btnScuolaSi');
	function checkScuola() { formScuola.style.display = btnScuola.checked ? "block" : "none"; }
	btnScuola.onclick = function () { checkScuola(); }
	document.getElementById('btnScuolaNo').onclick = function () { checkScuola(); }
	checkScuola();

	var numberInput = document.forms.namedItem("addGroupForm")["num"];

	numberInput.oninput = function () {
		var numRegExp = new RegExp("^[1-5][0-9]$");
		if (!numRegExp.test(numberInput.value))
			numberInput.value = numberInput.value.substring(0, str.length - 1);
	}

}



