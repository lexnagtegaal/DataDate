/*?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Header extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('credentials');

	}
	public function index(){
		
			if($this->credentials->check_credentials()){
				$this->load->view('templates/headerlogin',NULL); // laadt de defaultpagina voor gebruikers.
			}else{
				$this->load->view('templates/header',NULL); // laadt de defaultpagina voor anonieme gebruikers
			}
		}
	}
?>*/