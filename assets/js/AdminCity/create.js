/**
 * Funkcija za validaciju formulara
 * @returns Boolean
 */
function formValidation() {
	var formOk = true;
	var name = document.getElementById('name');
	if (name.value.length < 2) {
		name.parentElement.className += ' has-error';
		formOk = false;
	} else {
		name.parentElement.className = 'form-group';
	}
	return formOk;
}

document.getElementById('form').onsubmit = function () {
	return formValidation();
};
