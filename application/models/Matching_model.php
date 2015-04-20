<?php
class Matching_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('matching');
		$this->load->database();
		$this->load->library('session');
	}
	public function get_brands($user){
		$this->db->select('Merk');
		$this->db->from('Merk');
		$this->db->where('Bijnaam',$user);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row_array(); // Geeft elke Bijnaam die een Like aan jou gaf.
		}else{
			return array();
		}
	}

	public function get_likes($user){
		$this->db->select('Bijnaam');
		$this->db->from('Likes');
		$this->db->where('Likes',$user);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row_array(); // Geeft elke Bijnaam die een Like aan jou gaf.
		}else{
			return array();
		}
	}
	
	public function get_admin(){
		//Krijg de waarde van de tabel Persoonlijkheid
		$this->db->select('*');
		$this->db->from('Persoonlijkheid');
		$query=$this->db->get(); // SELECT 'Persoonlijkheidstype' FROM Gebruikersprofiel WHERE 'Bijnaam'=$other;
		$admin=$query->row_array();
		return $admin;
	}
	public function get_user($user){
		//Krijg de data van de $user
		$this->db->select('*');
		$this->db->from('Gebruikersprofiel');
		$this->db->where('Bijnaam',$user);
		$query=$this->db->get(); // SELECT '*' FROM Gebruikersprofiel WHERE 'Bijnaam'=$user;
		if($query->num_rows()>0){
			return $query->row_array();
		}
		return FALSE;
		
	}
	public function match($other){
		$user=$this->session->userdata('username'); // $user is gebruiker, $other is degene met wie vergeleken wordt.
		
		$Gebruiker=$this->get_user($user);
		$Ander=$this->get_user($user);
	
		//Krijg alle merken van $user als $X en $other als $y
		$X = $this->get_brands($user);
		$Y = $this->get_brands($other);
		
		if(
			strpos(
					$Ander['Geslacht'],
					$Gebruiker['Geslachtsvoorkeur']
					)!==false &&
			$Gebruiker['Minimumleeftijd']	<=	leeftijd( $Ander['Geboortedatum'] ) &&
			$Gebruiker['Maximumleeftijd']	>=	leeftijd( $Ander['Geboortedatum'] )
			){
				$distance=	max (	array(
										type($Gebruiker['Persoonlijksheidvoorkeur'],$Ander['Persoonlijkheidstype']),
										type($Ander['Persoonlijksheidvoorkeur'],$Gebruiker['Persoonlijkheidstype'])
									)
								);
				
				$ADMIN = get_admin(); // Krijg de Xfactor Afstandsmaat en Alfa in array terug.
				
				switch ($ADMIN['Afstandsmaat']){
					case "D2": // D1 gaat gelijk met Default
						$brands=jacard($X,$Y);
						break;
					case "D3":
						$brands=cosine($X,$Y);
						break;
					case "D4":
						$brands=overlap($X,$Y);
						break;
					default:
						$brands=dice($X,$Y);
						break;
				}
				
				return 	(
							(
									$ADMIN['Xfactor']*
									$distance )+
							(
									( 1-$ADMIN['Xfactor'] )*
									$brands )
						);
		}else{
			return FALSE; // Er is geen leeftijd en geslachts(Voorkeur) overeenkomst!
		}
		
	}
	public function is_match($other){
		$user=$this->session->userdata('username');
		if($user==$other){
			return FALSE;
		}else{
			$user_likes=$this->get_likes($user);
			$other_likes=$this->get_likes($other);
				return(in_array($other,$user_likes) && in_array($user,$other_likes)); // als de user voorkomt in het lijstje van de likes van de ander en vice versa
		}
	}
	
	public function like($other){
		$user=$this->session->userdata('username');
		$ADMIN=$this->get_admin();
		$Gebruiker=$this->get_user($user);
		$Ander=$this->get_user($other);
		$New_Voorkeur=Like($Gebruiker['Persoonlijksheidvoorkeur'],$Ander['Persoonlijkheidstype'],$ADMIN['Alfa']);
		$this->db->update('Persoonlijksheidvoorkeur',$New_Voorkeur);
		$this->db->where('Bijnaam',$user);
		$this->db->get();
	}
}
?>
