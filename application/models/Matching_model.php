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
		$row=$query->row();
		$result=array();
		foreach($row as $key => $value){
			array_push($result,$value);
		}
		return $result;
	}
	
	public function get_admin(){
		//Krijg de waarde van de tabel Persoonlijkheid
		$this->db->select('*');
		$this->db->from('Persoonlijkheid');
		$query=$this->db->get(); // SELECT 'Persoonlijkheidstype' FROM Gebruikersprofiel WHERE 'Bijnaam'=$other;
		$admin['Alfa']=$query->row()->Alfa;
		$admin['Afstandsmaat']=$query->row()->Afstandsmaat;
		$admin['Xfactor']=$query->row()->Xfactor;
		return $admin;
	}
	public function match($other){
		$user=$this->session->userdata('username'); // $user is gebruiker, $other is degene met wie vergeleken wordt.
		
		//Krijg de data van de $user
		$this->db->select('*');
		$this->db->from('Gebruikersprofiel');
		$this->db->where('Bijnaam',$user);
		$Gebruiker=$this->db->get(); // SELECT '*' FROM Gebruikersprofiel WHERE 'Bijnaam'=$user;
		
		//Krijg de data van de $other
		$this->db->select('*');
		$this->db->from('Gebruikersprofiel');
		$this->db->where('Bijnaam',$other);
		$Ander=$this->db->get(); // SELECT '*' FROM Gebruikersprofiel WHERE 'Bijnaam'=$other;
		
		//Krijg alle merken van $user als $X en $other als $y
		$X = get_brands($user);
		$Y = get_brands($other);
		
		if(
			strpos(
					$Ander['Geslacht'],
					$Gebruiker['Geslachtsvoorkeur']
					)!==false &&
			$Gebruiker['Minimumleeftijd']	<=	$this->matching->leeftijd( $Ander['Geboortedatum'] ) &&
			$Gebruiker['Maximumleeftijd']	>=	$this->matching->leeftijd( $Ander['Geboortedatum'] )
			){
				$distance=	max (	array(
										$this->matching->type($Gebruiker['Persoonlijksheidvoorkeur'],$Ander['Persoonlijkheidstype']),
										$this->matching->type($Ander['Persoonlijksheidvoorkeur'],$Gebruiker['Persoonlijkheidstype'])
									)
								);
				
				$ADMIN = get_admin(); // Krijg de Xfactor Afstandsmaat en Alfa in array terug.
				
				switch ($ADMIN['Afstandsmaat']){
					case "D2": // D1 gaat gelijk met Default
						$brands=$this->matching->jacard($X,$Y);
						break;
					case "D3":
						$brands=$this->matching->cosine($X,$Y);
						break;
					case "D4":
						$brands=$this->matching->overlap($X,$Y);
						break;
					default:
						$brands=$this->matching->dice($X,$Y);
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
	
	public function like($other){
		
	}
}
?>
