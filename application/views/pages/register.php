<div id="registeren">
<div>
<h1 class="title">Registeren</h1>
</div>
<?php
$required = "required"; // extra variabele om toe te kennen dat een input element required is.

echo validation_errors(); // toont PHP server-side errors van het ingevulde formulier.

echo form_open('Register', 'id="register"');
?>
<div>
<?php 
//Bijnaam
echo form_label('Bijnaam', 'class="normalLabel"');
echo form_input(array(
		'type'  => 'text',
		'name'  => 'Nickname',
		'class'	=> 'normalLabel',
		'placeholder' => 'Boterbloempje',
		'value' => set_value('Nickname'),
		'pattern' => UserRegex('',TRUE)[0],
		'title' => UserRegex('',TRUE)[1],
		'required' => TRUE
));
?>
</div>
<div>
<?php 
//Echte naam
echo form_label('Voornaam');
echo form_input(array(
		'type'  => 'text',
		'name'  => 'FirstName',
		'placeholder' => 'Brigitte',
		'value' => set_value('FirstName'),
		'pattern' => NameRegex('',TRUE)[0],
		'title' => NameRegex('',TRUE)[1],
		'required' => TRUE
));
?>
</div>
<div>
<?php 
echo form_label('Tussenvoegsel');
echo form_input(array(
		'type'  => 'text',
		'name'  => 'MiddleName',
		'placeholder' => 'van der',
		'value' => set_value('MiddleName'),
		'pattern' => NameRegex('',TRUE)[0],
		'title' => NameRegex('',TRUE)[1],
		'required' => TRUE
));
?>
</div>
<div>
<?php 
echo form_label('Achternaam');
echo form_input(array(
		'type'  => 'text',
		'name'  => 'LastName',
		'placeholder' => 'Laan',
		'value' => set_value('LastName'),
		'pattern' => NameRegex('',TRUE)[0],
		'title' => NameRegex('',TRUE)[1],
		'required' => TRUE
));
?>
</div>
<div>
<?php 
echo form_label('Wachtwoord');
echo form_input(array(
		'type'  => 'password',
		'name'  => 'password',
		'value' => set_value('password'),
		'pattern' => PasswordRegex('',TRUE)[0],
		'title' => PasswordRegex('',TRUE)[1],
		'required' => TRUE
));
?>
</div>
<div>
<?php 
echo form_label('Wachtwoord herhalen');
echo form_input(array(
		'type'  => 'password',
		'name'  => 'password_confirm',
		'value' => set_value('password_confirm'),
		'pattern' => PasswordRegex('',TRUE)[0],
		'title' => PasswordRegex('',TRUE)[1],
		'required' => TRUE
));
?>
</div>
<div>
<?php 
echo form_label('E-mailadres');
echo form_input(array(
		'type'  => 'email',
		'name'  => 'email',
		'placeholder' => 'B.vdLaan@gmail.com',
		'value' => set_value('email'),
		'pattern' => EmailRegex('',TRUE)[0],
		'title' => EmailRegex('',TRUE)[1],
		'required' => TRUE
));
?>
</div>
<div>
<?php 
//Radio Buttons voor het geslacht (Man of Vrouw)
echo form_label('Geslacht');

$man=array(
		'name'  => 'Gender',
		'id'	=> 'Man',
		'value' => 'Man'
);
$vrouw=array(
		'name'  => 'Gender',
		'id'	=> 'Vrouw',
		'value' => 'Vrouw'
);
if(set_value("Gender")=="Vrouw"){
	$vrouw=array(
		'name'  => 'Gender',
		'id'	=> 'Vrouw',
		'value' => 'Vrouw',
		'checked' => TRUE
	);
	}
if(set_value("Gender")=="Man"){
	$man=array(
		'name'  => 'Gender',
		'id'	=> 'Man',
		'value' => 'Man',
		'checked' => TRUE
	);
}
	
echo form_label('Man','Man');
echo form_radio($man);

echo form_label('Vrouw','Vrouw');
echo form_radio($vrouw);
?>
</div>
<div>
<?php 
//Geboortedatum met behulp van een datepicker uit jqeury UI
echo form_label("Geboortedatum");
echo form_input(array(
		'type'  => 'date',
		'name'  => 'Geboortedatum',
		'placeholder' => 'MM/DD/JJJJ',
		'value' => set_value('Geboortedatum'),
		'required' => TRUE
));
?>
</div>
<div>
<?php 
//Textarea voor beschrijving
echo form_label("Beschrijving");
echo form_textarea(array(
		'name'  => 'Beschrijving',
		'placeholder' => 'Hoi, ik ben Brigitte.',
		'value' => set_value('Beschrijving'),
		'required' => TRUE
)); // geen Regex aangezien alle tekst mag, wel nog server side controle over invoer!!!
?>
</div>
<div id="geslachtsvoorkeur">
<?php 
//Checkboxes voor Geslachtsvoorkeeur
echo form_label("Ik zoek");
$male=array(
		'name'	=> 'Voorkeur[]',
		'id'	=> 'Male',
		'value'	=> "Man"
		);
$female=array(
		'name'	=> 'Voorkeur[]',
		'id'	=> 'Female',
		'value'	=> "Vrouw"
		);
if(set_value('Voorkeur[0]')=="Man"|set_value('Voorkeur[1]')=="Man"){
	$male=array(
			'name'	=> 'Voorkeur[]',
			'id'	=> 'Male',
			'value'	=> "Man",
			'checked' => TRUE
	);
}
if(set_value('Voorkeur[0]')=="Vrouw"|set_value('Voorkeur[1]')=="Vrouw"){
	$female=array(
			'name'	=> 'Voorkeur[]',
			'id'	=> 'Female',
			'value'	=> "Vrouw",
			'checked' => TRUE
	);
}

echo form_label("mannen","Male");
echo form_checkbox($male);
echo form_label("vrouwen","Female");
echo form_checkbox($female);
?>
</div>
<div>
<?php 
//Minimum en maximleeftijd
$age=[];
for($a=18;$a<=100;$a++){ // maximale invoer is 100. 100 zien we als 100+ (om rekenmethodes te vergemakelijken houden we deze op 100, een integerwaarde!)
	array_push($age,$a);
}
echo form_label("tussen","id='test'");
echo form_dropdown("min",$age,set_value('min'),"id='min' required='1'");
echo form_label("en");
echo form_dropdown("max",$age,set_value('max'),"id='max' required='1'");
?>
</div>
<div>
<?php 
//Merken kiezen uit een lijst van 50 uit merken() van regex_helper().
echo form_label("Mijn favoriete merken");
echo form_multiselect("merken[]",merken(),set_value('merken[]'),"id='merken' required='1'");
?>
</div>
<div>
<?php 
echo form_submit('','Registeren');

echo form_close('</div>');
?>
</div>