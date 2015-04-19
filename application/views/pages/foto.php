<h2>Profielfoto aanpassen</h2>
<p>U kunt een foto uploaden van het formaat gif, jpg of png dat kleiner is dan 20MB</p>.
<?php

echo form_open_multipart("Foto/upload","id='foto'");

echo form_label("Uw huidige profielfoto:");
echo img(array(
			'src'	=> $foto,
			'alt'	=> $user,
));

echo set_value('Plaatje');

echo form_label("U kunt een foto selecteren om te gebruiken als profielfoto.","Plaatje");
echo form_upload(array(
					'name'	=>'userfile',
					'id'	=>'Plaatje'
				));
echo form_submit('','Uploaden');

echo form_close();
?>