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
?>