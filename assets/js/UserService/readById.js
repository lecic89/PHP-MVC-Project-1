var offers = document.getElementById('offers');
var serviceId = offers.getAttribute('data-service-id');
var url = offers.getAttribute('data-url');

function refreshOffers() {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', url, true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	// xhr.setRequestHeader('HTTP_X_REQUESTED_WITH', 'XmlHttpRequest');
	xhr.send('service_id=' + serviceId);
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4 && xhr.status === 200) {
			document.getElementById('offers').innerHTML = xhr.responseText;
		}
	};
}

var refreshBtn = document.getElementById('refresh');
refreshBtn.onclick = function () {
	refreshOffers();
	refreshBtn.blur();
};

refreshOffers();
