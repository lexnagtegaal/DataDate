<?php
function EmailRegex($input,$getregex=false)
{
	//voor volledige emails.
	$regex="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+[\.]+[A-Za-z]{2,4}$";
	return Validate($input,$regex,$getregex);
}

function UserRegex($input,$getregex=false)
{
	//voor geldige username van minimaal 4 karakters.
	$regex="^[A-Za-z0.9_-]{4,}$";
	return Validate($input,$regex,$getregex);
}

function Validate($input,$regex,$getregex){
	// De kracht achter de controle
	if($getregex){
		// stuurt de stringwaarde terug.
		return $regex;
	}
	if(preg_match($regex,$input)==1){
		return TRUE;
	}
	return FALSE;
	
}
?>