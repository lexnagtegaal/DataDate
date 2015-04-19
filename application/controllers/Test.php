<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('html','form','rndm','file');
		$this->load->model('test_model','test');
		$this->load->model('credentials');
	}
	public function index(){
		if($this->test->status()) // Er is geen persoonlijkheisdtype gevonden
		{
			$this->load->helper('rndm');
			//regels voor form_validation
			$this->form_validation->set_rules('vraag[1]', 'Vragen', 'required');
			
			//form_validation
			if($this->form_validation->run()==FALSE){
				
				// we mogen het nog een keer proberen
				$this->load->library('session');
				if(NULL!==$this->session->flashdata('new_user')){
					$this->session->keep_flashdata('new_user'); // we moeten hem nog een ronde bewaren voor de volgende controle
				}
				$this->view('test',NULL);
				
			}else{
				
				//eindelijk een type vast kunnen stellen!
				//Hier code voor berekenen en opslaan van persoonlijkheidstype
				$E=50; //50%
				$I=50; //50%
				$N=50; //50%
				$S=50; //50%
				$T=50; //50%
				$F=50; //50%
				$J=50; //50%
				$P=50; //50%
				for($i=1;$i<=19;$i++){ // Roept alle vragen op
					switch(set_value('vraag['.$i.']')){ // roept de waarde op.
						case "A":
							if($i>=1 && $i<=5){ // De eerst 5 vragen
								echo "vraag ".$i." is A";
								$E=$E+10;
								$I=$I-10;
							}
							if($i>=6 && $i<=9){ // vraag 6 tot en met 9
								echo "vraag ".$i." is A";
								$N=$N+12.5;
								$S=$S-12.5;
							}
							if($i>=10 && $i<=13){ // Vraag 10 tot en met 13
								echo "vraag ".$i." is A";
								$T=$T+12.5;
								$F=$F-12.5;
							}
							if($i>=14 && $i<=19){ // Vraag 14 tot en met 19
								echo "vraag ".$i." is A";
								$J=$J+8.3333;
								$P=$P-8.3333;
							}
							break;

						case "B":
							if($i>=1 && $i<=5){ // De eerst 5 vragen
								echo "vraag ".$i." is B";
								$E=$E-10;
								$I=$I+10;
							}
							if($i>=6 && $i<=9){ // vraag 6 tot en met 9
								echo "vraag ".$i." is B";
								$N=$N-12.5;
								$S=$S+12.5;
							}
							if($i>=10 && $i<=13){ // Vraag 10 tot en met 13
								echo "vraag ".$i." is B";
								$T=$T-12.5;
								$F=$F+12.5;
							}
							if($i>=14 && $i<=19){ // Vraag 14 tot en met 19
								echo "vraag ".$i." is B";
								$J=$J-8.3333;
								$P=$P+8.3333;
							}
							break; // geen Default waarde vereist
						default:
							echo "vraag ".$i." is C";
							break;
					}
					echo "<br/>";
				}
				echo "E=".$E."<br/>";
				echo " I=".$I."<br/>";
				echo " N=".$N."<br/>";
				echo " S=".$S."<br/>";
				echo " T=".$T."<br/>";
				echo " F=".$F."<br/>";
				echo " J=".$J."<br/>";
				echo " P=".$P."<br/>";
				/*
				//Gebruiker begeleiden naar het einde van de tour
				$data['message']="Uw persoonlijkheidstype is aangemaakt."; // voor weergave op home pagina.
				$page="login";
				if($this->credentials->check_credentials()){
					$page="loginhome";
				}
				$this->view($page,$data); // gebruiker
				*/
			}
		}else{
			header('Location: '.base_url("home")); // terug naar start voor zij die geen toegang hebben!
			exit;
		}
	}
}
?>