<?php
/*model voor het construeren van de volledige html pagina opgebouwd uit 4 views. 
 *  - templates/header
 * 	- pages/$page
 *  - templates/login (als session niet actief is)
 *    of
 *    templates/user (als session wel actief is)
 *  - templates/footer
 */ 

class Pages extends CI_Model {

	public function __construct(){
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