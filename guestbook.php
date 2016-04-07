<?php
	session_start();
	require 'db_connect.php';

	if(isset($_GET['insertGuestAnswer'])) {

		$name = $_POST['name'];
    	$title = ("" . $_POST["guesTitle"] . " Svar");
   		$content = $_POST['content'];
   		$answerID = $_POST['guestAnswerID'];


   		$query = "INSERT INTO GuestPost (guestName, guesTitle, guestContent, answerID)
    	VALUES ('{$name}', '{$title}', '{$content}', '{$answerID}')";

    	if (mysqli_query($db_conn, $query)) {
		} else {
		}

		$target_dir = "guestUploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

		$query2 ="SELECT * FROM GuestPost WHERE answerID = '{$answerID}' ORDER BY guestDate DESC LIMIT 1";
		$result = mysqli_query($db_conn, $query2);
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					$newname = $row["guestID"];
				}
			}
		$full_local_path ='guestUploads/'.$newname.'.png';
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
	// if everything is ok, try to upload file
	} else {
    	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $full_local_path)) {
    		header('Location: guestbook.php');
   	} else {
    }
	}

	if(isset($_POST['fileToUpload'])) {
}

	}

	if(isset($_GET['deletePost'])) {
				$guestID = $_POST['deletePostID'];

				$query = "DELETE FROM GuestPost WHERE guestID='{$guestID}'";

				if (mysqli_query($db_conn, $query)) {
				} else {
					echo "Det gick inte att ta bort: " . mysqli_error($db_conn);
				}
	}

	if(isset($_GET['ChangeGuestPost'])) {
				$guestID = $_POST['guestPostID'];
				$guestContent = $_POST['guestContent'];

				$query = "UPDATE GuestPost SET guestContent='{$guestContent}' WHERE guestID='{$guestID}'";

				if (mysqli_query($db_conn, $query)) {
				} else {
					echo "Det gick inte att ta bort: " . mysqli_error($db_conn);
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

	<h3>Gör inlägg!</h3>

	<form id="blogPost_form" action="guestbook.php?insertGuestPost" method="POST" enctype="multipart/form-data">
	<div class="row">
		<label for="Title">Namn:</label><br />
		<input id="title" class="input" name="name" type="text" size="30" required/><br />
	</div>
	<div class="row">
		<label for="Title">Titel:</label><br />
		<input id="title" class="input" name="title" type="text" size="30" required/><br />
	</div>
	<div class="row">
		<label for="content">Meddelande:</label><br />
		<textarea id="content" class="input" name="content" rows="7" cols="35" required></textarea><br />
	</div>
	<input type="file" name="fileToUpload" id="fileToUpload"><br>
	<input id="submit_button" type="submit" value="Lägg till" />
	</form>

	<?php

	if(isset($_GET['insertGuestPost'])) {

		$name = $_POST['name'];
    	$title = $_POST['title'];
   		$content = $_POST['content'];

   		$query = "INSERT INTO GuestPost (guestName, guesTitle, guestContent)
    	VALUES ('{$name}', '{$title}', '{$content}')";

    	if(empty($name) || empty($title) || empty($content)) {
    		echo "<p id='error'>Fyll i alla  fält!</p><br>";
    	}else if (mysqli_query($db_conn, $query)) {
    		echo "Inlägg har skapats";
		} else {
    		echo "<p id='error'>Det gick inte att skapa inlägg!</p>";
		}

		$target_dir = "guestUploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

		$query2 ="SELECT * FROM GuestPost ORDER BY guestDate DESC LIMIT 1";
		$result = mysqli_query($db_conn, $query2);
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					$newname = $row["guestID"];
				}
			}
		$full_local_path ='guestUploads/'.$newname.'.png';
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
	// if everything is ok, try to upload file
	} else {
    	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $full_local_path)) {
    		header('Location: guestbook.php');
   	} else {
    }
	}

	if(isset($_POST['fileToUpload'])) {
}

	}

	?>

	<?php
		$sql = "SELECT guestName, guesTitle, guestContent, guestDate, guestID FROM GuestPost WHERE answerID IS NULL ORDER BY guestDate DESC";
		$result = mysqli_query($db_conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {

				$answerID = $row["guestID"];

				echo "<h2>" . $row["guesTitle"] ."</h2>";
				echo '<div><img src="guestUploads/' . $row['guestID'] . '.png" width="200" onerror=';
				echo 'this.style.display="none"></div>';
				echo "" . $row["guestContent"] ."";
				echo '<div id ="underImage"><form id="formAnswer" method="post" action="guestbook.php?showAnswerForm">
						<input type="submit" value="Svara" id="ShowForm" name="show">
						<input type="hidden" value='. $row['guestID'] .' name="guestPostID">
					</form><b>'  . $row['guestName'] .'</b> '. $row["guestDate"] .'</p></div>';

				if(isset($_SESSION['username'])):
					echo '<div id ="underImage"><form id="formAnswer" method="post" action="guestbook.php?deletePost">
						<input type="hidden" value='. $row['guestID'] .' name="deletePostID">
										<button type="submit" style="border: 0; background: transparent">
    									<img src="images/trash.png" width="30" height="30" alt="ta bort" />
										</button></form><form id="formAnswer" method="post" action="guestbook.php?showChangeForm">
						<input type="hidden" value='. $row['guestID'] .' name="changePostID">
										<button type="submit" style="border: 0; background: transparent">
    									<img src="images/edit.png" width="30" height="30" alt="ta bort" />
										</button>
										<input type="hidden" value='. $row['guestID'] .' name="guestPostID"></form><br></div>';

					if(isset($_GET['showChangeForm'])) {
						if( $row['guestID'] == $_POST['guestPostID']) {
						echo '<form id="blogPost_form" action="guestbook.php?ChangeGuestPost" method="POST" enctype="multipart/form-data">
	<div class="row">
		<br><label for="content">Ändra:</label><br />
		<textarea id="content" class="input" value=' . $row["guestContent"] . ' name="guestContent" rows="7" cols="50">' . $row["guestContent"] . '</textarea><br />
	</div>
	<input id="submit_button" type="submit" value="Spara" />
	<input type="hidden" value='. $row['guestID'] .' name="guestPostID">
	</form>';
						}
					}

				endif;

				if(isset($_GET['showAnswerForm'])) {
					if( $row['guestID'] == $_POST['guestPostID']) {
						echo '<form id="blogPost_form" action="guestbook.php?insertGuestAnswer" method="POST" enctype="multipart/form-data">
	<div class="row">
		<label for="Title">Namn:</label><br />
		<input id="title" class="input" name="name" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="content">Meddelande:</label><br />
		<textarea id="content" class="input" name="content" rows="7" cols="50"></textarea><br />
	</div>
	<input type="file" name="fileToUpload" id="fileToUpload"><br>
	<input id="submit_button" type="submit" value="Lägg till" />
	<input type="hidden" value='. $row['guestID'] .' name="guestAnswerID">
	<input type="hidden" value='. $row['guesTitle'] .' name="guesTitle">
	</form>';
					}
						
				}

				$sql2 = "SELECT guestName, guesTitle, guestContent, guestDate, guestID, answerID FROM GuestPost WHERE answerID = '{$answerID}' ORDER BY guestDate";
				$result2 = mysqli_query($db_conn, $sql2);


				if (mysqli_num_rows($result2) > 0) {
					echo "<h3>Svar:</h3>";
					echo "<hr><br>";
					while($row = mysqli_fetch_assoc($result2)) {
						echo '<div><img src="guestUploads/' . $row['guestID'] . '.png" width="200" onerror=';
						echo 'this.style.display="none"></div>';
						echo "" . $row["guestContent"] ."";
						echo '<div id ="underImage"><b>'  . $row['guestName'] .'</b> '. $row["guestDate"] .'</p></div>';

						if(isset($_SESSION['username'])):
					echo '<div id ="underImage"><form id="formAnswer" method="post" action="guestbook.php?deletePost">
						<input type="hidden" value='. $row['guestID'] .' name="deletePostID">
										<button type="submit" style="border: 0; background: transparent">
    									<img src="images/trash.png" width="30" height="30" alt="ta bort" />
										</button></form><form id="formAnswer" method="post" action="guestbook.php?showChangeForm">
						<input type="hidden" value='. $row['guestID'] .' name="changePost">
										<button type="submit" style="border: 0; background: transparent">
    									<img src="images/edit.png" width="30" height="30" alt="ta bort" />
										</button>
										<input type="hidden" value='. $row['guestID'] .' name="guestPostID"></form><br></div><br><hr>';

						if(isset($_GET['showChangeForm'])) {
						if( $row['guestID'] == $_POST['guestPostID']) {
						echo '<form id="blogPost_form" action="guestbook.php?ChangeGuestPost" method="POST" enctype="multipart/form-data">
	<div class="row">
		<br><label for="content">Ändra:</label><br />
		<textarea id="content" class="input" value=' . $row["guestContent"] . ' name="guestContent" rows="7" cols="50">' . $row["guestContent"] . '</textarea><br />
	</div>
	<input id="submit_button" type="submit" value="Spara" />
	<input type="hidden" value='. $row['guestID'] .' name="guestPostID">
	</form>';
						}
					}
						endif;
					if(!isset($_SESSION['username'])):
						echo "<hr><br>";
						endif;
					}
				}

			}
		} else {
		}
	?>

	<?php if(isset($_SESSION['username'])): ?>


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