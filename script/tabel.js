function createTable($data){
	
	 //aanpassen voor basis url binnen dit js bestand
	url = "http://www.students.science.uu.nl/~5500206/WT/P3/"
	var $Tabel=document.createElement('table'); // geeft <tabel></tabel>
	if($data['Foto']!==undefined){
		$Foto = $(document.createElement("img"))
					.attr({
							src: +url+$data['Foto'],
							alt: $data['Bijnaam']
						});
		$TR=$(document.createElement('tr')).attr('id','profielfoto'); // geeft <tr id='profielfoto'></tr>
		$TH=document.createElement('th');
		if($data['Overzicht']){
			$($TH).append(
						$(document.createElement('a'))
							.attr("href", "Profilepage/show/"+$data['Bijnaam']+"")
							.append($Foto)
							);
		}else{
			$($TH).append($Foto);
		}
		$($TR).append($TH);
		$($Tabel).append($TR); // voegt het gehele TR element toe aan tabel.
	}
	if($data['Bijnaam']!==undefined){
		$TR=$(document.createElement('tr')).attr('class','tekst'); // geeft <tr class='tekst'></tr>
		$($TR).append(
			$(document.createElement('th'))
				.append(document.createTextNode("Bijnaam:"))); // voegt <th>Bijnaam:</th> toe.
		$TH=document.createElement('th');
		if($data['Overzicht']){
			$($TH).append(
					$(document.createElement('a'))
						.attr("href", "Profilepage/show/"+$data['Bijnaam']+"")
						.append($data['Bijnaam'])
						);
		}else{
			$($TH).append($data['Bijnaam']);
		}
		$($TR).append($TH);
		$($Tabel).append($TR); // voegt het gehele TR element toe aan tabel.
	}
	if($data['Geslacht']!==undefined){
		$TR=$(document.createElement('tr'))
				.attr('class','tekst');
		$($TR).append(
				$(document.createElement('th'))
					.append(
							document.createTextNode("Geslacht:"))); // voegt <th>Geslacht:</th> toe.
		$($TR).append(
				$(document.createElement('th'))
					.append(
							document.createTextNode($data['Geslacht']))); // voegt bijvoorbeeld <th>Man</th> toe.
		$($Tabel).append($TR); // voegt het gehele TR element toe aan tabel.
	}
	if($data['Geboortedatum']!==undefined){
		$TR=$(document.createElement('tr')).attr('class','tekst'); // geeft <tr class='tekst'></tr>
		$($TR).append(
				$(document.createElement('th'))
					.append(document.createTextNode("Geboortedatum:"))); // voegt <th>Geboortedatum:</th> toe.
		$($TR).append(
				$(document.createElement('th'))
					.append(document.createTextNode($data['Geboortedatum']))); // voegt bijvoorbeeld <th>Geboortedatum</th> toe.
		$($($Tabel).append($TR)); // voegt het gehele TR element toe aan tabel.
	}
	if($data['Leeftijd']!==undefined){
		$TR=$(document.createElement('tr')).attr('class','tekst'); // geeft <tr class='tekst'></tr>
		$($TR).append(
				$(document.createElement('th'))
					.append(document.createTextNode("Leeftijd:"))); // voegt <th>Leeftijd:</th> toe.
		$($TR).append(
				$(document.createElement('th'))
					.append(document.createTextNode($data['Leeftijd']))); // voegt bijvoorbeeld <th>26</th> toe.
		$($Tabel).append($TR); // voegt het gehele TR element toe aan tabel.
	}
	if($data['Beschrijving']!==undefined){
		$TR=$(document.createElement('tr')).attr('class','tekst'); // geeft <tr class='tekst'></tr>
		$($TR).append(
				$(document.createElement('th'))
					.append(document.createTextNode("Beschrijving:"))); // voegt <th>Beschrijving:</th> toe.
		$($TR).append(
				$(document.createElement('th'))
					.append(document.createTextNode($data['Beschrijving']))); // voegt bijvoorbeeld <th>Hoi ik ben Lex en ik hou van meisjes.</th> toe.
		$($Tabel).append($TR); // voegt het gehele TR element toe aan tabel.
	}
	if($data['Geslachtsvoorkeur']!==undefined){
		$TR=$(document.createElement('tr')).attr('class','tekst'); // geeft <tr class='tekst'></tr>
		$($TR).append(
				$(document.createElement('th')).
					append(document.createTextNode("Geinteresseerd in:"))); // voegt <th>Geintereseerd in:</th> toe.
		$($TR).append(
				$(document.createElement('th'))
					.append(document.createTextNode($data['Geslachtsvoorkeur']))); // voegt bijvoorbeeld <th>Vrouwen</th> toe.
		$($Tabel).append($TR); // voegt het gehele TR element toe aan tabel.
	}
	if($data['Minimumleeftijd']!==undefined && $data['Maximumleeftijd']!==undefined){
		$TR=$(document.createElement('tr')).attr('class','tekst'); // geeft <tr class='tekst'></tr>
		$($TR).append(
				$(document.createElement('th'))
					.append(document.createTextNode("tussen de leeftijd"))); // voegt <th>tussen de leeftijd</th> toe.
		$($TR).append(
				$(document.createElement('th'))
					.append(document.createTextNode($data['Minimumleeftijd'] + " en " + $data['Maxmimumleeftijd']))); // voegt bijvoorbeeld <th>19 en 27</th> toe.
		$($Tabel).append($TR); // voegt het gehele TR element toe aan tabel.
	}
	if($data['Persoonlijkheidstype']!==undefined){
		$TR=$(document.createElement('tr')).attr('class','tekst'); // geeft <tr class='tekst'></tr>
		$($TR).append(
				$(document.createElement('th'))
					.append(document.createTextNode("Persoonlijkheidstype"))); // voegt <th>Persoonlijkheidstype:</th> toe.
		$($TR).append(
				$(document.createElement('th'))
					.append(document.createTextNode($data['Persoonlijkheidstype']))); // voegt bijvoorbeeld <th>Extravert</th> toe.
		$($Tabel).append($TR); // voegt het gehele TR element toe aan tabel.
	}
	if($data['Persoonlijkheidsvoorkeur']!==undefined){
		$TR=$(document.createElement('tr')).attr('class','tekst'); // geeft <tr class='tekst'></tr>
		$($TR).append(
				$(document.createElement('th'))
					.append(document.createTextNode("Persoonlijkheidsvoorkeur:"))); // voegt <th>Persoonlijkheidsvoorkeur:</th> toe.
		$($TR).append(
				$(document.createElement('th'))
					.append(document.createTextNode($data['Persoonlijkheidsvoorkeur']))); // voegt bijvoorbeeld <th>Introvert</th> toe.
		$($Tabel).append($TR); // voegt het gehele TR element toe aan tabel.
	}
	if($data['Merk']!==undefined){
		$TR=$(document.createElement('tr')).attr('class','tekst'); // geeft <tr class='tekst'></tr>
		$($TR).append(
				$(document.createElement('th')).
					append(document.createTextNode("Merken:"))); // voegt <th>Merken:</th> toe.
		$merken="";
		$.ajax({
			url: 'Profile/brand/'+$data['Bijnaam']+'/'+$data['Merk'],
			type: 'GET', 
			dataType: 'xml',
		    success: function(returnedXMLResponse){
		    	$('user', returnedXMLResponse).each(function(){
		    		$merk = $('Merk',this).text();
		    		$($merken).append("<span class='merk'>"+$merk+"</span>"); // hierdoor ontstaat een opsomming van bijvoorbeeld <span class"merk">Coca-Cola</span>
		            	  })
		    	}
			});
		$($TR).append(
				$(document.createElement('th'))
					.append(document.createTextNode($merken)));
		$($Tabel).append($TR); // voegt het gehele TR element toe aan tabel.
	}
	return $Tabel;
}