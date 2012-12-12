// Placeholder werkend maken voor andere browsers dan Safari
function updatePlaceholder(id, type) {
	i = document.getElementById(id);

	if (i.value == i.placeholder || i.value == '') {
		i.style.color = '#A9A9A9';
		if (i.id == 'wachtwoord' || i.id == 'wachtwoord_confirm') { i.type = 'text'; }
		else if (i.placeholder) i.value = i.placeholder;
	}
	else {
		i.style.color = '#000000';
		if (i.id == 'wachtwoord' || i.id == 'wachtwoord_confirm') { i.type = 'password'; }
	}
	
	if (i.value == i.placeholder && type == 'focus') {
		i.value = i.placeholder;
		if (i.id == 'wachtwoord' || i.id == 'wachtwoord_confirm') { i.type = 'text'; }
	}
	else if (i.value == i.placeholder && type == 'keydown') {
		i.value = '';
	}
	if (i.value == i.placeholder && type != 'keydown') {
		i.setSelectionRange(0, 0);
	}
	if (type == 'load') {
		i.focus();
	}
}

function toggleTableRow(checked, veld1, veld2, value1, value2) {
	if (checked && document.getElementById('checkcompatibility').style.display != 'table-row') {
		document.getElementById(veld1).style.display = 'block';
		document.getElementById(veld2).style.display = 'block';
	}
	else if (checked) {
		document.getElementById(veld1).style.display = 'table-row';
		document.getElementById(veld2).style.display = 'table-row';
	}
	else {
		document.getElementById(veld1).style.display = 'none';
		document.getElementById(veld2).style.display = 'none';
		document.getElementById(value1).value = '';
		document.getElementById(value2).value = '';
	}
}

// Pijltje tonen/verbergen bij header-menu
function showArrow(arrow) {
	document.getElementById('arrow' + arrow).style.display = 'inline';
}
function hideArrow(arrow) {
	document.getElementById('arrow' + arrow).style.display = 'none';
}
