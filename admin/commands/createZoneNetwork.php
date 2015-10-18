<?php
	session_start();
	if(isset($_SESSION['username']) && isset($_GET['zone_id']) && isset($_GET['network_id']))
	{
		include("../include/misc.php");
		database::connect();
		$zone_id=$_GET['zone_id'];
		$network_id=$_GET['network_id'];
		$type_available=$_GET['type_available'];
		$zone_network_result=mysql_query("select * from zone_network where zone_id='$zone_id' and network_id='$network_id'");
		if(mysql_num_rows($zone_network_result)>0)
			echo "Submitted values already exist in the database";
		else
		{
			generate_key:
				$key=rand(100,999);
				$r=mysql_query("select id from zone_network where id=$key");
				if(mysql_num_rows($r)>0)
					goto generate_key;

			mysql_query("insert into zone_network values ($key,'$network_id','$zone_id',$type_available)") or die(mysql_error());
			echo "New Network and Zone combination created";
		}
		database::disconnect();
	}
	else
		echo "anshul";
?>