<?php
	session_start();
	include("../include/misc.php");
	database::connect();
	if(isset($_SESSION['username']) && $_GET['action']=='delete')
	{
		$id=$_GET['zone_id'];
		$del=mysql_query("select * from zones where zone_id='$id'");
		if(mysql_num_rows($del)>0)
		{
			mysql_query("delete from zones where zone_id='$id'") or die("Requested zone cannot be deleted as it is associated with other networks and plans");
			echo "Requested Data has been deleted";
		}
		else
			echo "Requested Data not Found in database";

	}
	else if(isset($_SESSION['username']) && $_GET['action']=='create')
	{
		$id=$_GET['zone_id'];
		$name=$_GET['zone_name'];
		$create_zone=mysql_query("select * from zones where zone_id='$id'");
		if(mysql_num_rows($create_zone)==0)
		{
			mysql_query("insert into zones values('$id','$name')");
			echo "New zone $name with id $id has been created";
		}
		else
			echo "Submitted values of zone id already exist";
	}
	database::disconnect();

?>