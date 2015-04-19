<?php
/* We creeren een array van vragen en de waarde die daarbij horen.
 * Deze laten we shuffelen met de hulp van de randomize functie in de rndm_helper
 * Daarna laden we de geshufflede array via een loop één voor één in en het resultaar staat live!
 */
$vragenlijst=array();
$i=1;
for($i=1;array_push($vragenlijst,
						array(
						'Vraag'		=> $i,
						'A'			=> array(
											'name'		=> 'vraag['.$i.']',
											'class'		=> 'vraag_'.$i,
											'ID'		=> 'vraag'.$i.'A',
											'value'		=> 'A',
											'Required'	=> 'TRUE'
										),
						'B'			=> array(
											'name'		=> 'vraag['.$i.']',
											'class'		=> 'vraag_'.$i,
											'ID'		=> 'vraag'.$i.'B',
											'value'		=> 'B',
											'Required'	=> 'TRUE'
										),
						'C'			=> array(
											'Name'		=> 'vraag['.$i.']',
											'class'		=> 'vraag_'.$i,
											'ID'		=> 'vraag'.$i.'C',
											'value'		=> 'C',
											'Required'	=> 'TRUE'
										)
						)
			)<19;$i++); // vult de array tot 20x toe met de waarde van $i van 1 tot 20

$vragen=randomize($vragenlijst);

$answers=array(
			'1'		=> array(
					'A'	=>'Ik geef de voorkeur aan grote groepen mensen, met een grote diversiteit.',
					'B'	=>'Ik geef de voorkeur aan intieme bijeenkomsten met uitsluitend goede vrienden.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'2'		=> array(
					'A'	=>'Ik doe eerst, en dan denk ik.',
					'B'	=>'Ik denk eerst, en dan doe ik.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'3'		=> array(
					'A'	=>'Ik ben makkelijk afgeleid, met minder aandacht voor een enkele specifieke taak.',
					'B'	=>'Ik kan me goed focussen, met minder aandacht voor het grote geheel.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'4'		=> array(
					'A'	=>'Ik ben een makkelijke prater en ga graag uit.',
					'B'	=>'Ik ben een goede luisteraar en meer een priv&eacute;-persoon.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'5'		=> array(
					'A'	=>'Als gastheer/-vrouw ben ik altijd het centrum van de belangstelling.',
					'B'	=>'Als gastheer/-vrouw ben altijd achter de schermen bezig om te zorgen dat alles soepeltjes verloopt.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'6'		=> array(
					'A'	=>'Ik geef de voorkeur aan concepten en het leren op basis van associaties.',
					'B'	=>'Ik geef de voorkeur aan observaties en het leren op basis van feiten.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'7'		=> array(
					'A'	=>'Ik heb een groot inbeeldingsvermogen en heb een globaal overzicht van een project.',
					'B'	=>'Ik ben pragmatisch ingesteld en heb een gedetailleerd beeld van elke stap.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'8'		=> array(
					'A'	=>'Ik kijk naar de toekomst.',
					'B'	=>'Ik houd mijn blik op het heden gericht.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'9'		=> array(
					'A'	=>'Ik houd van de veranderlijkheid in relaties en taken.',
					'B'	=>'Ik houd van de voorspelbaarheid in relaties en taken.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'10'	=> array(
					'A'	=>'Ik overdenk een beslissing helemaal.',
					'B'	=>'Ik beslis met mijn gevoel.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'11'	=> array(
					'A'	=>'Ik werk het beste met een lijst plussen en minnen.',
					'B'	=>'Ik beslis op basis van de gevolgen voor mensen.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'12'	=> array(
					'A'	=>'Ik ben van nature kritisch.',
					'B'	=>'Ik maak het mensen graag naar de zin.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'13'	=> array(
					'A'	=>'Ik ben eerder eerlijk dan tactisch.',
					'B'	=>'Ik ben eerder tactisch dan eerlijk.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'14'	=> array(
					'A'	=>'Ik houd van vertrouwde situaties.',
					'B'	=>'Ik houd van flexibele situaties.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'15'	=> array(
					'A'	=>'Ik plan alles, met een to-do lijstje in mijn hand.',
					'B'	=>'Ik wacht tot er meerdere idee&euml;n opborrelen en kies dan on-the-fly wat te doen.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'16'	=> array(
					'A'	=>'Ik houd van het afronden van projecten.',
					'B'	=>'Ik houd van het opstarten van projecten.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'17'	=> array(
					'A'	=>'Ik ervaar stress door een gebrek aan planning en abrupte wijzigingen.',
					'B'	=>'Ik ervaar gedetailleerde plannen als benauwend en kijk uit naar veranderingen.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'18'	=> array(
					'A'	=>'Het is waarschijnlijker dat ik een doel bereik.',
					'B'	=>'Het is waarschijnlijker dat ik een kans zie.',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			),
			'19'	=> array(
					'A'	=>'"All play and no work maakt dat het project niet afkomt."',
					'B'	=>'"All work and no play maakt je maar een saaie pief."',
					'C'	=>'Ik zit er eigenlijk tussenin.'
			)
);

echo form_open("Test","id='test'");

foreach($vragen as $vraag){
	echo heading("Geef het antwoord dat het beste bij jou past",2);
	$antwoorden=randomize(array("A","B"));
	foreach($antwoorden as $antwoord){
		echo form_radio($vraag[$antwoord]); // resulteert in A,B of C van de bijbehorende vraag.
		echo form_label($answers[$vraag['Vraag']][$antwoord],$vraag[$antwoord]['ID']);
	}
	$antwoord="C";
	echo form_radio($vraag[$antwoord]); // resulteert in A,B of C van de bijbehorende vraag.
	echo form_label($answers[$vraag['Vraag']][$antwoord],$vraag[$antwoord]['ID']);
	
}

echo form_submit('','Opsturen');

echo form_close();
?>