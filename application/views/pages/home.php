<h1 class="title"><a href="home">Home</a></h1>

<div class = "profiles">
	<?php if($this->credentials->check_credentials()){ ?>
		<div class="matches">
	<?php } else {?>
		<div class="random">
	<?php }?>
		<!-- Deze div blijft leeg en wordt steeds gevuld met behulp van onder andere ajax.js -->
	</div>
	<a class="java" href="rndm">meer</a>
</div>

<div id="registeren">
	<p> Registratie formulier wordt geladen</p>
</div>