// Copyright Thomas Hoornstra
// Laatst aangepast: 1 april 2012

var http_request = false;
if (request_url == null) var request_url = '/leden/ledenbestand';
if (cookienaam == null) var cookienaam = 'ledenbestand';

function SetCookie(cookieName,cookieValue,nDays) {
    var today = new Date();
    var expire = new Date();
    if (nDays==null || nDays==0) nDays=365*24*3600*1000;
    expire.setTime(today.getTime() + nDays);
    document.cookie = cookieName+"="+escape(cookieValue)
                 + ";expires="+expire.toGMTString();
}
function ReadCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function makePOSTRequest(url, parameters, spanid, toondirect) {
  http_request = false;
  if (window.XMLHttpRequest) { // Mozilla, Safari,...
	 http_request = new XMLHttpRequest();
	 if (http_request.overrideMimeType) {
		// set type accordingly to anticipated content type
		//http_request.overrideMimeType('text/xml');
		http_request.overrideMimeType('text/html');
	 }
  } else if (window.ActiveXObject) { // IE
	 try {
		http_request = new ActiveXObject("Msxml2.XMLHTTP");
	 } catch (e) {
		try {
		   http_request = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {}
	 }
  }
  if (!http_request) {
	 alert('Cannot create XMLHTTP instance');
	 return false;
  }

  http_request.onreadystatechange = function() {
	if (http_request.readyState == 4) {
		//if (http_request.status == 200) {
			result = http_request.responseText;
			document.getElementById(spanid).innerHTML = result;
			if (toondirect != null) {
				if (document.getElementById('leden').childNodes[2]) {
					document.getElementById('geselecteerdlid').value = document.getElementById('leden').childNodes[2].value;
					toonLid(document.getElementById('leden').childNodes[2].value);
				}
			}
			if (document.getElementById('lid_' + document.getElementById('geselecteerdlid').value) != null) document.getElementById('lid_' + document.getElementById('geselecteerdlid').value).style.fontWeight = 'bold';
		//}
		//else alert('Er is een probleem opgetreden bij de aanvraag.');
	}
	  
  };
  http_request.open('POST', url, true);
  http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http_request.send(parameters);
}

function Set_getElementsByClassName(){
	if (document.getElementsByClassName == undefined) {
		document.getElementsByClassName = function(className)
		{
			var hasClassName = new RegExp("(?:^|\\s)" + className + "(?:$|\\s)");
			var allElements = document.getElementsByTagName("*");
			var results = [];
	
			var element;
			for (var i = 0; (element = allElements[i]) != null; i++) {
				var elementClass = element.className;
				if (elementClass && elementClass.indexOf(className) != -1 && hasClassName.test(elementClass))
					results.push(element);
			}
	
			return results;
		}
	}
}

function setInfoField(veldid, postnaam) {
	templocation = document.getElementById('verzendinfo').value;
	regexp = '&' + postnaam + '=([^&]*)';
	newlocationarray = templocation.match(new RegExp( regexp, 'g' ), "$1");
	newlocation = '';
	document.getElementById(veldid).value = '';
	if (newlocationarray != null) {
		newlocation = newlocationarray[0];
		newlocationinfo = newlocation.replace(new RegExp( regexp, 'g' ), "$1");
		document.getElementById(veldid).value = newlocationinfo;
	}
}

window.onload = function() {
	Set_getElementsByClassName();
	if (!isNaN(document.getElementById('eersteresultaat').value)) toonLid(document.getElementById('eersteresultaat').value);
	document.getElementById('naam').focus();
	/*
	if (ReadCookie(cookienaam) != "" && ReadCookie(cookienaam) != null) {
		document.getElementById('verzendinfo').value = unescape(ReadCookie(cookienaam));
		getLeden(document.getElementById('verzendinfo').value, 'true');
		setInfoField('ledenselecteerinfo', 'leden');
		setInfoField('naam', 'naam');
		setInfoField('alles', 'alles');
	}
	*/
	openLink('', '', null, 'true');
}

function checkPijltjesToetsen(evt) {
    evt = (evt) ? evt : ((window.event) ? event : null);
    if (evt) {
    	huidiglid = document.getElementById('geselecteerdlid').value;
    	voriglid = document.getElementById('voriglid_' + huidiglid).value;
		volgendlid = document.getElementById('volgendlid_' + huidiglid).value;
         switch (evt.keyCode) {
            case 37:
				if (cookienaam != 'ledenbestand') selecteerLid(huidiglid, false);
                break;    
            case 38:
                if (voriglid != '') toonLid(voriglid);
                break;    
            case 39:
                if (cookienaam != 'ledenbestand') selecteerLid(huidiglid, true);
                break;    
            case 40:
                if (volgendlid != '') toonLid(volgendlid);
                break;    
         }
    }
}

document.onkeyup = checkPijltjesToetsen;

function getLeden(request, toondirect) {
  var poststr = "filteren=''" + request;
  makePOSTRequest(request_url, poststr, "leden", toondirect);
}

function toonLid(request) {
  var poststr = "toonlid=" + request;
  makePOSTRequest(request_url, poststr, "lid_details");
  if (document.getElementById('lid_' + document.getElementById('geselecteerdlid').value) != null) {
  	document.getElementById('lid_' + document.getElementById('geselecteerdlid').value).style.fontWeight = 'normal';
  }
  document.getElementById('geselecteerdlid').value = request;
  if (document.getElementById('lid_' + document.getElementById('geselecteerdlid').value) != null) {
  	document.getElementById('lid_' + request).style.fontWeight = 'bold';
  }
}

function showOptions(id, checked) {
	toggleCheck(id + '_main');
	checked_box = document.getElementById(id + '_main').checked;
	if (checked_box == true) {
		document.getElementById(id).style.display = 'block';
		//checkAll(id, 'all');
		checkAll(id, 'none');
	}
	else {
		document.getElementById(id).style.display = 'none';
		checkAll(id, 'none');
	}
}

function toggleCheck(id, omgekeerd) {
	var checkbox = document.getElementById(id);
	if (omgekeerd) {
		if (!checkbox.checked) checkbox.checked = false;
		else checkbox.checked = true;
	}
	else {
		if (!checkbox.checked) checkbox.checked = true;
		else checkbox.checked = false;
	}
}

function checkAll(id, checkall) {
	var myform = document.getElementById(id);
	var inputTags = myform.getElementsByTagName('input');
	var checkboxCount = 0;
	uncheck = false;
	// als de optie 'Alle opties' niet checked is, dan alles uit checken
	if ((inputTags[0].checked == false && checkall != 'all') || checkall == 'none') { uncheck = true; }
	for (var i=0, length = inputTags.length; i<length; i++) {
		 if (inputTags[i].type == 'checkbox') {
			 (uncheck) ? inputTags[i].checked = false : inputTags[i].checked = true;
		 }
	}
	(checkall == 'none') ? openLink(id, null, true) : openLink(id);
}

function openLink(id, customcontent, leegmaken, toondirect) {

	if (customcontent != null) {
		link = '&' + id + '=' + customcontent;
	}
	else {
		var myform = document.getElementById(id);
		var inputTags = myform.getElementsByTagName('input');
		checked_input = '';
		for (var i=0, length = inputTags.length; i<length; i++) {
			 if (inputTags[i].type == 'checkbox') {
				 if (inputTags[i].checked == true && inputTags[i].value != '') {
					checked_input += inputTags[i].value + ",";
				 }
			 }
		}
		link = '&' + id + '=' + checked_input.substr(0, (checked_input.length - 1));
	}
	templocation = document.getElementById('verzendinfo').value;
	linkdeel = /&([^=]*)=/i.exec(link);
	linktext = link.replace(/&([^=]*)=/g,"\1");
	regexp = '&' + linkdeel[1] + '=[^&]*';
	if (leegmaken == true) { link = ''; }
	document.getElementById('verzendinfo').value = templocation.replace(new RegExp( regexp, 'g' ), "") + link;

	templocation = document.getElementById('verzendinfo').value;
	setInfoField('ledenselecteerinfo', 'leden');
	regexp2 = /,/g;
	for( var aantalgeselecteerd = 0; regexp2.exec(newlocation); aantalgeselecteerd++ );
	if (newlocation != '' && newlocation != "&leden=") { aantalgeselecteerd++; }
	lidtekst = ' leden';
	if (aantalgeselecteerd == 1) { lidtekst = ' lid'; }
	document.getElementById('aantalgeselecteerd').innerHTML = aantalgeselecteerd + lidtekst;
	getLeden(document.getElementById('verzendinfo').value, toondirect);
}


function selecteerLid(lid, checked) {
	
/* 
	templid = document.getElementById('ledenselecteerinfo').value;
	liddeel = /&([^=]*)=/i.exec(lid);
	lidtext = lid.replace(/&([^=]*)=/g,"\1");
	regexp = '&' + lidtext[1] + '=[^&]*';
	document.getElementById('ledenselecteerinfo').value = templid.replace(new RegExp( regexp, 'g' ), "") + lid;

 */
	templid = ',' + document.getElementById('ledenselecteerinfo').value + ',';
	if (document.getElementById('ledenselecteerinfo').value == "") { templid = ','; }
	regexp = ',' + lid + ',';
	if (checked == false) { lid = ''; }
	ledenvalue = (templid.replace(new RegExp( regexp, 'g' ), ",") + lid);
	if (checked == false) { ledenvalue = ledenvalue.substr(0, (ledenvalue.length - 1)); }
	document.getElementById('ledenselecteerinfo').value = ledenvalue.substr(1);
	openLink('leden', document.getElementById('ledenselecteerinfo').value);

}

function zoekveldAanpassen(value) {
	if (value == 'naam') {
		document.getElementById('naam').style.display = 'inline';
		document.getElementById('alles').style.display = 'none';
		document.getElementById('naam').value = document.getElementById('alles').value;
		regexp = '&alles=([^&]*)';
		document.getElementById('verzendinfo').value = document.getElementById('verzendinfo').value.replace(new RegExp( regexp, 'g' ), "&naam=$1");
		openLink('leden', document.getElementById('ledenselecteerinfo').value);
	}
	else {
		document.getElementById('naam').style.display = 'none';
		document.getElementById('alles').value = document.getElementById('naam').value;
		document.getElementById('alles').style.display = 'inline';	
		regexp = '&naam=([^&]*)';
		document.getElementById('verzendinfo').value = document.getElementById('verzendinfo').value.replace(new RegExp( regexp, 'g' ), "&alles=$1");
		openLink('leden', document.getElementById('ledenselecteerinfo').value);
	}

}

function getGeselecteerdeLeden(id, locatie) {
	newlocation = document.getElementById('ledenselecteerinfo').value;
	if (newlocation != "") { document.getElementById(id).href = locatie + newlocation; return true; }
	else { alert('Er zijn nog geen leden geselecteerd.'); return false; }

}
