//tabel.js laden voor ajax.js!

$(function(){
	Url = "Profile/"+$(".profiles > div").attr('class'); // Default staat Url op Profile/random
	
	/* Laadt 6 willekeurige profielen
	 * en stuurt deze terug opdat er met de geschiedenis gespeeld kan worden
	 * ten behoeve van goede backward compatibility.
	 */
	user=[];
	user.push(Url.split("Profile/")[1]);
	$(".profiles > div").html(""); // id met profiles wordt leeggemaakt!
	$.ajax({
        url: Url,
        type: 'GET', 
        dataType: 'xml',
        success: function(returnedXMLResponse){
            $('user', returnedXMLResponse).each(function(){
           	 // Data inladen!
           	 var $data = {} // lokaal elke loop weer opnieuw!
           	 $data['Bijnaam'] = $('Bijnaam',this).text();
           	 $data['Geslacht'] = $('Geslacht',this).text();
           	 $data['Leeftijd'] = Leeftijd($('Geboortedatum',this).text()); // Functie leeftijd in default.js
           	 $data['Beschrijving'] = (($('Beschrijving',this).text()).split(".")[0]);
           	 $data['Persoonlijkheidstype'] = $('Persoonlijkheidstype',this).text(); 
           	 $data['Foto'] = "image/" + $data['Geslacht'] + ".png"; // bijvoorbeeld image/Man.png
           	 $data['Overzicht']="TRUE"; // of er sprake is van een overzicht van (meerdere) profielen.
           	 $data['Merk']=4; // het aantal weer te geven merken.
           	 var div = document.createElement("div");
           	 $(div).append(createTable($data));
           	 $(".profiles > div").append(div); // createTable in tabel.js
           	 user.push($data['Bijnaam']); // voegt de recente gebruikersnaam toe aan de array.
            })
        }  
    }); 
		//history.replaceState(rndm(),"Random");
		/*$functie = $(".profiles > div").attr('class');
		switch($functie){
		case "matches":
			history.replaceState(rndm("Profile/matches"),"Matches");
			break;
		case "search":
			history.replaceState(rndm("Profile/search"),"Search");
			break;
		default:
			history.replaceState(rndm(),"Random");
			break;
		}*/
});
function rndm(Url){
	
	Url = Url || "Profile/random"; // Default staat Url op Profile/random
	
	/* Laadt 6 willekeurige profielen
	 * en stuurt deze terug opdat er met de geschiedenis gespeeld kan worden
	 * ten behoeve van goede backward compatibility.
	 */
	user=[];
	user.push(Url.split("Profile/")[1]);
	$(".profiles > div").html(""); // id met profiles wordt leeggemaakt!
	$.ajax({
        url: Url,
        type: 'GET', 
        dataType: 'xml',
        success: function(returnedXMLResponse){
            $('user', returnedXMLResponse).each(function(){
           	 // Data inladen!
           	 var $data = {} // lokaal elke loop weer opnieuw!
           	 $data['Bijnaam'] = $('Bijnaam',this).text();
           	 $data['Geslacht'] = $('Geslacht',this).text();
           	 $data['Leeftijd'] = Leeftijd($('Geboortedatum',this).text()); // Functie leeftijd in default.js
           	 $data['Beschrijving'] = (($('Beschrijving',this).text()).split(".")[0]);
           	 $data['Persoonlijkheidstype'] = $('Persoonlijkheidstype',this).text(); 
           	 $data['Foto'] = "image/" + $data['Geslacht'] + ".png"; // bijvoorbeeld image/Man.png
           	 $data['Overzicht']="TRUE"; // of er sprake is van een overzicht van (meerdere) profielen.
           	 $data['Merk']=4; // het aantal weer te geven merken.
           	 var div = document.createElement("div");
           	 $(div).append(createTable($data));
           	 $(".profiles > div").append(div); // createTable in tabel.js
           	 user.push($data['Bijnaam']); // voegt de recente gebruikersnaam toe aan de array.
            })
        }  
    }); 
	//return user;
	
	/* Onderste deel is voor het testen van het weergeven
	// Data inladen!
	 var $data = {} // lokaal elke loop weer opnieuw!
	 $data['Bijnaam'] = "Lex";
	 $data['Geslacht'] = "Man";
	 $data['Leeftijd'] = "21";
	 $data['Beschrijving'] = "Ik ben Lex en ik hou van meisjes";
	 $data['Persoonlijkheidstype'] = "Extravert"; 
	 $data['Foto'] = "image/" + $data.Geslacht + ".png"; // bijvoorbeeld image/Man.png
	 $data['Overzicht']="TRUE"; // of er sprake is van een overzicht van (meerdere) profielen.
	 $data['Merk']=4; // het aantal weer te geven merken.
	 $(".profiles > div").append(createTable($data));
	 */
}