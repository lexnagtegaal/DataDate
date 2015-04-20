<div id="profielpagina">
<div>
<h1 class="title"><?php echo $Bijnaam ?></h1>
</div>
<div>
<?php
if(!$this->credentials->check_credentials()){
	$Foto="image/".$Geslacht.".png";
}
?>
<img src='<?php echo base_url($Foto); ?>' alt='<?php echo $Bijnaam;?>'>
<?php
if($owner){
?>
<a href='<?php echo base_url("Foto");?>'>Foto aanpassen</a>
<?php 
} 
?>
</div>
<?php
$required = "required"; // extra variabele om toe te kennen dat een input element required is.
if($owner){
	echo validation_errors(); // toont PHP server-side errors van het ingevulde formulier.
	
	echo form_open('Profile/unique/'.$this->session->userdata('username'), 'id="register"');
}
?>
<div>
<?php 
//Echte naam
echo form_label('Voornaam');
if($owner){
	echo form_input(array(
		'type'  => 'text',
		'name'  => 'FirstName',
		'placeholder' => 'Brigitte',
		'value' => $Voornaam,
		'pattern' => NameRegex('',TRUE)[0],
		'title' => NameRegex('',TRUE)[1],
		'required' => TRUE
));
}else{
	echo $Voornaam;
}
?>
</div>
<div>
<?php 
echo form_label('Tussenvoegsel');
if($owner){
	echo form_input(array(
		'type'  => 'text',
		'name'  => 'MiddleName',
		'placeholder' => 'van der',
		'value' => $Tussenvoegsel,
		'pattern' => NameRegex('',TRUE)[0],
		'title' => NameRegex('',TRUE)[1],
		'required' => TRUE
));
}else{
	echo $Tussenvoegsel;
}
?>
</div>
<div>
<?php 
echo form_label('Achternaam');
if($owner){
	echo form_input(array(
		'type'  => 'text',
		'name'  => 'LastName',
		'placeholder' => 'Laan',
		'value' => $Achternaam,
		'pattern' => NameRegex('',TRUE)[0],
		'title' => NameRegex('',TRUE)[1],
		'required' => TRUE
));
}else{
	echo $Achternaam;
}
?>
</div>
<div>
<?php 
echo form_label('E-mailadres');
if($owner){
	echo form_input(array(
		'type'  => 'email',
		'name'  => 'email',
		'placeholder' => 'B.vdLaan@gmail.com',
		'value' => $mailadres,
		'pattern' => EmailRegex('',TRUE)[0],
		'title' => EmailRegex('',TRUE)[1],
		'required' => TRUE
));
}else{
	if($match){
		echo $mailadres;
	}else{
		echo "Het mailadres van ".$Bijnaam." is alleen beschikbaar als jullie samen een match zijn.";
	}
}
?>
</div>
<div>
<?php 
//Geslacht
echo form_label('Geslacht');
echo $Geslacht;
?>
</div>
<div>
<?php 
//Geboortedatum met behulp van een datepicker uit jqeury UI
echo form_label("Geboortedatum");
echo $Geboortedatum;
?>
</div>
<div>
<?php 
//Textarea voor beschrijving
echo form_label("Beschrijving");
if($owner){
	echo form_textarea(array(
		'name'  => 'Beschrijving',
		'placeholder' => 'Hoi, ik ben Brigitte.',
		'value' => $Beschrijving,
		'required' => TRUE
)); // geen Regex aangezien alle tekst mag, wel nog server side controle over invoer!!!
}else{
	echo $Beschrijving;
}
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

if( strpos( "Man", $Geslachtsvoorkeur )!==false ) {
	$male=array(
			'name'	=> 'Voorkeur[]',
			'id'	=> 'Male',
			'value'	=> "Man",
			'checked' => TRUE
	);
}
if( strpos( "Vrouw", $Geslachtsvoorkeur )!==false ) {
	$female=array(
			'name'	=> 'Voorkeur[]',
			'id'	=> 'Female',
			'value'	=> "Vrouw",
			'checked' => TRUE
	);
}
if($owner){
	echo form_label("mannen","Male");
	echo form_checkbox($male);
}else if( strpos( "Man", $Geslachtsvoorkeur )!==false ) {
	echo "Mannen";
}
if($Geslachtsvoorkeur=="ManVrouw"){
	echo "en";
}
if($owner){
	echo form_label("vrouwen","Female");
	echo form_checkbox($female);
}else if( strpos( "Vrouw", $Geslachtsvoorkeur )!==false ) {
	echo "Vrouwen";
}
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
if($owner){
echo form_dropdown("min",$age,"id='min' required='1' value='".($Minimumleeftijd-18)."'");
}else{
	echo $Minimumleeftijd;
}
echo form_label("en");
if($owner){
echo form_dropdown("max",$age,"id='max' required='1' value='".($Maximumleeftijd-18)."'");
}else{
	echo $Maximumleeftijd;
}
?>
</div>
<div>
<?php 
//Merken kiezen uit een lijst van 50 uit merken() van regex_helper().
echo form_label("Mijn favoriete merken");
if($owner){
	echo form_multiselect("merken[]",merken(),$Merken,"id='merken' required='1'");
}else{
	if(is_array($Merken)){
		foreach($Merken as $merk){
			echo "<span class='Merk'>".$merk."</span>";
		}
	}else{
		echo "Ik heb nog geen favoriete merken geselecteerd.";
	}
}
?>
</div>
<div>
<?php 
if($owner){
echo form_submit('','Aanpassen');

echo form_close('</div>');
}
?>
</div>