<div id="inloggen">
<div>
<h1 class="title">Inloggen</h1>
</div>
<?php
$required = "required"; // extra variabele om toe te kennen dat een input element required is.

echo validation_errors(); // toont PHP server-side errors van het ingevulde formulier.

echo form_open('Login', 'id="login"'); // creert een form die weer terugverwijst naar de controller Home in dit geval.

//Label en Input field voor het emailadres
?>
<div id=email>
<?php 
echo form_label('E-mailadres');

echo form_input(array(
			        'type'  => 'email',
			        'name'  => 'email',
			        'value' => set_value('email'),
					'pattern' => EmailRegex('','TRUE')[0],
					'title' => EmailRegex('','TRUE')[1]
					),$required);
?>
</div>
<div id=password>
<?php 
//Label en Input field voor het wachtwoord
echo form_label('Wachtwoord');
echo form_input(array(
					'type'  => 'password',
					'name'  => 'password'
					),$required);
?>
</div>
<div id=submit>
<?php 
echo form_submit('','Inloggen'); // Submit knop

echo form_close('</div>'); // </form> </div>
?>
</div>
