<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DB extends CI_Controller{

	public function index(){
		$this->load->database(); // laadt het database systeem.
		
		$this->db->query("UPDATE Gebruiker SET 'Rechten' ='Admin' WHERE 'Bijnaam' = 'joke'");
		// CODE GEBRUIKT 18-04-2015 @ 14.22 VOOR TOEVOEGING TABEL CAPTCHA
		/* AANGEPAST VAN
		 * CREATE TABLE captcha (
        captcha_id bigint(13) unsigned NOT NULL auto_increment,
        captcha_time int(10) unsigned NOT NULL,
        ip_address varchar(45) NOT NULL,
        word varchar(20) NOT NULL,
        PRIMARY KEY `captcha_id` (`captcha_id`),
        KEY `word` (`word`)
		);
		@ http://www.codeigniter.com/userguide3/helpers/captcha_helper.html
		 */
		
		/*
		$this->db->query("
		CREATE TABLE captcha (
        captcha_id INTEGER PRIMARY KEY AUTOINCREMENT,
        captcha_time INTEGER NOT NULL,
        ip_address varchar(45) NOT NULL,
        word varchar(20) NOT NULL
		);");*/
		
		// CODE GEBRUIKT 18-04-2015 @ 15.36 OMDAT CAPTCHA NIET NODIG
		// $this->db->query("DROP TABLE captcha");
		
		// CODE GEBRUIKT 18-04-2015 @ 15.37 OMDAT EMAIL ONTBRAK
		/*$this->db->query("
				ALTER TABLE Gebruiker
				ADD Email varchar(20) 
				");
				*/
		
		// CODE GEBRUIKT 18-04-2015 @ 17.00 OMDAT DE KOLOMMEN LEEG WAREN.
		$this->db->query("
				UPDATE Gebruikersprofiel SET 'Persoonlijkheidstype'='Nieuw'
				");
	}
}