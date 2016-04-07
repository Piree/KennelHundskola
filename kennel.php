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

	<?php if(isset($_SESSION['username'])): ?>

	<h3>Lägg till valpkull!</h3>

	<form id="blogPost_form" action="kennel.php?insertLitter" method="POST" enctype="multipart/form-data">
	<div class="row">
		<label for="name">Valpkull:</label><br />
		<input id="name" class="input" name="name" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="description">information:</label><br />
		<textarea id="description" class="input" name="description" rows="7" cols="35"></textarea><br />
	</div>
	<input id="submit_button" type="submit" value="Lägg till" />
	</form>

		<?php

		if(isset($_GET['insertLitter'])) {

    	$name = $_POST['name'];
   		$description = $_POST['description'];

   		$query = "INSERT INTO Litter (litterName, litterDesc)
    	VALUES ('{$name}', '{$description}')";

    	if (mysqli_query($db_conn, $query)) {
    		echo "Valpkull har skapats";
		} else {
    		echo "<p id='error'>Det gick inte att skapa valpkull</p>";
		}
	}

	?>

	<?php

		$sql = "SELECT * FROM Litter";
		$result = mysqli_query($db_conn, $sql);


		if (mysqli_num_rows($result) > 0) {
			echo "<h3>Lägg till valp!</h3>";
			echo '<form id="blogPost_form" action="kennel.php?insertPuppy" method="POST" enctype="multipart/form-data">';
			echo '<select name="litterName">';
			while($row = mysqli_fetch_assoc($result)) {
				echo '<option value="'  . $row["litterName"] . '">' . $row["litterName"] . '</option>';

			}
			echo '</select><br><br>';
			echo '<div class="row">
					<label for="name">Namn:</label><br />
					<input id="name" class="input" name="puppyName" type="text" size="30" /><br />
				</div>';
			echo '<div class="row">
					<label for="sex">Kön:</label><br />
					<input id="sex" class="input" name="sex" type="text" size="30" /><br />
				</div>';
			echo '<div class="row">
					<label for="price">Pris:</label><br />
					<input id="price" class="input" name="price" type="number" size="30" /><br />
				</div>';
			echo '<div class="row">
					<label for="forSale">Till Salu?:</label><br />
					<input id="forSale" class="input" name="forSale" type="text" size="30" /><br />
				</div>';
			echo '<input id="submit_button" type="submit" value="Lägg till" />';
			echo '</form>';
		}
	?>


	<?php

	if(isset($_GET['insertPuppy'])) {

   		$puppyName = $_POST['puppyName'];
   		$sex = $_POST['sex'];
   		$price = $_POST['price'];
   		$forSale = $_POST['forSale'];
   		$litterName = $_POST['litterName'];

   		$query = "INSERT INTO Puppy (puppyName, sex, price, forSale, litterName)
    	VALUES ('{$puppyName}', '{$sex}', '{$price}', '{$forSale}', '{$litterName}')";

    	if (mysqli_query($db_conn, $query)) {
    		echo "Valp har skapats";
		} else {
    		echo "<p id='error'>Det gick inte att skapa valp</p>";
		}
	}

	?>

	<?php endif; ?>

	<?php
		$sql = "SELECT DISTINCT litterName FROM Puppy";
		$result = mysqli_query($db_conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			echo "<h2>Aktuella valpkullar</h2>";
			while($row = mysqli_fetch_assoc($result)) {
				$litter = $row["litterName"];

				$sql2 = "SELECT Litter.litterName, litterDesc, puppyName, sex, price, forSale FROM Litter RIGHT OUTER JOIN Puppy ON Litter.litterName = Puppy.litterName WHERE Litter.litterName = '{$litter}'";
				echo "<h3>" . $litter . "</h3>";
				$result3 = mysqli_query($db_conn, $sql2);
				$row3 = mysqli_fetch_assoc($result3);
				echo "<p>" . $row3["litterDesc"] . "</p>";
				$result2 = mysqli_query($db_conn, $sql2);
				if (mysqli_num_rows($result2) > 0) {
					echo "<table><tr><th>Namn</th><th>Kön</th><th>pris</th><th>Till salu?</th></tr>";
					while($row2 = mysqli_fetch_assoc($result2)) {
						echo "<tr>";
						echo "<td>" . $row2["puppyName"] ."</td>";
						echo "<td>" . $row2["sex"] ."</td>";
						echo "<td>" . $row2["price"] ."</td>";
						echo "<td>" . $row2["forSale"] ."</td>";
						echo "</tr>";
					}
					echo "</table>";
				}
			}
		} else {
		}
		?>

		<?php
		$sql = "SELECT Litter.litterName, litterDesc, puppyName, sex, price, forSale FROM Litter LEFT OUTER JOIN Puppy ON Litter.litterName = Puppy.litterName WHERE puppyName is NULL";
		$result = mysqli_query($db_conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			echo "<h2>Kommande Valpkullar</h2>";
			while($row = mysqli_fetch_assoc($result)) {
				echo "<h3>" . $row["litterName"] . "</h3><br>";
				echo "" . $row["litterDesc"] ."<br>";
			}
		} else {
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