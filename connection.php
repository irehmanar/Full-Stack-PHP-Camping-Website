<?php
$databaseHost = 'localhost';
$databaseName = 'project';
$databaseUsername = 'root';
$databasePassword = "rehman4163";
//add password here
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);


if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

