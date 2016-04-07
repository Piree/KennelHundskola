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
    <link rel="stylesheet" type="text/css" media="all" href="css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" media="all" href="css/jgallery.min.css?v=1.5.0" />
    <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="js/jgallery.min.js?v=1.5.0"></script>
    <script type="text/javascript" src="js/touchswipe.min.js"></script>
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

   

	<div id="mainImg">

	<div id="gallery">
    <div class="album" data-jgallery-album-title="Veberöd">
        <a href="photos/photo1.jpg"><img src="photos/photo1.jpg" alt="Photo 1" /></a>
        <a href="photos/photo2.jpg"><img src="photos/photo2.jpg" alt="Photo 2" /></a>
        <a href="photos/photo3.jpg"><img src="photos/photo3.jpg" alt="Photo 3" /></a>
    </div>
    <div class="album" data-jgallery-album-title="Malozi Charaza">
        <a href="photos/photo4.jpg"><img src="photos/photo4.jpg" alt="Photo 4" /></a>
        <a href="photos/photo5.jpg"><img src="photos/photo5.jpg" alt="Photo 5" /></a>
        <a href="photos/photo6.jpg"><img src="photos/photo6.jpg" alt="Photo 6" /></a>
    </div>
       <div class="album" data-jgallery-album-title="Ängen i Hindsås">
        <a href="photos/photo7.jpg"><img src="photos/photo7.jpg" alt="Photo 7" /></a>
        <a href="photos/photo8.jpg"><img src="photos/photo8.jpg" alt="Photo 8" /></a>
        <a href="photos/photo9.jpg"><img src="photos/photo9.jpg" alt="Photo 9" /></a>
        <a href="photos/photo10.jpg"><img src="photos/photo10.jpg" alt="Photo 10" /></a>
        <a href="photos/photo11.jpg"><img src="photos/photo11.jpg" alt="Photo 11" /></a>
    </div>
	</div>
	<script type="text/javascript">
	$( function() {
   		$( '#gallery' ).jGallery();
	} );
	</script>

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