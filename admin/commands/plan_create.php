<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		include("../include/misc.php");
		database::connect();
		mysql_query("insert into plans values (null,'".$_GET['zone']."','".$_GET['network']."','".$_GET['plan_cat']."','".$_GET['type']."',".$_GET['amt'].",'".$_GET['talktime']."','".$_GET['data2g']."','".$_GET['data3g']."','".$_GET['validity']."','".$_GET['msgs']."','".$_GET['other']."','".$_GET['comment']."')") or die(mysql_error());
		database::disconnect();
	}
?>