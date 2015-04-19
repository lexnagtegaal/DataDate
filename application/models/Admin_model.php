<?php
class Admin_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->model('credentials');
	}
	public function check_admin(){
		if($this->credentials->check_credentials()){
			$this->load->database();
			$this->load->session();
			$this->db->select('Rechten');
			$this->db->where('Bijnaam',$this->session->userdata('username'));
			$this->db->where('Rechten','admin');
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