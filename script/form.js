// aantal globale regexpressies voor het formulier.

//Emailadres Regex
var emailRegex = new RegExp('^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+[\.]+[A-Za-z]{2,4}$'); 
//Wachtwoord Regex
var passwordRegex = new RegExp('^[A-Za-z0-9_-]{6,18}$');


// Wachten tot het document geladen is en dan alle events toevoegen.
$(function(){
	$("#login").submit(function(event){login(event);});	
});

//Gedrag van login submit
function login(event){
	
	// PERSOONLIJKE NOOT! ER IS NU ALLEEN CONTROLE OP DE CORRECTE SYNTAXVOERING
	// EVENTUEEL CONTROLE VAN WAT ER PRECIES MIS IS... BIJVOORBEELD DE LENGTE VAN HET WACHTWOORD? ETC.
	
	//Maak alle velden leeg
	$("p.error_find").html("");
	$("p.error_email").html("");
	$("p.error_password").html("");
	
	//Controleer input field email.
	if(!emailRegex.test($("#email").val())){
		$("p.error_email").html("Het opgegeven e-mailadres is geen correct e-mailadres");
		event.preventDefault();
	}
	
	//Controleer input field password
	if(!passwordRegex.test($("#password").val())){
		$("p.error_password").html("Het door u opgegeven wachtwoord bevat illegale tekens");
		event.preventDefault();
	}
}
