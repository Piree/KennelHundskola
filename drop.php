<?php require 'db_connect.php';?>

<?php
$sql = 'DELETE FROM MainPost WHERE postID = 23';

if (mysqli_query($db_conn, $sql)) {
    echo "Table deleted successfully";
} else {
    echo "Error creating table: " . mysqli_error($db_conn);
}

mysqli_close($db_conn);
?>