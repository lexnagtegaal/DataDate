<?php
// Default controller voor default pagina.

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('credentials');
	}
	public function index(){
		if($this->credentials->check_credentials()){
			$this->view('loginhome',NULL); // laadt de defaultpagina voor gebruikers.
		}else{
			$this->view('home',NULL); // laadt de defaultpagina voor anonieme gebruikers
		}
	}

}
?>