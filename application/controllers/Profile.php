<?php
/* Controller voor het tonen van profielpagina
 * Deze is bedoeld met ajaxcalls op te roepen
 * Het resultaat is in xlm output.
 * Dit is handig met de voorgedefinieerde library van code igniter.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->dbutil(); 
		// laadt de database utility class waarmee querys in xml output getoond kunnen worden voor de ajax calls
	}
	public function index($username){ // bijvoorbeeld: 'Profile/index/lex'
		// genereert een enkele specifiek profielspagina op basis van username in een xml output.
		
		$this->db->select('*');
		$this->db->from('Gebruikersprofiel');
		$this->db->where('Bijnaam',$username);
		$this->db->limit(1);
		$this->show($this->db->$get()); // SELECT * FROM GEBRUIKERSPROFIEL WHERE BIJNAAM=$USERNAME LIMIT 1;
	}
	
	public function random(){ // 'Profile/random'
		// Genereert 6 willekeurige profielen uit de databases in een xml output.
		
		$this->db->select('*');
		$this->db->from('Gebruikersprofiel');
		$this->db->order_by(6,'RANDOM');
		$this->db->limit(6);
		$this->show($this->db->get()); // SELECT * FROM GEBRUIKERSPROFIEL ORDER BY RANDOM(6) LIMIT 6;
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
	
	public function show($query){
		$config = array (
				'root'          => 'root',
				'element'       => 'element',
				'newline'       => "\n",
				'tab'           => "\t"
		);
		echo $this->dbutil->xml_from_result($query, $config);
	}
}
?>