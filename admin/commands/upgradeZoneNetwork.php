<?php
	session_start();
	if($_SESSION['username'] && isset($_GET['val']))
	{
		$val=$_GET['val'];
		include("../include/misc.php");
		database::connect();
		mysql_query("update zone_network set type_available=2 where id=$val");
		database::disconnect();
	}
?>