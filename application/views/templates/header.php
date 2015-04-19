<html>
	<head>
		<link type="text/css" rel="stylesheet" href=" <?php echo base_url("style/default.css");?>">
		<link type="text/css" rel="stylesheet" href=" <?php echo base_url("style/template.css");?>">
		<link type="text/css" rel="stylesheet" href=" <?php echo base_url("style/profiles.css");?>">
		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url("script/tabel.js");?>"></script>
		<script type="text/javascript" src="<?php echo base_url("script/ajax.js");?>"></script>
		<script type="text/javascript" src="<?php echo base_url("script/default.js");?>"></script>
		<script type="text/javascript" src="<?php echo base_url("script/form.js");?>"></script>
		<script type="text/javascript"src="<?php echo base_url("script/ajax.js");?>"></script>
		
		
		<title><?php echo $title ?></title>
	</head>
	<body>
	<header>
		<div id="logo">
		<a href="home" >
			<img src=" <?php echo base_url("/image/logoP"); ?>">
		</a>
		<a href="home" >
			<img src=" <?php echo base_url("/image/logoT"); ?>">
		</a>
		</div>
		<nav>
			<ul>
				<li><a href="<?php echo base_url("home");?>">Home</a></li>
				<li><a href="<?php echo base_url("profilepage");?>">no go</a></li>
				<li><a href="<?php echo base_url("login");?>">Inloggen</a></li>
				<li><a href="<?php echo base_url("register");?>">Registeren</a></li>
			</ul>
		</nav>
		
	</header>
<div id="content" class="margin">