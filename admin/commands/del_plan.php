<?php
	session_start();
	if(isset($_SESSION['username']) && isset($_GET['val']))
	{
		$val=$_GET['val'];
		include("../include/misc.php");
		database::connect();
		$result=mysql_query("select * from plans where sno=$val") or die(mysql_error());
		if(mysql_num_rows($result)>0)
		{
			mysql_query("delete from plans where sno=$val") or die(mysql_error());
		}
		database::disconnect();
	}

?>