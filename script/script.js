
window.onload = function () {
	var nav = document.getElementById('navbar');
	nav.classList.add('menu');
	document.getElementById('menuBtn').onclick = function () { nav.classList.toggle('menuOpen'); };
	document.getElementById('closeBtn').onclick = function () { nav.classList.remove('menuOpen'); };
	
	var topButton = document.getElementById("topBtn");
	topButton.onclick = function() { window.scroll({ top: 0, left: 0, behavior: 'smooth' }); };
	window.onscroll = function() {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20)
		{ topButton.style.display = "block"; }
		else
		{ topButton.style.display = "none"; }
	}
	
	if (typeof(groupForm) === "function") { groupForm(); }
	if (typeof(mailCheck) === "function") { mailCheck(); }
};
