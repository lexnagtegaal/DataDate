<?php
class Test_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		$this->load->model('credentials');
	}
	
	public function status(){
		if($this->credentials->check_credentials()||NULL!==$this->session->flashdata('new_user')){ // Als het iemand is die (Terecht) is ingelogd of een nieuwe gebruiker!
		

			$user=$this->get_user();
			/* We gaan op zoek naar de Persoonlijkheidstype
			 * Omdat een nieuw lid halverwege het aanmeldproces eruitgegaan is, om het even welke reden.
			 * Moet die wel de kans dit later alsnog in te vullen.
			 * We controleren dus of de Persoonlijkheidstype een waarde heeft
			 */
			$this->db->select('Persoonlijkheidstype');
			$this->db->from('Gebruikersprofiel');
			$this->db->where('Bijnaam',$user); // SELECT 'Persoonlijkheidstype' FROM Gebruikersprofiel WHER 'Bijnaam'=$user;
			$this->db->where('Persoonlijkheidstype','Nieuw');
			$query=$this->db->get();
			$row = $query->row();
			if ($query->num_rows() > 0){
				//er is een match, dus een leeg persoonlijkheidstype
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}
	
	public function get_user(){
		//de juiste gebruiker opzoeken in deze stap.
		if(NULL!==$this->session->flashdata('new_user')){
			return $this->session->flashdata('new_user');
		}else{
			return $this->session->userdata('username');
		}
	}
}
?>