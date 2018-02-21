/**
 * Funkcija za validaciju formulara
 * @returns Boolean
 */
function formValidation() {
	var formOk = true;
	var fn = document.getElementById('fn');
	var ln = document.getElementById('ln');
	var email = document.getElementById('email');
	var password = document.getElementById('password');
	if (fn.value.length < 2) {
		fn.parentElement.className += ' has-error';
		formOk = false;
	} else {
		fn.parentElement.className = 'form-group';
	}
	if (ln.value.length < 2) {
		ln.parentElement.className += ' has-error';
		formOk = false;
	} else {
		ln.parentElement.className = 'form-group';
	}
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
