<?php
	session_start();
	include("../include/misc.php");
	database::connect();
	if(isset($_SESSION['username']) && $_GET['action']=='delete')
	{
		$id=$_GET['category_id'];
		$del=mysql_query("select * from plan_category where category_id='$id'");
		if(mysql_num_rows($del)>0)
		{
			mysql_query("delete from plan_category where category_id='$id'");
			echo "Requested Data has been deleted";
		}
		else
			echo "Requested Data not Found in database";
	}
	else if(isset($_SESSION['username']) && $_GET['action']=='create')
	{
		$id=$_GET['category_id'];
		$name=$_GET['category_name'];
		$create_zone=mysql_query("select * from plan_category where category_id='$id'") or die(mysql_error());
		if(mysql_num_rows($create_zone)==0)
		{
			mysql_query("insert into plan_category values('$id','$name')") or die(mysql_error());
			echo "New Plan Category $name with id $id has been created";
		}
		else
			echo "Submitted values of Plan Category id already exist";
	}
	database::disconnect();
?>