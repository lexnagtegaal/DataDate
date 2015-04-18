<?php
// Default controller voor default pagina.

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('credentials');
	}
	public function index(){
		$this->view('home',NULL); // laadt de defaultpagina.
	}

}
?>