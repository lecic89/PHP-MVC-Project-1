/**
 * Funkcija za validaciju formulara
 * @returns Boolean
 */
function formValidation() {
	var formOk = true;
	var email = document.getElementById('email');
	var content = document.getElementById('content');
	if (email.value.length < 3) {
		email.parentElement.className += ' has-error';
		formOk = false;
	} else {
		email.parentElement.className = 'form-group';
	}
	if (content.value.length < 10) {
		content.parentElement.className += ' has-error';
		formOk = false;
	} else {
		content.parentElement.className = 'form-group';
	}
	return formOk;
}

document.getElementById('form').onsubmit = function () {
	return formValidation();
};
