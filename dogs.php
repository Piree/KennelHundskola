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

	<?php if(!isset($_SESSION['username'])): ?>

	<?php

	$sql = "SELECT * FROM myDog";
	$result = mysqli_query($db_conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		echo '<ul>';
		while($row = mysqli_fetch_assoc($result)) {
			echo '<li><a href=';
			echo 'dogs.php?mydID=' . $row['mydID'] . '> ' . $row['myName'] . '</a><li>';
		}
		echo '</ul>';
	} 

	?>

	<?php

	if(isset($_GET['mydID'])) {

    	$mydID = $_GET['mydID'];

   		$sql = "SELECT * FROM myDog WHERE mydID ='{$mydID}'";
   		$result = mysqli_query($db_conn, $sql);

    	if (mysqli_num_rows($result) > 0) {
    		while($row = mysqli_fetch_assoc($result)) {
    			echo '<h2> ' . $row['myName'] . '</h2>';
    			echo '<div class="floatright">';
    			echo '<img src="myDogs/' . $mydID . '.png" width="150" onerror=';
				echo 'this.style.display="none">';
				echo '</div>';
    			echo '<b>(' . $row['myBreedName'] . ')</b>';
    			echo '<p>' . $row['myDescription'] . '</p>';
    			echo '<div class="tablefloatleft">';
				echo '<table class="tablemydogs">';
				echo '<tr>';
				echo '<td>Färg:</td>';
				echo '<td>' . $row['myColor'] . '</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td>Född:</td>';
				echo '<td>' . $row['myBirth'] . '</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td>Höjd:</td>';
				echo '<td>' . $row['myHeight'] . '</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td>Vikt:</td>';
				echo '<td>' . $row['myWeight'] . '</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td>HD:</td>';
				echo '<td>' . $row['myHD'] . '</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td>AD:</td>';
				echo '<td>' . $row['myAD'] . '</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td>Tänder:</td>';
				echo '<td>' . $row['myTeeth'] . '</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td>MH:</td>';
				echo '<td>' . $row['myMH'] . '</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td>Uppfödare:</td>';
				echo '<td>' . $row['myBreeder'] . '</td>';
				echo '</tr>';
				echo '</table>';
				echo '</div>';

				$sql2 = "SELECT * FROM pedigreeDog";
   				$result2 = mysqli_query($db_conn, $sql2);

    				if (mysqli_num_rows($result2) > 0) {
    					while($row2 = mysqli_fetch_assoc($result2)) {

    					$pName = $row['myBreedName'];

    					$sql3 = "SELECT * FROM pedigreeDog WHERE pName = '{$pName}'";
    					$result3 = mysqli_query($db_conn, $sql3);
    					$row3 = mysqli_fetch_assoc($result3);
    					
    					$m1 = $row3['pMother'];
    					$f1 = $row3['pFather'];

    					$sql4 = "SELECT * FROM pedigreeDog WHERE pName = '{$m1}'";
    					$result4 = mysqli_query($db_conn, $sql4);
    					$row4 = mysqli_fetch_assoc($result4);

    					$mm1 = $row4['pMother'];
    					$mf1 = $row4['pFather'];

    					$sql5 = "SELECT * FROM pedigreeDog WHERE pName = '{$mm1}'";
    					$result5 = mysqli_query($db_conn, $sql5);
    					$row5 = mysqli_fetch_assoc($result5);

    					$mmm1 = $row5['pMother'];
    					$mmf1 = $row5['pFather'];

    					$sql6 = "SELECT * FROM pedigreeDog WHERE pName = '{$mf1}'";
    					$result6 = mysqli_query($db_conn, $sql6);
    					$row6 = mysqli_fetch_assoc($result6);

    					$mfm1 = $row6['pMother'];
    					$mff1 = $row6['pFather'];

    					$sql7 = "SELECT * FROM pedigreeDog WHERE pName = '{$f1}'";
    					$result7 = mysqli_query($db_conn, $sql7);
    					$row7 = mysqli_fetch_assoc($result7);

    					$fm1 = $row7['pMother'];
    					$ff1 = $row7['pFather'];

    					$sql8 = "SELECT * FROM pedigreeDog WHERE pName = '{$fm1}'";
    					$result8 = mysqli_query($db_conn, $sql8);
    					$row8 = mysqli_fetch_assoc($result8);

    					$fmm1 = $row8['pMother'];
    					$fmf1 = $row8['pFather'];

    					$sql9 = "SELECT * FROM pedigreeDog WHERE pName = '{$ff1}'";
    					$result9 = mysqli_query($db_conn, $sql9);
    					$row9 = mysqli_fetch_assoc($result9);

    					$ffm1 = $row9['pMother'];
    					$fff1 = $row9['pFather'];


    					}	
  					
  					echo '
				<table border="1" style="border-collapse: collapse" cellpadding="0" cellspacing="0" width="571" bordercolordark="#999999" bordercolorlight="#FFFFFF";>
        <tr>
          <td rowSpan="8" align="center" width="97"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font> ' . $pName . '</td>
          <td rowSpan="4" align="center" width="149"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font>' . $f1 . '</td>
          <td rowSpan="2" align="center" width="185"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font>' . $ff1 . '</td>
          <td align="center" width="140"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font>' . $fff1 . '</td>
        </tr>
        <tr>
          <td align="center" width="140"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font>' . $ffm1 . '</td>
        </tr>
        <tr>
          <td rowSpan="2" align="center" width="185"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font>' . $fm1 . '</td>
          <td align="center" width="140"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font>' . $fmf1 . '</td>
        </tr>
        <tr>
          <td align="center" width="140"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font>' . $fmm1 . '</td>
        </tr>
        <tr>
          <td rowSpan="4" align="center" width="149"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font>' . $m1 . '</td>
          <td rowSpan="2" align="center" width="185"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font>' . $mf1 . '</td>
          <td align="center" width="140"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font>' . $mff1 . '</td>
        </tr>
        <tr>
          <td align="center" width="140"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font>' . $mfm1 . '</td>
        </tr>
        <tr>
          <td rowSpan="2" align="center" width="185"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font>' . $mm1 . '</td>
          <td align="center" width="140"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font>' . $mmf1 . '</td>
        </tr>
        <tr>
          <td align="center" width="140"><!--mstheme--><font face="Arial, Arial, Helvetica">&nbsp;<!--mstheme--></font>' . $mmm1 . '</td>
        </tr>
      </table>
      ';
  				}
    		}
    	}
	}
	?>

	<?php endif; ?>

	<?php if(isset($_SESSION['username'])): ?>

	<h2>Lägg till hund!</h2>

	<form id="blogPost_form" action="dogs.php?insertDog" method="POST" enctype="multipart/form-data">
	<div class="row">
		<label for="name">Namn:</label><br />
		<input id="name" class="input" name="myName" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="myBreedName">Avelnamn:</label><br />
		<input id="myBreedName" class="input" name="myBreedName" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="MyDescription">information:</label><br />
		<textarea id="MyDescription" class="input" name="MyDescription" rows="7" cols="35"></textarea><br />
	</div>
	<div class="row">
		<label for="myColor">Färg:</label><br />
		<input id="myColor" class="input" name="myColor" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="myBirth">Födelsedatum:</label><br />
		<input id="myBirth" class="input" name="myBirth" type="date"><br />
	</div>
	<div class="row">
		<label for="myHeight">Höjd:</label><br />
		<input id="myHeight" class="input" name="myHeight" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="myWeight">Vikt:</label><br />
		<input id="myWeight" class="input" name="myWeight" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="myHD">HD:</label><br />
		<input id="myHD" class="input" name="myHD" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="myAD">AD:</label><br />
		<input id="myAD" class="input" name="myAD" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="myTeeth">Tänder:</label><br />
		<input id="myTeeth" class="input" name="myTeeth" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="myMH">MH:</label><br />
		<input id="myMH" class="input" name="myMH" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="myBreeder">Uppfödare:</label><br />
		<input id="myBreeder" class="input" name="myBreeder" type="text" size="30" /><br />
	</div>
	<input id="submit_button" type="submit" value="Lägg till" />
	</form>

	<?php

		if(isset($_GET['insertDog'])) {

    	$myName = $_POST['myName'];
   		$myBreedName = $_POST['myBreedName'];
   		$MyDescription = $_POST['MyDescription'];
   		$myColor = $_POST['myColor'];
   		$myBirth = $_POST['myBirth'];
   		$myHeight = $_POST['myHeight'];
   		$myWeight = $_POST['myWeight'];
   		$myHD = $_POST['myHD'];
   		$myAD = $_POST['myAD'];
   		$myTeeth = $_POST['myTeeth'];
   		$myMH = $_POST['myMH'];
   		$myBreeder = $_POST['myBreeder'];

   		$query = "INSERT INTO myDog (myName, myBreedName, MyDescription, myColor, myBirth, myHeight, myWeight, myHD, myAD, myTeeth, myMH, myBreeder)
    	VALUES ('{$myName}', '{$myBreedName}', '{$MyDescription}', '{$myColor}', '{$myBirth}', '{$myHeight}', '{$myWeight}', '{$myHD}', '{$myAD}', '{$myTeeth}','{$myMH}','{$myBreeder}')";

    	if (mysqli_query($db_conn, $query)) {
    		echo "Ny hund har skapats";
		} else {
    		echo "<p id='error'>Det gick inte att skapa hund</p> ";
    		echo "Error: " . $query . "<br>" . mysqli_error($db_conn);
		}

		$query2 = "INSERT INTO pedigreeDog (pName)
    	VALUES ('{$myBreedName}')";

    	if (mysqli_query($db_conn, $query2)) {
		} else {
		}
	}

	?>

	<h2>Lägg till bild på hund!</h2>

	<?php

	$sql = "SELECT * FROM myDog";
		$result = mysqli_query($db_conn, $sql);


		if (mysqli_num_rows($result) > 0) {
			echo '<form id="blogPost_form" action="?insertDogImage" method="POST" enctype="multipart/form-data">';
			echo '<select name="mydID">';
			while($row = mysqli_fetch_assoc($result)) {
				echo '<option value="'  . $row["mydID"] . '">' . $row["myName"] . '</option>';

			}
			echo '</select><br><br>';
			echo '<input type="file" name="fileToUpload" id="fileToUpload"><br>';
			echo '<input id="submit_button" type="submit" value="Lägg till" />';
			echo '</form>';
		}

		if(isset($_GET['insertDogImage'])) {

					$target_dir = "myDogs/";
					$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

					$newname = $_POST["mydID"];

					$full_local_path ='myDogs/'.$newname.'.png';
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					if(isset($_POST["submit"])) {
    					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
   						if($check !== false) {
       		 				$uploadOk = 1;
    					} else {
       						$uploadOk = 0;
    					}
					}

					if (file_exists($target_file)) {
    					$uploadOk = 0;
					}

					if ($_FILES["fileToUpload"]["size"] > 500000) {
    					$uploadOk = 0;
					}

					if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG" && $imageFileType != "gif" && $imageFileType != "GIF") {
    					$uploadOk = 0;
					}

					if ($uploadOk == 0) {
    					echo "<p id='error>Det gick inte att ladda upp bilden</p>";
					// if everything is ok, try to upload file
					} else {
    					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $full_local_path)) {
    						echo "Bild har laddats upp";
   						} else {
      						echo "<p id='error>Det gick inte att ladda upp bilden</p>";
    					}
					}

					if(isset($_POST['fileToUpload'])) {
					}
		}

	?>

	<h2>Lägg till stamtavla till hund</h2>

	<?php

		$sql = "SELECT * FROM pedigreeDog";
		$result = mysqli_query($db_conn, $sql);


		if (mysqli_num_rows($result) > 0) {
			echo '<form id="blogPost_form" action="?insertPedigree" method="POST" enctype="multipart/form-data">';
			echo '<select name="pdID">';
			while($row = mysqli_fetch_assoc($result)) {
				echo '<option value="'  . $row["pdID"] . '">' . $row["pName"] . '</option>';

			}
			echo '</select><br><br>';
			echo '<div class="row">
					<label for="Title">Far:</label><br />
					<input id="title" class="input" name="pFather" type="text" size="30" /><br />
					</div>';
			echo '<div class="row">
					<label for="Title">Mor:</label><br />
					<input id="title" class="input" name="pMother" type="text" size="30" /><br />
					</div>';
			echo '<input id="submit_button" type="submit" value="Lägg till" />';
			echo '</form>';
		}

		if(isset($_GET['insertPedigree'])) {

			$pdID = $_POST['pdID'];
			$pFather = $_POST['pFather'];
			$pMother = $_POST['pMother'];


			$query = "UPDATE pedigreeDog SET pFather = '{$pFather}', pMother = '{$pMother}' WHERE pdID = '{$pdID}'";

    		if (mysqli_query($db_conn, $query)) {
    			echo "Föräldrar har skapats";
			} else {
    			echo "<p id='error'>Det gick inte att skapa föräldrar</p>";
			}

			$query2 = "INSERT INTO pedigreeDog (pName)
    		VALUES ('{$pFather}'),
    				('{$pMother}')";

    		if (mysqli_query($db_conn, $query2)) {
			} else {
			}
					
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