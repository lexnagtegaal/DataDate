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