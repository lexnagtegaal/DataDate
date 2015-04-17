<?php
// Default controller voor default pagina.

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
	
	public function index(){
		
		$this->pages->view('home',NULL); // laadt de defaultpagina.
	}

}
?>