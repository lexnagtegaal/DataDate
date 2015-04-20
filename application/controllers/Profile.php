<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->dbutil();
		$this->load->model('credentials');
		$this->load->model('matching_model','matching');
		$this->load->helper('form');
		$this->load->helper('merken');
		$this->load->helper('rndm');
		$this->load->helper('regex');
		$this->load->library('form_validation');
		$this->load->library('session');
		// laadt de database utility class waarmee querys in xml output getoond kunnen worden voor de ajax calls
	}
	public function hack($tabel){ // Voor ontwikkelingsfase en nakijk redenen laten staan. Is uiteraard hackgevoelig. Maar handig middel.
		$this->db->select('*');
		$this->db->from($tabel);
		$this->show($this->db->get()); // SELECT * FROM $tabel;	
	}
	
	public function random(){ // 'Profile/random'
		// Genereert 6 willekeurige profielen uit de databases in een xml output.
		$this->show($this->db->query("SELECT * FROM GEBRUIKERSPROFIEL ORDER BY RANDOM() LIMIT 6;"));
	}
	
	public function matches(){
		// Genereert volledige array met matches op basis van ingelogd persoon
		if($this->credentials->check_credentials()){
			// Hier een qeury voor de matches!
			$this->db->select('*');
			$this->db->from('Gebruikersprofiel');
			$query=$this->db->get(); // SELECT * FROM $tabel;
			
			//Testresultaten opmaken met behulp van de match functie binnen matching_model.
			$resulaten=array();
			foreach($query->result() as $row){
				if($row->Bijnaam!==$this->session->userdata('username')){
					$resultaten[$row->Bijnaam]=$this->matching->match($row->Bijnaam);
				}
			
			//Nu de 6 resultaten weer op zoeken.
			$best_six=array();
			for($i=0;$i<5;$i++){
				if(count($resultaten)>0){
						$temp=max(array_keys($resultaten)); // de hoogste waarde
						array_push($best_six,$temp); // best six ophogen
						unset($resultaten[$temp]);
					}
				}
			}
			//Nu de beste 6 weergeven in xml formaat.
			if(count($best_six)>0){
				$this->db->limit(6);
				$this->show($this->db->get_where('Gebruikersprofiel', $best_six));
			}
		}
	}
	
	public function unique($username="username"){
		
		if(!($this->matching->get_user($username))){ // haalt met behulp van matching_model.php alle data op van de profielweergave)){
			redirect("home");
		}else{
			
			$this->form_validation->set_rules('email', 'E-mailadres', 'trim|required|callback_email_check');
			$this->form_validation->set_rules('FirstName','Voornaam', 'trim|required');
			$this->form_validation->set_rules('LastName','Achternaam', 'trim|required');
			$this->form_validation->set_rules('Beschrijving','Beschrijving','required');
			$this->form_validation->set_rules('Voorkeur[]','Interresse','required');
			$this->form_validation->set_rules('min','Mimimumleeftijd','required|callback_minimaxi_check['.set_value('max').']');
			$this->form_validation->set_rules('max','Maximumleeftijd','required');
			if($this->form_validation->run()==TRUE){
				$updaten = array(
						'Voornaam'			=> strtolower(set_value('FirstName')),
						'Tussenvoegsel'		=> strtolower(set_value('MiddleName')),
						'Achternaam'		=> strtolower(set_value('LastName')),
						'E-mailadres'		=> strtolower(set_value('email')),
						'Beschrijving'		=> set_value('Beschrijving'),
						'Geslachtsvoorkeur'	=> set_value('Voorkeur[0]').set_value('Voorkeur[1])'), // resulteert in ManVrouw.
						'Minimumleeftijd'	=> (set_value('min')+18),
						'Maximumleeftijd' 	=> (set_value('max')+18)
						//'Merken'			=>array(set_value('merken[]'))
				);
				$merk_array=set_value('merken[]');
				$this->db->where('Bijnaam',$this->session->userdata('username'));
				$this->db->update('Gebruikersprofiel',$updaten);
				$this->db->where('Bijnaam',$this->session->userdata('username'));
				$this->db->delete('Merk');
				for($i=0;$i<count($merk_array);$i++){
					$merken= array(
							'Bijnaam'			=> $this->session->userdata('username'),
							'Merk'				=> $merk_array[$i]
					);
					$this->db->insert('Merk',$merken);
				}
			}
			$data=$this->matching->get_user($username); // haalt met behulp van matching_model.php alle data op van de profielweergave
			$data['owner']=($username==$this->session->userdata('username'));
			$data['Merken']=($this->matching->get_brands($this->session->userdata('username')));
			$data['mailadres']=$data['E-mailadres'];
			$data['match']=($this->matching->is_match($username));
			$this->view('profilepage',$data);
				
		}
		
		
	}
	public function show($query){
		header ("Content-Type:application/xml");
		/* Controller voor het tonen van profielpagina
		 * Deze is bedoeld met ajaxcalls op te roepen
		 * Het resultaat is in xlm output.
		 * Dit is handig met de voorgedefinieerde library van code igniter.
		 */
		$config = array (
				'root'          => 'profiles',
				'element'       => 'user',
				'newline'       => "\n",
				'tab'           => "\t"
		);
		echo $this->dbutil->xml_from_result($query, $config);
	}
	
	public function email_check($email)
	{
		// controleert of gebruikersnaam voorkomt in de tabel.
		//opbouw van de query'
		$this->db->select('*');
		$this->db->from('Gebruiker');
		$this->db->where('Email',strtolower($email));
		$query=$this->db->get();// SELECT 'Email' from Gebruiker where 'Email'=$email;
		$result=$query->row_array();
		if ($query->num_rows() > 0 && $result['Bijnaam']!=$this->session->userdata('username')){
			$this->form_validation->set_message('email_check', '{field} bestaat al in de database.');
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	public function minimaxi_check($min,$max){
		if($min>$max){
			$this->form_validation->set_message('minimaxi_check', '{field} moet kleiner zijn dan de maximumleeftijd.');
			return FALSE;
		}else{
			return TRUE;
		}
	}
}
?>