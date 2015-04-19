<?php
$D1=array(
		'name'  => 'D',
		'id'	=> 'D1',
		'value' => 'D1',
		'required'=>TRUE
	);
$D2=array(
		'name'  => 'D',
		'id'	=> 'D2',
		'value' => 'D2',
		'required'=>TRUE
);
$D3=array(
		'name'  => 'D',
		'id'	=> 'D3',
		'value' => 'D3',
		'required'=>TRUE
);
$D4=array(
		'name'  => 'D',
		'id'	=> 'D4',
		'value' => 'D4',
		'required'=>TRUE
);
switch ($Afstandsmaat){
	case "D2":
		$D2=array(
				'name'  => 'D',
				'id'	=> 'D2',
				'value' => 'D2',
				'Checked'	=> TRUE,
				'required'=>TRUE
		);
	break;
		
	case "D3":
		$D3=array(
				'name'  => 'D',
				'id'	=> 'D3',
				'value' => 'D3',
				'Checked'	=> TRUE,
				'required'=>TRUE
		);
	break;
	
	Case "D4":
		$D4=array(
				'name'  => 'D',
				'id'	=> 'D4',
				'value' => 'D4',
				'Checked'	=> TRUE,
				'required'=>TRUE
		);
	break;
	
	Default://D1 als Default
		$D1=array(
				'name'  => 'D',
				'id'	=> 'D1',
				'value' => 'D1',
				'Checked'	=> TRUE,
				'required'=>TRUE
		);
	break;
}

echo form_open("Admin","id='admin'");
echo heading("Afstandsmaat",2);
echo form_label("Methode van Dice","D1");
echo form_radio($D1);
echo form_label("Methode van Jacard","D2");
echo form_radio($D2);
echo form_label("Methode van Cosinus","D3");
echo form_radio($D3);
echo form_label("Methode van Overlapping","D4");
echo form_radio($D4);
echo heading("X-factor",2);
echo form_label("Sterkte Persoonlijkheidstype ten opzichte van Merken.");
echo form_input(array(
		'type'	=>	'range',
		'name'	=>	'X',
		'id'	=>	'Xfactor',
		'value' =>	$Xfactor,
		'min'	=>	'0',
		'max'	=>	'1',
		'required'	=>	TRUE
));
?>
<p>1 sluit merken matching, 0 sluit Persoonlijkheidstype uit.</p>
<?php
echo heading("Alfa-factor",2);
echo form_label("Sterkte waarmee nieuwe likes de persoonlijkheidsvoorkeur verandert");
echo form_input(array(
		'type'	=>	'Alfa',
		'name'	=>	'A',
		'id'	=>	'Alfa',
		'value' =>	$Xfactor,
		'min'	=>	'0',
		'max'	=>	'1',
		'required'	=>	TRUE
));
?>
<p>1 sluit verandering uit, 0 zorgt voor totale verandering</p>
<?php 
echo form_close();
?>