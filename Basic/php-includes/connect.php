<?php
	$db_host = "localhost";
	$db_user = "eblpaki3";
	$db_pass = "Adilhassan008.";
	$db_name = "eblpaki3_basic";

	
	// $db_host = "localhost";
	// $db_user = "root";
	// $db_pass = "";
	// $db_name = "eblpaki3_basic";
	
	$con =  mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if(mysqli_connect_error()){
		echo 'connect to database failed';
	}

	function get_setting($c, $var)
	{
		if($var){
			$query = mysqli_query($c,"select * from settings where variable='$var' AND status=1");
			$result = mysqli_fetch_array($query);
			if($result){
				return $result['value'];
			}
			return null;
		}
		return null;
	}
?>
