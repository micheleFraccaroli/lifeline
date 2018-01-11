function chech_search() {
	if(document.getElementById('srch-term').value == 0) {
		alert("Non puoi fare ricerche a vuoto");
		document.getElementById('srch-term').focus();
		return false;
	}
}