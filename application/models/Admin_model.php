<?php
class Admin_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->model('credentials');
	}
	public function check_admin(){
		if($this->credentials->check_credentials()){
			$this->load->database();
			$this->load->library('session');
			$this->db->select('Rechten');
			$this->db->from('Gebruiker');
			$this->db->where('Bijnaam',$this->session->userdata('username'));
			$this->db->where('Rechten','Admin');
			$query=$this->db->get();
			if($query->num_rows()>0){
				Return TRUE; //Er is een admin gevonden!
			}else{
				Return FALSE; //Er is geen admin gevonden :(
			}
		}
		
	}
}
?>