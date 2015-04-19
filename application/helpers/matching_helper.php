<?php
//$X en $Y zijn array's met merken.

function union_value($X,$Y){ // Geeft een array met alle merken
	return array_unique(array_push($X,$Y));
	}

function intersect_value($X,$Y){ // Geeft een array met overeenkomstige merken
	 $count = array_count_values(array_push($X,$Y));
	 $intersect=array();
	 foreach($count as $key => $value){
	 	if($value>1){ // als de waarde meer dan 1 x voorkomt
	 		array_push($intersect,$key); // dan is dit een intersectwaarde
	 	}
	 }
	 return $intersect;
}

function intersect_sum($X,$Y){ // Geeft een integer van het aantal merken dat overeenkomt
	return count(intersect_value($X,$Y));
}

function union_sum($X,$Y){ // Geeft een integer van het totaal aantal merken
	return count(union_value($X,$Y));
}
function small_sum($X,$Y){ // Geeft het minimun aantal aan van de verzameling met de kleinste aantal merken
	return 	min	( array(
					count($X),
					count($Y)
					)
				);
}
function dice($X,$Y){ // optie D1 voor admin

	return 	(1-	(
					( 2 * 
							intersect_sum($X,$Y) )/
					( count($X) +
							count($Y)
					)
				)
		  	);
}
function jacard($X,$Y){ // optie D2 voor admin
	return 	( 1-	(
					( intersect_sum($X,$Y) )/
					( union_sum($X,$Y) )
				)
			);
}
function cosine($X,$Y){ // optie D3 voor admin
	return 	(1-	(
					( intersect_sum($X,$Y) )/
					( sqrt($X)*
							sqrt($Y) )
				)
			);
}
function overlap($X,$Y){ // optie D4 voor admin
	return	(1-	(
					( intersect_sum($X,$Y) )/
					( small_sum($X,$Y) )
				)
			);
}
function values($type){ // Gaat uit van de format E | N | T | J
	$array=explode("|",$type);
	return array(
			'E'	=>	$array[0],
			'N'	=>	$array[1],
			'T'	=>	$array[2],
			'J'	=>	$array[3],
			'I'	=>	100-$array[0],
			'S'	=>	100-$array[1],
			'F'	=>	100-$array[2],
			'P'	=>	100-$array[3]
		);	 // lange leve php die "50" automatisch kan zien als een 50.
}

function type($voorkeur,$type){
	// Format opgeslagen in E | N | T | J (ongeacht de sterkte
	$Has=values($type);	// de gebruiker heeft/has dit
	$Wants=values($voorkeur); // en wilt/wants dit
	return 	( 	
				(	
					$Has['E']-$Wants['E']+
					$Has['N']-$Wants['N']+
					$Has['T']-$Wants['T']+
					$Has['J']-$Wants['J']
				)/
				400
			);
}

function leeftijd($date){
	// Controleren of iemand 18 jaar oud is. Standaard formaat is afgedwongen tot MM-DD-YYYY
	$exploded=explode("-",$date);
	$geboortejaar=$exploded[0];
	$Verjaardag = strtotime(str_replace(
			$geboortejaar, 	// bijvoorbeeld 1988
			date('Y'),				// bijvoorbeeld 2015
			$date					// bijvoorbeeld 11/10/1988 -> 11/10/2015
	));
	$Leeftijd = date('Y')-$geboortejaar;		// bijvoorbeeld 2015-1988 -> 27
	
	if(strtotime("now")-$Verjaardag < 0){
		$Leeftijd--;	// nog geen verjaardag gehad// Resultaat 26!
	}
	return $Leeftijd;
}
?>