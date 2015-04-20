<?php
/* start of php file */
class MY_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('credentials');
	}
	//de functie voor het laden van een pagina
	
	function view($page,$data){
	
		$data['title'] = ucfirst($page); // Capitalize the first letter
		if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){
			// Whoops, we don't have a page for that!
			show_404();
		}
		else{
	
		
		
		if($this->credentials->check_credentials()){
			$this->load->view('templates/headerlogin', $data); // laadt de defaultpagina voor gebruikers.
		}else{
			$this->load-> view('templates/header', $data); // laadt de defaultpagina voor anonieme gebruikers
		}
		
		$this->load->view('pages/'.$page, $data);
	
		$this->load->view('templates/footer',$data);
			
		}
	
	}
}
?>