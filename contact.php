<?php
	session_start();
	require 'db_connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Perrys kennel och hundskola</title>
	<meta charset="utf-8">
	<link href="css/kennel.css" rel="stylesheet">
	<link rel="icon" type="image/ico" href="/U5/images/favicon.ico"/>
	<link rel="icon" type="image/ico" href="http://grupp4.icsweb.se/U5/images/favicon.ico"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
	</script>
	<![endif]-->
</head>
<body>
<div id="wrapper">
	<?php include 'header.php';?>

	<div id="container">

	<?php include 'nav.php';?>


	<script type="text/javascript">
	var x = window.innerWidth;

	if (x <= 1024) {
		document.write('<div id="container2">');
	}

	</script>


	<div id="main">


	<h2>Kontakt</h2>
	<p><b>Namn: </b> Perry</p>
	<p><b>Adress: </b> Ole Römers väg 6 Lund</p>

	<script type="text/javascript">
	var x = window.innerWidth;

	if (x <= 768) {
		document.write('<p><b>Telenr: </b> <a href="tel:+46-0301-21250">+46-0301-21250</a></p>');
	}else {
		document.write('<p><b>Telenr: </b>+46-0301-21250</p>');
	}
	</script>
	<p><b>Mail: </b> ridgeback@batuulis.se</p>

	<form id="blogPost_form" action="contact.php?sendMessage" method="POST" enctype="multipart/form-data">
	<div class="row">
		<label for="Title">Epost:</label><br />
		<input id="title" class="input" name="contactFormMail" type="text" size="30" required/><br />
	</div>
	<div class="row">
		<label for="Title">Ämne:</label><br />
		<input id="title" class="input" name="contactFormSubject" type="text" size="30" required/><br />
	</div>
	<div class="row">
		<label for="content">Meddelande:</label><br />
		<textarea id="content" class="input" name="contactFormMessage" rows="7" cols="35" required></textarea><br />
	</div>
	<input id="submit_button" type="submit" value="Send" />
	</form>

	<?php

	if(isset($_GET['sendMessage'])) {

		$contactFormMail = $_POST['contactFormMail'];
    	$contactFormSubject = $_POST['contactFormSubject'];
   		$contactFormMessage = $_POST['contactFormMessage'];


   		$to = "ppiirree@gmail.com";
   		$header = "From: {$contactFormMail}";

		if(empty($contactFormMail) || empty($contactFormSubject) || empty($contactFormMessage)) {
			echo "<p id='error'>Fyll i alla  fält!</p><br>";
		}else{
			mail($to, $contactFormSubject, $contactFormMessage, $header);
			echo "<b><p>Meddelande har skickats</p></b><br>";
		}

	}

	?>

	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2247.7612934266385!2d13.211435016362477!3d55.71052090271906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x465397b5eef19a89%3A0x50d854d198f468dc!2sOle+R%C3%B6mers+v%C3%A4g+6%2C+223+63+Lund!5e0!3m2!1ssv!2sse!4v1451322480750" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>

	</div>

	<?php include 'aside.php';?>

	<script type="text/javascript">
	var x = window.innerWidth;

	if (x <= 1024) {
		document.write("</div>");
	}

	</script>
	</div>
	<?php include 'time.php';?>
</div>
</body>
</html>