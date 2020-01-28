
function mailCheck () {
	var emailRegExp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var emailInput = document.forms.namedItem("contact_form")["email"];

	emailInput.onchange = function () {
		if (!emailRegExp.test(emailInput.value)) {
			emailInput.value = "";
		}
	}
}
