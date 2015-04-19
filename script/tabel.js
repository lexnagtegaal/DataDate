function createTR(object,attributen){
	//data = array met attributen in key : value paren.
	//object moet ook een echt object zijn, bijvoorbeeld textNode!
	TR=document.createElement('tr');
	if(attributen!=undefined){
		$(TR).attr(attributen); // bijvoorbeeld <th id='profielfoto'></tr>
	}
	if(object!=undefined){
		$(TR).append(object);	
	}
	return TR;
}
function createTH(object,attributen){
	//data = array met attributen in key : value paren.
	//object moet ook een echt object zijn, bijvoorbeeld textNode!
	TH=document.createElement('th');
	if(attributen!=undefined){
		$(TH).attr(attributen); // bijvoorbeeld <th id='profielfoto'></tr>
	}
	if(object!=undefined){
		$(TH).append(object);	
	}
	return TH;
}
function createImg(attributen){
	//data = array met attributen in key : value paren.
	return $(document.createElement('img')).attr(attributen); // bijvoorbeeld <img  src='image/Man.png'/>
}
function createLink(object,attributen){
	//data = array met attributen in key : value paren.
	//object moet ook een echt object zijn, bijvoorbeeld textNode!
	LINK=document.createElement('a');
	if(attributen!=undefined){
		$(LINK).attr(attributen); // bijvoorbeeld <th id='profielfoto'></tr>
	}
	if(object!=undefined){
		$(LINK).append(object);	
	}
	return LINK;
}

/* Het idee is steeds vanuit de kleinste object uit te werken 
 * en dat object toe te voegen aan de createTR/TH/Link functie
 */
function createTable($data){

	var Type=$data['Persoonlijkheidstype']; // aanpassen nog!
	var Tabel=document.createElement('table'); // geeft <tabel></tabel>
	
	//een moeder TR voor alle TR en TH's binnen de eerste TR
	var TR_parent=createTR(undefined,{
										'id'	:	'Profielfoto'
										}); // <tr id='Profielfoto'></tr>
		
	//eerst maken de img klaar.
	var Foto=createImg({
			'src': $data['Foto'],
			'alt': $data['Bijnaam']
			});
	var Profielfoto=createLink(Foto,{
									'href':'Profielfoto/unique/'+$data['Bijnaam']
									});
	var TH=createTH(Profielfoto,undefined); // <th>$profielfoto</th>
	$(TR_parent).append(TH); // <tr id='Profielfoto>$TH</tr>
	
	// De tweede TH aanmaken voor toevoeging van 3 TRs
	TH=createTH(undefined,undefined); // <th></th>
	
	//Eerst de Bijnaam toevoegen
	var TH_inside=createTH(document.createTextNode($data['Bijnaam']),undefined);
	var TR_inside=createTR(TH_inside,undefined); // <tr><th>$bijnaam</th></tr>
	$(TH).append(TR_inside);
	
	//Het geslacht toevoegen
	TH_inside=createTH(document.createTextNode($data['Geslacht']),undefined);
	TR_inside=createTR(TH_inside,undefined); // <tr><th>$geslacht</th></tr>
	$(TH).append(TR_inside);
	
	//Leeftijd toevoegen
	TH_inside=createTH(document.createTextNode($data['Leeftijd']),undefined);
	TR_inside=createTR(TH_inside,undefined); // <tr><th>$leeftijd</th></tr>
	$(TH).append(TR_inside);
	
	//De tweede TH is gereed voor toevoeging aan de TRparent
	$(TR_parent).append(TH);
	//Nu de eerste TR_parent af is... toevoegen aan Tabel
	$(Tabel).append(TR_parent);
	
	//De eerste TR is nu af!
	
	//Beschrijving
	TR_parent=createTR(undefined,undefined);
		TH=createTH(document.createTextNode("Beschrijving:"),undefined);
		$(TR_parent).append(TH);
		TH=createTH(document.createTextNode($data['Beschrijving']),undefined);
		$(TR_parent).append(TH);
	$(Tabel).append(TR_parent);
	
	//Persoonlijkheidstype
	TR_parent=createTR(undefined,undefined);
		TH=createTH(document.createTextNode("Type:"),undefined);
		$(TR_parent).append(TH);
		TH=createTH(document.createTextNode(Type),undefined);
		$(TR_parent).append(TH);
	$(Tabel).append(TR_parent);

	//Beschrijving
	
	var Merken="";
	$.ajax({
		url: 'Profile/brand/'+$data['Bijnaam'],
		type: 'GET', 
		dataType: 'xml',
	    success: function(returnedXMLResponse){
	    	$('user', returnedXMLResponse).each(function(){
	    		var Merk = $('Merk',this).text();
	    		$(Merken).append("<span class='merk'>"+Merk+"</span>"); // hierdoor ontstaat een opsomming van bijvoorbeeld <span class"merk">Coca-Cola</span>
	            	  })
	    	}
		});

	TR_parent=createTR(undefined,undefined);
		TH=createTH(document.createTextNode("Merken:"),undefined);
		$(TR_parent).append(TH);
		TH=createTH(document.createTextNode(Merken),undefined);
		$(TR_parent).append(TH);
	$(Tabel).append(TR_parent);
return Tabel;
}