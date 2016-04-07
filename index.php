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

	<h3>Gör nytt inlägg</h3>

	<form id="blogPost_form" action="index.php?insertBlogPost" method="POST" enctype="multipart/form-data">
	<div class="row">
		<label for="Title">Titel:</label><br />
		<input id="title" class="input" name="title" type="text" size="30" /><br />
	</div>
	<div class="row">
		<label for="content">Meddelande:</label><br />
		<textarea id="content" class="input" name="content" rows="7" cols="35"></textarea><br />
	</div>
	<input type="file" name="fileToUpload" id="fileToUpload"><br>
	<input id="submit_button" type="submit" value="Lägg till" />
	</form>

	<?php

		if(isset($_GET['insertBlogPost'])) {

    	$title = $_POST['title'];
   		$content = $_POST['content'];

   		$query = "INSERT INTO MainPost (postTitle, postContent)
    	VALUES ('{$title}', '{$content}')";

    	if (mysqli_query($db_conn, $query)) {
    		echo "<b>Inlägg har skapats</b>";
		} else {
			echo "<p id='error'<Det gick inte att skapa inlägg</p>";
		}

		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

		$query2 ="SELECT * FROM MainPost ORDER BY postDate DESC LIMIT 1";
		$result = mysqli_query($db_conn, $query2);
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					$newname = $row["postID"];
				}
			}
		$full_local_path ='uploads/'.$newname.'.png';
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
    		header('Location: index.php');
   	} else {
    }
	}

	if(isset($_POST['fileToUpload'])) {
}

	}

	?>

	<?php endif; ?>

	<?php
		$sql = "SELECT postTitle, postContent, postDate, postID FROM MainPost ORDER BY postDate DESC";
		$result = mysqli_query($db_conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				echo "<h2>" . $row["postTitle"] ."</h2>";
				echo '<div><img src="uploads/' . $row['postID'] . '.png" width="200" onerror=';
				echo 'this.style.display="none"></div>';
				echo "" . $row["postContent"] ."";
				echo "<div id ='underImage'><p>" . $row["postDate"] ."</p></div>";
				

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