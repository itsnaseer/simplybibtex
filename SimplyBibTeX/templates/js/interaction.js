// JavaScript Document

function changeClass(id,newclass) {
	document.getElementById(id).className = newclass;
}
function toggle(id, caller) {
	if (document.getElementById(id).className == 'hidden') {
		document.getElementById(id).className = 'visible';
		if (caller) caller.className = 'item_short_expand';
	} else {
		document.getElementById(id).className = 'hidden';
		if (caller) caller.className = 'item_short';
		
	}
		
}
