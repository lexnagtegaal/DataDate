function JavaClick(e,$this){
	//<a class="java" href="function">...</a>
	e.preventDefault();
	if($($this).attr('href')=="rndm"){
		history.pushState(rndm(),"Random"); // voegt extra item aan geschiedenis toe met de 6 geladen profielen in een state.
	}
}
function startevents(){
	$("a.java").click(
					function(e){
						JavaClick(e,this);
						}); // <a class="java" href="function">...</a>
}
$(function (){
		startevents();
});

window.onpopstate = function(e) {
	data=e.state; // krijgt alle waarden
	if(data!==undefined) {
		// er is data gevonden, dus er is een aanpassing van de state geweest!
		e.preventDefault; // we gaan asynchroon terugladen!
		
		values=[]; // array om alle opgeslagen waardes uit op te halen.
		$(data).each(function( index ) {
			if(index>0){ // 0 is voor de definitie van gebruikte functie
				values.push($(this).text()); // array vullen vanuit de data
			}
		});
		
		//Als state gebruikt werd voor random
		if($(data[0]).text()=="Random"){ // gebruik gemaakt van de rndm functie
			$(values).each(function( index ) { 			// voor elke waarde in values
				rndm("Profile/index/"+$(this).text());	// wordt de rndm functie specifiek opgeroepen! 
			});
		}
	}
}
function Leeftijd(Geboortedatum){ // DD-MM-JJJJ en DD/MM/JJJJ zijn allebei geldige input!
	
	// Leeftijd vaststellen
	 var Vandaag = new Date; // Voorbeeld 04-17-2015
	 var Geboortedag = new Date(Geboortedatum); // Voorbeeld 11-10-1988
	 var Verjaardag = new Date(Geboortedatum.replace((Geboortedag.getFullYear()).toString(),(Vandaag.getFullYear()).toString())); // Voorbeeld 11-10-2015
	 var Leeftijd=(Vandaag.getFullYear()-Geboortedag.getFullYear()); // Voorbeeld 27
	 if(Vandaag.getTime()-Verjaardag.getTime() < 0){ 	// < 0
		 Leeftijd--; // nog geen verjaardag gevierd! Resultaat: 26!
	 }
	 return Leeftijd;
	 // Deze code is getest via W3Schools @ http://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_gettime
}