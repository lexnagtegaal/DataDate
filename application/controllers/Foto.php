<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foto extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('foto_model','foto');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('html');
	}
	
	public function index(){
		$data=[];
		$data=$this->foto->enter($data);
		if($data!==FALSE){
			$this->view('foto',$data);
		}
	}
	
	public function upload(){

		$data=$this->foto->enter();
		if($data!==FALSE){
			$config['upload_path']          = './image/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 20000000;
			$config['overwrite']			= TRUE;
			$config['file_name']			= $data['user'].".png";
				
			$this->load->library('upload', $config);
			if (! $this->upload->do_upload())
			{
				$this->view('foto',$data); // het daadwerkelijke formulier!
			}
			else
			{
				$data['foto']="image/".($this->upload->data()['file_name']); // overwrites de oude $Data['foto'] waarde vanuit enter();
				$this->foto->update_picture($data);
				if(NULL!==$this->session->flashdata('new_user')){ // We hebben een nieuwe gebruiker, dus naar de testpagina!
					$this->view('test',NULL);
				}else{
					$this->view('foto',$data); // het daadwerkelijke formulier!
				}
				
			}
		}
	}
}