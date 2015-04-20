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
			$this->form_validation->set_rules('D','Afstandmaat','required');
			$this->form_validation->set_rules('X','XFactor','required');
			$this->form_validation->set_rules('A','Alfawaarde','required');
			
			if($this->form_validation->run()==TRUE){ // als er geen correcte validatie heeft plaatsgevonden.
				//Hier kunnen we alles gaan updaten!
				$this->db->empty_table('Persoonlijkheid');
				$this->db->insert('Persoonlijkheid',array(
													'Afstandmaat' 	=> set_value('D'),
													'XFactor'		=> (set_value('X')/10),
													'Alfa'			=> (set_value('A')/10)
												));	
			}
			$this->view('admin',$this->matching->get_admin());
		}
	}
}
?>