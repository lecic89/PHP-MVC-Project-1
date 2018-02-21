var form = document.getElementById('form');

form.onsubmit = function () {
	var shipmentId = form.getAttribute('data-shipment-id');
	var url = form.getAttribute('data-url');
	var dc = document.getElementById('dc');
	var selected = dc.options[dc.selectedIndex].value;
	var message = document.getElementById('message').value;
	if (!message) {
		return false;
	}
	update(shipmentId, selected, message, url);
	return false;
};

function update(shipmentId, dc, message, url) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', url, true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	// xhr.setRequestHeader('HTTP_X_REQUESTED_WITH', 'XmlHttpRequest');
	xhr.send('shipment_id=' + shipmentId + '&dc=' + dc + '&message=' + message);
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4 && xhr.status === 200) {
			alert(xhr.responseText);
		}
	};
}
