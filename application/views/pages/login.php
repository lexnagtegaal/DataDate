<div id="inloggen">
<?php
$required = "required"; // extra variabele om toe te kennen dat een input element required is.
$emailRegex = "^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+[\.]+[A-Za-z]{2,4}$"; // deze is krachtiger dan de default regEx.
$passwordRegEx; // later definieren

echo validation_errors(); // toont PHP server-side errors van het ingevulde formulier.
?>
<p class="error_find">
<?php
echo $this->session->userdata('errors'); 
// toont sessievariabale waar eventuele foutmelding vanuit de function login uit het model login wordt meegegeven.
$this->session->unset_userdata('errors'); // niet meer nodig, opgeruimd staat netjes.
?>
</p>

<?php
echo form_open('Login', 'id="login"'); // creert een form die weer terugverwijst naar de controller Home in dit geval.

//Label en Input field voor het emailadres
?>
<p class="error_email"></p>
<?php
echo form_label('E-mailadres','email_label');
echo form_input(array(
			        'type'  => 'email',
			        'name'  => 'email',
					'id'	=> 'email',
			        'value' => set_value('email'),
					'pattern' => $emailRegex,
					'title' => 'Het door u ingevulde e-mailadres is niet geldig!'
					),$required);

//Label en Input field voor het wachtword
?>
<p class="error_password"></p>
<?php
echo form_label('Wachtwoord','password_label');
echo form_input(array(
					'type'  => 'password',
					'name'  => 'password',
					'id'	=> 'password'
					),$required);

echo form_submit('','Inloggen'); // Submit knop

echo form_close('</div'); // </form> </div>
?>