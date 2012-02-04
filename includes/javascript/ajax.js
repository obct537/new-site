var xmlhttp;
var var url;

function ajaxFunction(){

	if(window.ActiveXObject){
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		
	}else if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
		
	}else{
		alert("get a real browser");
	}

}

window.onload = ajaxFunction();
alert(xmlhttp);

function getInfo() {

var entryInfo = document.getElementBy
	
	if(xmlhttp.readyState == 4 ) {
	ajaxFunction();
	
	document.getElementById("results").innerHTML = xmlhttp.responseText;
	}
}