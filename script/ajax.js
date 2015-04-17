var xmlhttp;
$("#profiles").ready(get_random_six(););
$(
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
);

function get_random_six(){
	xmlhttp.open("GET","Profile/random",true);
	$("#profiles")xmlhttp.responseText;
}