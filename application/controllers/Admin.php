<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model','admin');
		$this->load->library('form_validation');
		$this->load->model('matching_model','matching');
		$this->load->helper('html');
	}
	public function index(){
		if(!$this->admin->check_admin()){
			redirect("Home");
		}else{
			
			//form_validation regels hier
			
			
			if($this->form_validation->run()==FALSE){ // als er geen correcte validatie heeft plaatsgevonden.
				$this->view('register',$this->matching->get_admin());
			}else{
				//Hier kunnen we alles gaan updaten!
			}
		}
	}
}
?>