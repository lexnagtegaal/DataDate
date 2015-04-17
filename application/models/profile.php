<?php
class Profile extends CI_Model {

	public function __construct(){
		$this->load->database();
		}
		
	public function get_profile($bijnaam,$total = 1){
		$this->$db->$select('*');
		$this->$db->$from('Gebruikersprofiel');
		if($bijnaam!=NULL){
			$this->$db->$where('Bijnaam',$bijnaam);
			}
		$query=$this->$db->$get();
		// SELECT * FROM GEBRUIKERSPROFIEL (where Bijnaam=$bijnaam);
		if($bijnaam!=NULL){
				if($query==NULL){
					return FALSE; // niks gevonden!
				}
				return $query;
			}
		$keys = array_keys($query); 
		shuffle($keys); // SHUFFLE DE KEYS
		$random=array(); // Maak ruimte voor het maken van de uiteindelijke array die we terugsturen.
		$i=0;
		foreach($keys as $key){ // we bouwen de nieuwe array op, op basis van de willekeurige key volgorder
			$random[$key] = $query[$key];
			$i++;
			if($i==$total){ // als we het aantal hebben bereikt dat aangegeven is.
				return $random;
				}
			}
		if($random==NULL){
			return FALSE; // niks gevonden!
			}
		return $random; // als het aantal niet bereikt is, bij bijvoorbeeld een negatief getal of een groter getal dan de datbase in voorraad heeft.
		}
	}