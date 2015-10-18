<?php

	ini_set('display_errors',1); 
	error_reporting(E_ALL);
	include("./include/misc.php");
	database::connect();
	mysql_query("insert into temp values(NULL)") or die(mysql_error());


?>