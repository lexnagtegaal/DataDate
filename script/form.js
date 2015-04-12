// aantal globale regexpressies voor het formulier.

//Emailadres Regex
var emailRegex = '^[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}$'; 
//Wachtwoord Regex
var passwordRegex = '/^[a-z0-9_-]{6,18}$/';


// Wachten tot het document geladen is en dan alle events toevoegen.
$(function(){
	$("#login").submit(login(event));	
});

//Gedrag van login submit
function login(event){
	
	//Controleer input field email.
	if(!emailRegex.test($("#email").val())){
		$("p.error::first").innerhtml("Het opgegeven e-mailadres is geen correct e-mailadres");
		event.preventDefault;
	}
	
	//Controleer input field password
	if(!passwordRegex.test($("#password").val())){
		$("p.error::second").innerhtml("Het door u opgegeven wachtwoord bevat illegale tekens");
		event.preventDefault;
	}
}
