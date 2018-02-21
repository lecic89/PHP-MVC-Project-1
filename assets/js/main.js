function init() {
	updateMenuStyle();
}

window.onresize = updateMenuStyle;

/**
 * Nije dobro rešenje
 * Izgleda ružno
 * Bolje rešenje: preko CSS media-query pravila pregaziti originalan Bootstrap kod
 * Možda će biti implementirano za potrebe finalnog preseka
 */
function updateMenuStyle() {
	var w = getWindowWidth();
	console.log('Širina prozora: ' + w);
	var el = document.getElementById('primary-nav');
	if (w < 768) {
		el.className = 'nav nav-pills nav-stacked';
	} else {
		el.className = 'nav nav-tabs';
	}
}

/**
 * Cross-browser rešenje za nalaženje širine prozora Veb pregledača
 * @returns int
 */
function getWindowWidth() {
	return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
}

init();
