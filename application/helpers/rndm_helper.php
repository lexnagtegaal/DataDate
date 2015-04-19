<?php
function randomize($data){
	$keys = array_keys($data);
	shuffle($keys); // SHUFFLE DE KEYS
	$random=array(); // Maak ruimte voor het maken van de uiteindelijke array die we terugsturen.
	foreach($keys as $key){ // we bouwen de nieuwe array op, op basis van de willekeurige key volgorder
		$random[$key] = $data[$key];
	}
	return $random;
}
?>