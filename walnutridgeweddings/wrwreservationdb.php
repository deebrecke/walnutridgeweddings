<?php
$username = 'purplegr';
$password = '1+6DymgN6[PAf2';
$hostname = 'localhost';
$database = 'purplegr_wrwreservation';
$cnxn = @mysqli_connect($hostname, $username, $password, $database) or
die("Error Connecting to DB: " . mysqli_connect_error());

?>
