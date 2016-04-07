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

	<form id="blogPost_form" action="school.php?insertCourse" method="POST" enctype="multipart/form-data">
	<div class="row">
		<label for="courseName">Kurs:</label><br />
		<input id="courseName" class="input" name="courseName" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="courseDate">Datum:</label><br />
		<input id="courseDate" class="input" name="courseDate" type="date"><br />
	</div>
	<div class="row">
		<label for="courseTime">Tid:</label><br />
		<input id="courseTime" class="input" name="courseTime" type="time"><br />
	</div>
	<div class="row">
		<label for="entryRequirements">Förkunskapskrav:</label><br />
		<input id="entryRequirements" class="input" name="entryRequirements" type="text" size="30" /><br />
	</div>
	<input id="submit_button" type="submit" value="Lägg till" />
	</form>

	<?php

	if(isset($_GET['insertCourse'])) {

    	$courseName = $_POST['courseName'];
   		$courseDate = $_POST['courseDate'];
   		$courseTime = $_POST['courseTime'];
   		$entryRequirements = $_POST['entryRequirements'];

   		$query = "INSERT INTO Course (courseName, courseDate, courseTime, entryRequirements)
    	VALUES ('{$courseName}', '{$courseDate}', '{$courseTime}', '{$entryRequirements}')";

    	if (mysqli_query($db_conn, $query)) {
    		echo "Kurs har skapats";
		} else {
    		echo "<p id='error'>Gick inte att skapa kurs</p>";
		}
	}

	?>

	<?php
		$sql = "SELECT courseID, courseName, courseDate, courseTime, entryRequirements FROM Course";
		$result = mysqli_query($db_conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			echo "<h2>Kurser</h2>";
			while($row = mysqli_fetch_assoc($result)) {
				$courseID = $row["courseID"];

				echo "<h3>" . $row["courseName"] ."</h3>";
				echo "<p>Datum: <b> " . $row["courseDate"] ."</b><br>";
				echo "Tid: <b>" . $row["courseTime"] ."</b><br>";
				echo "Förkunskapskrav: <b>" . $row["entryRequirements"] ."</b><br></p>";

				$sql2 = "SELECT * FROM Participant WHERE courseID = '{$courseID}'";
				$result2 = mysqli_query($db_conn, $sql2);

				if (mysqli_num_rows($result2) > 0) {
					echo "<h3>Deltagare till denna kurs:</h3>";
					echo "<table><tr><th>Namn</th><th>Kön</th><th>Ålder</th></tr>";
					while($row = mysqli_fetch_assoc($result2)) {
						echo "<tr>";
						echo "<td>" . $row["pName"] ."</td>";
						echo "<td>" . $row["pSex"] ."</td>";
						echo "<td>" . $row["age"] ."</td>";
						echo "</tr>";
					}
					echo "</table>";
				}

			}
			echo "</table>";
			
		} else {
		}
		?>

	<?php endif; ?>

	<?php if(!isset($_SESSION['username'])): ?>

	<?php

	if(isset($_GET['newParticipant'])) {

   		$courseID = $_POST['courseID'];
   		$courseName = $_POST['courseName'];

   		echo '<h3>Kurs: ' . $courseName .'</h3>';

   		$sql = "SELECT COUNT(*) AS quantity  FROM Participant WHERE courseID = '{$courseID}'";
   		$result = mysqli_query($db_conn, $sql);

    	if (mysqli_num_rows($result) > 0) {
    		while($row = mysqli_fetch_assoc($result)) {
    			$quantity = $row["quantity"];

    			if ($quantity < 10) {

   		echo '<form id="blogPost_form" action="school.php?insertParticipant" method="POST" enctype="multipart/form-data">

	<div class="row">
		<label for="pName">Namn:</label><br />
		<input id="pName" class="input" name="pName" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="pSex">Kön:</label><br />
		<input id="pSex" class="input" name="pSex" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="age">Ålder:</label><br />
		<input id="age" class="input" name="age" type="number" size="30" /><br />
	</div>
	<div class="row">
		<input type="hidden" value="' . $courseID .'" name="courseID">
	</div>
	<input id="submit_button" type="submit" value="Lägg till" />
	</form>';

				}
				else {
					echo "<p id='error'>för många, testa någon av följande kurser: </p>";

					$sql = "SELECT courseID, courseName FROM Course";
					$result = mysqli_query($db_conn, $sql);
					if (mysqli_num_rows($result) > 0) {
    					while($row = mysqli_fetch_assoc($result)) {
    						$courseID = $row['courseID'];
    						$courseName = $row['courseName'];


    						$sql2 = "SELECT COUNT(*) AS quantity  FROM Participant WHERE courseID = '{$courseID}'";
    						$result2 = mysqli_query($db_conn, $sql2);

    						if (mysqli_num_rows($result) > 0) {
    							while($row = mysqli_fetch_assoc($result2)) {
    								$quantity = $row["quantity"];

    									if ($quantity < 10) {
    										echo "<p><b>" . $courseName . "</b></p>";
    									}
    								}
    							}
    						}
    					}
    				}

				}
			}
		
	}


	?>
	<?php

		if(isset($_GET['insertParticipant'])) {

   		$pName = $_POST['pName'];
   		$pSex = $_POST['pSex'];
   		$age = $_POST['age'];
   		$courseID = $_POST['courseID'];

   		$query = "INSERT INTO Participant (pName, pSex, age, courseID)
    	VALUES ('{$pName}', '{$pSex}', '{$age}', '{$courseID}')";

    	if (mysqli_query($db_conn, $query)) {
    		echo "Din hund är nu anmäld till kursen";
		} else {
    		echo "Det gick inte att anmäla din hund till kursen";
		}
	}

	?>

	<?php
		$sql = "SELECT courseID, courseName, courseDate, courseTime, entryRequirements FROM Course";
		$result = mysqli_query($db_conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			echo "<h2>Kurser</h2>";
			echo "<table><tr><th>Kurs</th><th>Datum</th><th>Tid</th><th>Krav</th><th>Delta</th></tr>";
			while($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>" . $row["courseName"] ."</td>";
				echo "<td>" . $row["courseDate"] ."</td>";
				echo "<td>" . $row["courseTime"] ."</td>";
				echo "<td>" . $row["entryRequirements"] ."</td>";
				echo "<td>";
				echo '<form method="post" action="school.php?newParticipant">
						<input type="submit" value="Delta" id="participate" name="participate">
						<input type="hidden" value='. $row['courseID'] .' name="courseID">
						<input type="hidden" value='. $row['courseName'] .' name="courseName">
					</form>';
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
			
		} else {
		}
		?>

	<?php endif; ?>

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