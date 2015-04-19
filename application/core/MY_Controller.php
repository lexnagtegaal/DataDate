<?php
/* start of php file */
class MY_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	//de functie voor het laden van een pagina
	
	function view($page,$data){
	
		if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){
			// Whoops, we don't have a page for that!
			show_404();
		}
	
		$data['title'] = ucfirst($page); // Capitalize the first letter
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer',$data);
	
	}
}
?>