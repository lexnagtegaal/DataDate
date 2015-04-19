<div id="inloggen">
<?php
$required = "required"; // extra variabele om toe te kennen dat een input element required is.

echo validation_errors(); // toont PHP server-side errors van het ingevulde formulier.

echo form_open('Login', 'id="login"'); // creert een form die weer terugverwijst naar de controller Home in dit geval.

//Label en Input field voor het emailadres

echo form_label('E-mailadres');
echo form_input(array(
			        'type'  => 'email',
			        'name'  => 'email',
					'id'	=> 'email',
			        'value' => set_value('email'),
					'pattern' => EmailRegex('',TRUE)[0],
					'title' => EmailRegex('',TRUE)[1]
					),$required);

//Label en Input field voor het wachtword
echo form_label('Wachtwoord');
echo form_input(array(
					'type'  => 'password',
					'name'  => 'password',
					'id'	=> 'password'
					),$required);

echo form_submit('','Inloggen'); // Submit knop

echo form_close('</div>'); // </form> </div>

?>
