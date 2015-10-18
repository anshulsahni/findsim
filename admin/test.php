<?php
	include("./include/misc.php");
	database::connect();
	$ansh=mysql_query("select * from zones where zone_id='ansh'");
	echo $ansh;


?>