<?php
	include("../include/misc.php");
?>
<?php
	if(isset($_GET['network']) && isset($_GET['rate']))
	{
		database::connect();
		$network=$_GET['network'];
		$rate=$_GET['rate'];
		mysql_query("insert into network_rating values(null,'$network',$rate)");
		database::disconnect();
	}
?>