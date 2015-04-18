// aantal globale regexpressies voor het formulier.

//Emailadres Regex
var emailRegex = new RegExp('^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+[\.]+[A-Za-z]{2,4}$'); 
var email = "Het opgegeven e-mailadres is geen correct e-mailadres.";
//Wachtwoord Regex
var passwordRegex = new RegExp('^[A-Za-z0.9]{4,}$');
var password = "Het door u opgegeven wachtwoord voldoet niet aan de eisen.";
//UserName Regex
var usernameRegex = new RegExp('^[A-Za-z0.9_-]{4,}$');
var username = "Bijnaam mag alleen bestaan uit letters en cijfers in combinatie met \"_\" en \"-\" en moet minimaal uit 4 karakters bestaan.";
//Naam RegEx
var nameRegex = new RegExp('^[A-Za-z -]*$');
var name = "Een naam bestaat alleen maar uit letters.";


// Wachten tot het document geladen is en dan alle events toevoegen.
$(function(){
	$("#login").submit(function(event){login(event,"#login");});	
	$("#register").submit(function(event){register(event,"#register");});
});
function leeg(){
	$("form > p").html("");
}
function controle(event,$form,$regexp,$input,$error){
	// De kracht achter de regex validatie.
	if(!$regexp.test($($input).val())){
		Display_error(event,$form,$input,$error);
	}
}
function Display_error(event,$form,$input,$error){
	// De weergave van de fouten!
	
	var P = document.createElement("p");       // Create a <li> node
	var textnode = document.createTextNode($error);  // Create a text node
	P.appendChild(textnode);                    // Append the text to <li>
	form=$($form);
	input=$($input);
	form.insertBefore(P,input);
	console.log(form);
}
//Gedrag van login submit
function login(event,form){
	//Maak alle velden leeg
	leeg();

	//Controle van invulvelden
	controle(event,form,emailRegex,"#email",email);
	controle(event,form,passwordRegex, "#password",password);
}

//Gedrag van register submit
function register(event,form){
	
	// Maak alle velden leeg
	leeg();
	
	// Controle van invulvelden
	controle(event,form,usernameRegex,"#Nickname",username);
	controle(event,form,nameRegex,"#FirstName",name);
	controle(event,form,nameRegex,"#MiddleName",name);
	controle(event,form,nameRegex,"#LastName",name);
	controle(event,form,passwordRegex,"#password",password);
	controle(event,form,passwordRegex,"#password_confirm",password);
	controle(event,form,emailRegex,"#email",email);
}