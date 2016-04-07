	<time>
		

	<?php
	$filename = $_SERVER['SCRIPT_FILENAME'];
    if (file_exists($filename)) {
        echo "Sidan senast uppdaterad: " . date ("F d Y H:i:s.", filemtime($filename)) . "<br>";
    }

		echo  date("F d Y H:i:s.") . "<br>";
	?>
	</time>