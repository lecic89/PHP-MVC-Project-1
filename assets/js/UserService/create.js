/**
 * Funkcija za validaciju formulara
 * @returns Boolean
 */
function formValidation() {
	var formOk = true;
	var description = document.getElementById('description');
	var hours = document.getElementById('hours');
	var minutes = document.getElementById('minutes');
	var day = document.getElementById('day');
	var month = document.getElementById('month');
	if (description.value.length < 2) {
		description.parentElement.className += ' has-error';
		formOk = false;
	} else {
		description.parentElement.className = 'form-group';
	}
	if (hours.value < 0 || hours.value > 23) {
		hours.parentElement.className += ' has-error';
		formOk = false;
	} else {
		hours.parentElement.className = 'form-group';
	}
	if (minutes.value < 0 || minutes.value > 59) {
		minutes.parentElement.className += ' has-error';
		formOk = false;
	} else {
		minutes.parentElement.className = 'form-group';
	}
	if (day.value < 0 || day.value > 31) {
		day.parentElement.className += ' has-error';
		formOk = false;
	} else {
		day.parentElement.className = 'form-group';
	}
	if (month.value < 0 || month.value > 12) {
		month.parentElement.className += ' has-error';
		formOk = false;
	} else {
		month.parentElement.className = 'form-group';
	}
	return formOk;
}

document.getElementById('form').onsubmit = function () {
	return formValidation();
};
