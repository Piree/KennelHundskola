<?php
	session_start();
	require 'db_connect.php';

	$litterName = $_GET['litterName'];

	if(isset($_GET['insertPuppy'])) {

   		$puppyName = $_POST['puppyName'];
   		$sex = $_POST['sex'];
   		$price = $_POST['price'];
   		$forSale = $_POST['forSale'];

   		$query = "INSERT INTO puppy (puppyName, sex, price, forSale, litterName)
    	VALUES ('{$puppyName}', '{$sex}', '{$price}', '{$forSale}', '{$litterName}')";

    	if (mysqli_query($db_conn, $query)) {
    		echo "<br><br>Valp har skapats";
		} else {
    		echo "Error: " . $query . "<br>" . mysqli_error($db_conn);
		}

	}

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

	<?php if(isset($_SESSION['username'])): ?>

	<form id="blogPost_form" action="litter.php?insertPuppy" method="POST" enctype="multipart/form-data">
	<div class="row">
		<label for="name">Namn:</label><br />
		<input id="name" class="input" name="puppyName" type="text" size="30" /><br />
	</div>
		<div class="row">
		<label for="sex">Kön:</label><br />
		<input id="sex" class="input" name="sex" type="text" size="30" /><br />
	</div>
		<div class="row">
		<label for="price">Pris:</label><br />
		<input id="price" class="input" name="price" type="number" size="30" /><br />
	</div>
		<div class="row">
		<label for="forSale">Till Salu?:</label><br />
		<input id="forSale" class="input" name="forSale" type="text" size="30" /><br />
	<input id="submit_button" type="submit" value="Lägg till" />
	</form>

	<?php endif; ?>

	<?php
		$sql = "SELECT puppyName, sex, price, forSale FROM puppy";
		$result = mysqli_query($db_conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {

				echo "" . $row["puppyName"] ."";
				echo "" . $row["sex"] ."";
				echo "" . $row["price"] ."";
				echo "" . $row["forSale"] ."";
			}
		} else {
			echo "0 results";
		}
		?>
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