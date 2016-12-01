<?php

/*to connect to your database*/
	$mysql_host = 'localhost';
	$mysql_user = 'algo_user';
	$mysql_pass = 'algo_user';
	$mysql_db = 'algo';
	
	if(!@($mysqli=new mysqli($mysql_host, $mysql_user, $mysql_pass,$mysql_db)) || $mysqli->connect_errno){
		echo 'not done';
		die();
	}

?>