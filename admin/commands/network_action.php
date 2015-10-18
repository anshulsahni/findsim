<?php
	session_start();
	include("../include/misc.php");
	database::connect();
	if(isset($_SESSION['username']) && $_GET['action']=='delete')
	{
		$id=$_GET['network_id'];
		$del=mysql_query("select * from networks where network_id='$id'") or die(mysql_error());
		if(mysql_num_rows($del)>0)
		{
			mysql_query("delete from networks where network_id='$id'") or die("Cannot Delete the requested data as it is associated with other zones and plans in the database");
			echo "Requested Data has been deleted";
		}
		else
			echo "Requested Data not Found in database";

	}
	else if(isset($_SESSION['username']) && $_GET['action']=='create')
	{
		$id=$_GET['network_id'];
		$name=$_GET['network_name'];
		$create_zone=mysql_query("select * from networks where network_id='$id'");
		if(mysql_num_rows($create_zone)==0)
		{
			mysql_query("insert into networks values('$id','$name')");
			echo "New network $name with id $id has been created";
		}
		else
			echo "Submitted values of network id already exist";
	}
	database::disconnect();
?>