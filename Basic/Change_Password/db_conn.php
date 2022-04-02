<?php

$sname= "localhost";
$unmae= "eblpaki3";
$password = "-rp7]lJa1Y1I3U";

$db_name = "eblpaki3_basic";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}