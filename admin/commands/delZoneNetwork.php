<?php
	session_start();
	if($_SESSION['username'] && isset($_GET['val']))
	{
		$val=$_GET['val'];
		include("../include/misc.php");
		database::connect();
		mysql_query("delete from zone_network where id=$val") or die("Cannot Be Deleted As the selected combination have plans associated with it");
		echo "Requested data has been deleted";
		database::disconnect();
	}
?>