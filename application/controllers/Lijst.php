<?php
header ("Content-Type:application/xml");
// nu zelf ingevuld.
// Mogelijk later vanuit database te laden (En aan te passen!)

defined('BASEPATH') OR exit('No direct script access allowed');

class Lijst extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	}
	public function index(){
		$this->load->view("pages/vragen.xml");
	}
}
?>