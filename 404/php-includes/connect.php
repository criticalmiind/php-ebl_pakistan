<?php
	$db_host = "localhost";
	$db_user = "eblpaki3";
	$db_pass = "Adilhassan008.";
	$db_name = "eblpaki3_basic";
	
	$con =  mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if(mysqli_connect_error()){
		echo 'connect to database failed';
	}
?>
