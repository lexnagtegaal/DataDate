<div id="fotopagina">
<h1 class="title">Profielfoto aanpassen</h1>
<p>U kunt een foto uploaden van het formaat gif, jpg of png dat kleiner is dan 20MB.</p>
<?php

echo form_open_multipart("Foto/upload","id='foto'");

echo form_label("Uw huidige profielfoto:");
echo img(array(
			'src'	=> $foto,
			'alt'	=> $user,
));

echo set_value('Plaatje');
echo "</br>";
echo form_label("U kunt een foto selecteren om te gebruiken als profielfoto.","Plaatje");
echo "</br>";
echo form_upload(array(
					'name'	=>'userfile',
					'id'	=>'Plaatje'
				));
echo form_submit('','Uploaden');

echo form_close('</div>');
?>