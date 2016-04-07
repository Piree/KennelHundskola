<?php
	session_start();
	require 'db_connect.php';

	if(isset($_POST['username'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM User WHERE username='{$username}' AND password='{$password}' LIMIT 1";
    $result = mysqli_query($db_conn, $query);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if(mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $row["username"];
        $_SESSION['role'] = $row["role"];
        header('Location: login.php');
    } else {
    	$_SESSION['loggedIn'] = 'false';
        header('Location: login.php?loginError');
    }
}

?>

<?php

	if(isset($_GET['changeUsername'])) {
			$changeUsername = $_POST['changeUsername'];
			$changePassword = $_POST['changePassword'];
			$theNewUsername = $_POST['theNewUsername'];

			$query = "UPDATE User SET username='{$theNewUsername}' WHERE username='{$changeUsername}' AND password='{$changePassword}'";

			if (mysqli_query($db_conn, $query)) {
			} else {
			}
	}

	if(isset($_GET['changePassword'])) {
			$changeUsername = $_POST['changeUsername'];
			$changePassword = $_POST['changePassword'];
			$theNewPassword = $_POST['theNewPassword'];

			$query = "UPDATE User SET password='{$theNewPassword}' WHERE username='{$changeUsername}' AND password='{$changePassword}'";

			if (mysqli_query($db_conn, $query)) {
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
		
		<?php if(!isset($_SESSION['username'])): ?>

		<div>
		<form method="post" action="login.php">
			<label for="myUsername">*Användarnamn:</label>
				<input type="text" id="myUsernameLogin" name="username" required="required">

			<label for="myPassword">*Lösernord:</label>
				<input type="password" id="myPasswordLogin" name="password" required="required">

			<input type="submit" value="Logga in" id="mySubmitLogin" name="submit">
		</form>
		</div>

		<?php else: ?>
			<p>Användare:
			<b><?php echo $_SESSION['username']; ?></b><br>
			<a href="logout.php" tite="Logout">Logout</a></p>

		<?php
		$sql = "SELECT username, password FROM User";
		$result = mysqli_query($db_conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			echo "<table><tr><th>Username</th><th>Lösenord</th></tr>";
			while($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>" . $row["username"] . "";
				echo '<form method="post" action="login.php?changeUser">
						<input type="submit" value="Ändra" id="myChangeUsername" name="change">
						<input type="hidden" value='. $row['username'] .' name="changeUsername2">
					</form>';

					if(isset($_GET['changeUser'])) {
						if( $row['username'] == $_POST['changeUsername2']) {
						echo '<form method="post" action="login.php?changeUsername">
								<input type="text" id="changeUsername" name="theNewUsername" required="required" size="10">
								<input type="submit" value="Spara" id="myChangeUsername" name="change">
								<input type="hidden" value='. $row['username'] .' name="changeUsername">
								<input type="hidden" value='. $row['password'] .' name="changePassword">
							</form>';
						}
					}
				echo "</td>";
				echo "<td>" . $row["password"] . "";
				echo '<form method="post" action="login.php?changeUserPW">
						<input type="submit" value="Ändra" id="myChangeUser" name="change">
						<input type="hidden" value='. $row['username'] .' name="changeUsername2">
					</form>';

					if(isset($_GET['changeUserPW'])) {
						if( $row['username'] == $_POST['changeUsername2']) {
						echo '<form method="post" action="login.php?changePassword">
								<input type="text" id="changePassword" name="theNewPassword" required="required" size="10">
								<input type="submit" value="Spara" id="myChangePassword" name="change">
								<input type="hidden" value='. $row['username'] .' name="changeUsername">
								<input type="hidden" value='. $row['password'] .' name="changePassword">
							</form>';
						}
					}
				echo "</tr>";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}
		?>

		<?php
			if(isset($_GET['loginError'])) {
				echo '<p id="error">Fel användarnamn eller lösenord</p>';
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