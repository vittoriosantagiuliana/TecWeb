
window.onload = function () {
	var nav = document.getElementById('navbar');
	nav.classList.add('menu');
	document.getElementById('menuBtn').onclick = function () { nav.classList.toggle('menuOpen'); };
	document.getElementById('closeBtn').onclick = function () { nav.classList.remove('menuOpen'); };
};
