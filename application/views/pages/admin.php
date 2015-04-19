<?php
echo form_open("Admin","id='admin'");
echo heading("Afstandsmaat",2);
echo form_label("Methode van Dice","D1");

echo form_label("Methode van Jacard","D2");

echo form_label("Methode van Cosinus","D3");

echo form_label("Methode van Overlapping","D4");

echo heading("X-factor",2);
echo form_label("Sterkte Persoonlijkheidstype ten opzichte van Merken.");
?>
<p>1 sluit merken matching, 0 sluit Persoonlijkheidstype uit.</p>
<?php
echo heading("Alfa-factor",2);
echo form_label("Sterkte waarmee nieuwe likes de persoonlijkheidsvoorkeur verandert");
?>
<p>1 sluit verandering uit, 0 zorgt voor totale verandering</p>
<?php 
echo form_close();
?>