<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DB extends CI_Controller{

	public function index(){
		$this->load->database(); // laadt het database systeem.
	
		$this->db->query("CREATE TABLE Likes(
							Bijnaam VARCHAR(20),
							Likes VARCHAR(20)
							)");
	}
}