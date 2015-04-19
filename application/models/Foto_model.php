<?php
class Foto_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('credentials');
		$this->load->library('session');
	}

	public function enter(){
		if($this->credentials->check_credentials()||NULL!==$this->session->flashdata('new_user')){ // Als het iemand is die (Terecht) is ingelogd of een nieuwe gebruiker!
			//data preparen voor view
			if(NULL!==$this->session->flashdata('new_user')){
				$this->session->keep_flashdata('new_user'); //zowel bij een foutmelding, als de volgende stap van het aanmelden hebben we deze nog nodig!
				$data['user']=$this->session->flashdata('new_user');
			}else{
				$data['user']=$this->session->userdata('username');
			}
			$this->db->select('Foto');
			$this->db->from('Gebruikersprofiel');
			$this->db->where('Bijnaam',$data['user']);
			$query=$this->db->get();// SELECT 'Foto' from Gebruikersprofiel where 'Bijnaam'=$data['user'];
			$row = $query->row();
			$data['foto']=$row->Foto;
			return $data;
		}else{ // haters voor deze pagina!
			header('Location: '.base_url("home")); // terug naar start voor zij die geen toegang hebben!
			exit;
			return FALSE;
		}
	}
	
	public function update_picture($data){
		$update=array(
				'Foto'	=> $data['foto']
		);
		$this->db->where('Bijnaam',$data['user']);
		$this->db->update('Gebruikersprofiel',$update); // UPDATE Gebruikersprofiel SET Foto=$foto where Bijnaam=$bijnaam;
	}
}
?>