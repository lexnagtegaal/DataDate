<?php
// Default controller voor default pagina.

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('credentials');
		$this->load->helper('form');
		$this->load->library('form_validation'); // voor de input validatie van het login formulier
		$this->load->helper('regex');
	}
	public function index(){
		if($this->credentials->check_credentials()){
			$this->view('loginhome',NULL); //Ingelogde mensen kunnen niet nog een keer inloggen uiteraard
		}else{
			//validatieregels voor het inlogformulier
			$this->form_validation->set_rules('email', 'E-mailadres', 'trim|required|callback_check_DB['.md5(set_value('password')).']');
			$this->form_validation->set_rules('password', 'Wachtwoord', 'trim|required');
		
			if($this->form_validation->run()==TRUE){ // als er een correcte validatie heeft plaatsgevonden.
				$this->view('loginhome',NULL); // laadt de defaultpagina.
			}else{
				$this->view('login',NULL);
			}
		}
	}
	function check_DB($email,$password){
		//password is als md5 hash al meegestuurd.
	
		$this->load->library('session');
		$error='Deze combinatie van E-mailadres en wacthwoord is ons niet bekend.';
		if(!(NULL!==$this->session->tempdata['Geblokt'])){ //Pas toegang tot de database totdat de geblokte gebruiker geweerd is.
			
			//opbouw van de query'
			$this->db->select('Bijnaam');
			$this->db->from('Gebruiker');
			$this->db->where('Email',strtolower($email));
			$this->db->where('Wachtwoord',$password);
			$query=$this->db->get();// SELECT 'Bijnaam' from Gebruiker where 'Email'=$email and 'Wachtwoord'=$password;
			
			//Query analyseren
			if ($query->num_rows() > 0){
				//Er is een resultaat! :D
				$row = $query->row();
				$this->session->set_userdata(array(
						'login'		=>	TRUE,
						'username'	=>	$row->Bijnaam
				));
				return TRUE;
			}else{
				$this->form_validation->set_message('check_DB', $error);
				return FALSE;
			}
		}else{ // De geblokte gebruiker krijgt dezelfde foutmelding. We gaan hem niet alarmeren dat hij tijdelijk geen toegang heeft.
			$this->form_validation->set_message('check_DB', $error);
			return FALSE;
		}
	}
	function loguit(){
		// Uitloggen en de login pagina weer weergeven.
		$this->load->library('session');
		$this->session->sess_destroy();
		$this->view('login',NULL);
	}
}
?>