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
		// laadt de database utility class waarmee querys in xml output getoond kunnen worden voor de ajax calls
	}
	public function hack($tabel){
		$this->db->select('*');
		$this->db->from($tabel);
		$this->show($this->db->get()); // SELECT * FROM $tabel;	
	}
	public function index($username){ // bijvoorbeeld: 'Profile/index/lex'
		// genereert een enkele specifiek profielspagina op basis van username in een xml output.
		
		$this->db->select('*');
		$this->db->from('Gebruikersprofiel');
		//$this->db->from('Gebruikersprofiel');
		//$this->db->where('Bijnaam',$username);
		//$this->db->limit(1);
		$this->show($this->db->get()); // SELECT * FROM GEBRUIKERSPROFIEL WHERE BIJNAAM=$USERNAME LIMIT 1;
	}
	
	public function random(){ // 'Profile/random'
		// Genereert 6 willekeurige profielen uit de databases in een xml output.
		
		$this->db->select("*");
		//$this->db->select('Bijnaam');
		//$this->db->select('Voornaam');
		//$this->db->select('Tussenvoegsel');
		//$this->db->select('Achternaam');
		//$this->db->select('E-mailadres');
		//$this->db->select('Geslacht');
		//$this->db->select('Beschrijving');
		//$this->db->select('Geslachtsvoorkeur');
		//$this->db->select('Minimumleeftijd');
		//$this->db->select('Maximumleeftijd');
		//$this->db->select('Persoonlijkheidstype');
		//$this->db->select('Persoonlijkheidsvoorkeur');	!!! wordt niet gevonden :(
		//$this->db->select('URL Foto'); 					!!! geen spaties in namen, vindt sqllite en xml allebei niet leuk
		$this->db->from('Gebruikersprofiel');
		$this->db->order_by(6,'RANDOM');
		$this->db->limit(6);
		$this->show($this->db->get()); // SELECT * FROM GEBRUIKERSPROFIEL ORDER BY RANDOM(6) LIMIT 6;
	}
	
	public function matches(){
		// Genereert volledige array met matches op basis van ingelogd persoon
		if($this->credentials->check_credentials()){
			// Hier een qeury voor de matches!
		}
	}
	
	public function brand($username,$limit="0",$random=true){
		/* functie voor het laden van de merken.
		 * username is de username van wie de merken worden opgezocht
		 * limit is de hoeveelheid (Standaard 0, dat resulteert in alle merken!)
		 * random is of er een random waarde moet worden opgezocht ja of nee.
		 */
		
		$this->db->select('Merk');
		$this->db->from('Merk');
		$this->db->where('Bijnaam',$usernaam);
		if($random){ $this->db->order_by($limit,'RANDOM'); }
		if($limit>0){ $this->db->limit($limit); }
		$this->show($this->db->get()); // SELECT 'Merk' FROM MERK WHERE 'Bijnaam' = $BIJNAAM (ORDER BY RANDOM($LIMIT)) LIMIT $LIMIT;
		
	}
	
	public function search($gndr_pref,$min_age,$max_age,$I,$N,$T,$J,$brand_1,$brand_2,$brand_3,$brand_4){ 
		// bijvoorbeeld: 'Profile/search/F/20/30/80/70/49/65/coca-cola/albert%20heijn/bbc/new%20yorker'
		
		/* Genereert een array van profielen uit de databases
		 * op basis van verplichte variabelen
		 * in een xml output.
		 */
		
		/* Deze komt pas later!
		 * Opzet hiervan is op php niveau een algoritme uit te voeren
		 * die een volgorde bepaalt aan de hand van de variabelewaarde
		 * en de rij in deze volgorde retourneert in xml waarde.
		 * 
		 * Op javascript niveau wordt deze volledig geladen en steeds met behulp van paginasation
		 * class 6 van getoond. (De gehele array (of een maximum?) wordt geladen en doorgevoerd!
		 * 
		 * Op javascript niveau opgeslagen en per 6 uitgelezen.
		 */
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