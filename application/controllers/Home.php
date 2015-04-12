<?php
// Default controller voor default pagina.

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller{
	
	public function index(){
		
		$this->load->library('form_validation'); // voor de input validatie van het login formulier

		// als mensen niet ingelogd zijn, is de home pagina de enige zichtbare pagina met login formulier.
		
		$this->load->model('pages');	//voor de functie view in te laden.
		
		//validatieregels voor het inlogformulier
		$this->form_validation->set_rules('email', 'E-mailadres', 'trim|required');
		$this->form_validation->set_rules('password', 'Wachtwoord', 'trim|required|md5');
		/* Technisch gezien wordt required al afgedwongen via html5 tags en de controle van form.js
		 * Echter is het onlogisch om nu te 'stellen' dat deze niet verplicht zouden zijn.
		 * Daarom blijft de required regel staan.
		 * Daarnaast wordt de inhoud getrimd
		 * en het wachtwoord omgezet in een md5 hash indien succesvol.
		 */

		if($this->form_validation->run()==TRUE){ // als er een correcte validatie heeft plaatsgevonden.

			/* deze controle functie binnen de validation, omdat anders ook incorrecte validatie naar deze functie geroepen zou worden.
			 * zo wordt er alleen gevalideerde input gezonden naar de functie.
			 */
			
			$email = set_value('email'); // om mee te zenden met de login functie
			$password = set_value('password');
			// het wachtwoord is al omgezet in MD5 hash.
			
			$this->load->model('login');	//voor controle of in te loggen mogelijk is.
			$this->login->login($email,$password); 
		}
		
		$this->pages->view(); // laadt de defaultpagina.
	}

}
?>