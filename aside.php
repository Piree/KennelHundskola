<aside>
	<?php if(isset($_SESSION['username'])): ?>
	<a href="logout.php" tite="Logout">Logga ut</a>

	<h5>Lägg till reklam för kurser:</h5>

	<?php
		$sql = "SELECT * FROM Course";
		$result = mysqli_query($db_conn, $sql);


		if (mysqli_num_rows($result) > 0) {
			echo '<form id="blogPost_form" action="?newAdvertisement" method="POST" enctype="multipart/form-data">';
			echo '<select name="courseID">';
			echo '<option value=""></option>';
			while($row = mysqli_fetch_assoc($result)) {
				echo '<option value="'  . $row["courseID"] . '">' . $row["courseName"] . '</option>';

			}
		
			echo '</select><br><br>';
			echo '<input type="file" name="fileToUpload" id="fileToUpload"><br>';
			echo '<input id="submit_button" type="submit" value="Spara"/>';
			echo '</form>';

			if(isset($_GET['newAdvertisement'])) {

				$courseID = $_POST['courseID'];

				$sql = "SELECT * FROM Course WHERE courseID = '{$courseID}'";
				$result = mysqli_query($db_conn, $sql);
				while($row = mysqli_fetch_assoc($result)) {
					$adDate = $row['courseDate'];
					$courseName = $row['courseName'];

					$query = "INSERT INTO Advertisement (adName, adDate)
    				VALUES ('{$courseName}', '{$adDate}')";

    				if (mysqli_query($db_conn, $query)) {
					} else {
    					echo "Gick inte att lägga till annons";
					}

					$target_dir = "adUploads/";
					$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

					$query2 ="SELECT * FROM Advertisement ORDER BY adID DESC LIMIT 1";
					$result = mysqli_query($db_conn, $query2);
						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)) {
								$newname = $row["adID"];
							}
						}
					$full_local_path ='adUploads/'.$newname.'.png';
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
					} else {
    					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $full_local_path)) {
    						header('Location: guestbook.php');
   						} else {
    					}
					}

					if(isset($_POST['fileToUpload'])) {
					}
				}

		}
		} else {
		}

		$sql = "SELECT * FROM Litter";
		$result = mysqli_query($db_conn, $sql);


		if (mysqli_num_rows($result) > 0) {
			echo "<h5>Lägg till reklam för kullar:</h5>";
			echo '<form id="blogPost_form" action="?newAdvertisementLitter" method="POST" enctype="multipart/form-data">';
			echo '<select name="litterName">';
			echo '<option value=""></option>';
			while($row = mysqli_fetch_assoc($result)) {
				echo '<option value="'  . $row["litterName"] . '">' . $row["litterName"] . '</option>';

			}
		
			echo '</select><br><br>';
			echo '<input type="file" name="fileToUpload" id="fileToUpload"><br>';
			echo '<input id="submit_button" type="submit" value="Spara" />';
			echo '</form>';

			if(isset($_GET['newAdvertisementLitter'])) {

				$litterName = $_POST['litterName'];

				$sql = "SELECT * FROM Litter WHERE litterName = '{$litterName}'";
				$result = mysqli_query($db_conn, $sql);
				while($row = mysqli_fetch_assoc($result)) {
					$adDesc = $row['litterDesc'];
					$adName = $row['litterName'];

					$query = "INSERT INTO Advertisement (adName, adDesc)
    				VALUES ('{$adName}', '{$adDesc}')";

    				if (mysqli_query($db_conn, $query)) {
					} else {
    					echo "Gick inte att lägga till annons";
					}

					$target_dir = "adUploads/";
					$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

					$query2 ="SELECT * FROM Advertisement ORDER BY adID DESC LIMIT 1";
					$result = mysqli_query($db_conn, $query2);
						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)) {
								$newname = $row["adID"];
							}
						}
					$full_local_path ='adUploads/'.$newname.'.png';
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
   						} else {
    					}
					}

					if(isset($_POST['fileToUpload'])) {
					}
				}

		}
		} else {
		}

	?>

	<?php endif; ?>

	<?php
		$sql = "SELECT * FROM Advertisement WHERE adDesc IS NULL";
		$result = mysqli_query($db_conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {

				echo "<h2>" . $row["adName"] ."</h2>";
				echo '<div><img src="adUploads/' . $row['adID'] . '.png" width="100" onerror=';
				echo 'this.style.display="none"></div>';
				echo "<p id='white' ><b>" . $row["adDate"] ."</p></b>";
				echo "<a href='school.php'>Läs mer</a>";
			}
		} else {
		}

		$sql = "SELECT * FROM Advertisement WHERE adDate IS NULL";
		$result = mysqli_query($db_conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {

				echo "<h2>" . $row["adName"] ."</h2>";
				echo '<div><img src="adUploads/' . $row['adID'] . '.png" width="100" onerror=';
				echo 'this.style.display="none"></div>';
				echo "<p id='white'>" . $row["adDesc"] ."</p>";
				echo "<a href='kennel.php'>Läs mer</a>";
			}
		} else {
		}

	?>


</aside>