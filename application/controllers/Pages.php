<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller 
{
	public function index()
	{
		$this->view();
	}
	
	public function view($page = 'home'){
		$this->load->library('form_validation');
		$this->load->model('profile');
		$this->load->model('login');
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){
			// Whoops, we don't have a page for that!
			show_404();
        	}
        
        $data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        	 
        if ($this->form_validation->run() == FALSE){
        	$this->load->view('templates/login');
           	}
        	else{
        		$this->load->view('templates/logging');
        	}
		$this->load->view('templates/footer', $data);
		}
	}
?>