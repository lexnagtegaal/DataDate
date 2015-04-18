<?php
function EmailRegex($input,$getregex=false)
{
	//voor volledige emails.
	$regex="/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+[\.]+[A-Za-z]{2,4}$/";
	$error="Het opgegeven e-mailadres is geen correct e-mailadres.";
	return Validate($input,$regex,$getregex,$error);
}

function PasswordRegex($input,$getregex=false)
{
	//voor geldige wachtwoord van minimaal 4 karakters.
	$regex="/^[A-Za-z0.9]{4,}$/";
	$error="Op dit moment bestaat wachtwoord uit minimaal 4 karakter van cijfers en letters";
	return Validate($input,$regex,$getregex,$error);
}

function UserRegex($input,$getregex=false)
{
	//voor geldige username van minimaal 4 karakters.
	$regex="/^[A-Za-z0-9_-]{4,}$/";
	$error="Bijnaam mag alleen bestaan uit letters en cijfers in combinatie met '_' en '-' en moet minimaal uit 4 karakters bestaan.";
	return Validate($input,$regex,$getregex,$error);
}
			
function NameRegex($input,$getregex=false)
{
	//voor geldige username van minimaal 4 karakters.
	$regex="/^[A-Za-z -]*$/";
	$error="Naam kan alleen uit letters bestaan";
	return Validate($input,$regex,$getregex,$error);
}


function Validate($input,$regex,$getregex,$error){
	// De kracht achter de controle
	if($getregex){
		// stuurt de stringwaarde terug.
		return [str_replace("/","",$regex),$error];
	}
	if(preg_match($regex,$input)==1){
		return TRUE;
	}
	return FALSE;
	
}

function merken(){
	// een array van 50 merken! op te roepen via merken() overal in de code omdat regex_helper overal geladen wordt!
	return array(
				"Coca-Cola",
				"Pepsi",
				"Fanta",
				"Sisi",
				"Albert Heijn",
				"Jumbo",
				"Lidl",
				"Aldi",
				"Prodent",
				"Coolfresh",
				"Lays",
				"Pringles",
				"Netflix",
				"Nintendo",
				"Playstation",
				"Sony",
				"Android",
				"Apple",
				"Samsung",
				"Microsoft",
				"Efteling",
				"Walibi",
				"H&M",
				"New Yorker",
				"BBC",
				"C&A",
				"Primark",
				"V&D",
				"Zeeman",
				"Dirk",
				"Unox",
				"Gilette",
				"Hema",
				"Yamaha",
				"BMW",
				"Audi",
				"Mazda",
				"Maybeline",
				"Bijenkorf",
				"Soho",
				"M.A.C studio",
				"Axe",
				"Dove",
				"Nivea",
				"Ariel",
				"Robijn",
				"Gall & Gall",
				"Alpaca",
				"M&S mode",
				"Levies"	
				);
}
?>