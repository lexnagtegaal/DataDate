<div id="inloggen">
<?php
$required = "required"; // extra variabele om toe te kennen dat een input element required is.

echo validation_errors(); // toont PHP server-side errors van het ingevulde formulier.

echo $this->session->flashdata('error'); 
// toont flashdata sessievariabale waar eventuele foutmelding vanuit de function login uit het model login wordt meegegeven.

echo form_open('Home', 'id="login"'); // creert een form die weer terugverwijst naar de controller Home in dit geval.

//Label en Input field voor het emailadres
?>
<p class="error"></p>
<?php
echo form_label('E-mailadres','email');
echo form_input(array(
			        'type'  => 'email',
			        'name'  => 'email',
					'id'	=> 'email',
			        'value' => set_value('email')
					),$required);

//Label en Input field voor het wachtword
?>
<p class="error"></p>
<?php
echo form_label('Wachtwoord','password');
echo form_input(array(
					'type'  => 'password',
					'name'  => 'password',
					'id'	=> 'password'
					),$required);

echo form_submit('','Inloggen'); // Submit knop

echo form_close('</div'); // </form> </div>
?>