/**
 * Funkcija za validaciju formulara
 * @returns Boolean
 */
function formValidation() {
	var formOk = true;
	var email = document.getElementById('email');
	var password = document.getElementById('password');
	if (email.value.length < 3) {
		email.parentElement.className += ' has-error';
		formOk = false;
	} else {
		email.parentElement.className = 'form-group';
	}
	if (!password.value) {
		password.parentElement.className += ' has-error';
		formOk = false;
	} else {
		password.parentElement.className = 'form-group';
	}
	return formOk;
}

document.getElementById('form').onsubmit = function () {
	return formValidation();
};
