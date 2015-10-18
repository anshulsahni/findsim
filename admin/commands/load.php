<?php
	session_start();
	if(isset($_SESSION['username']))
		include("../include/misc.php");		
	else
		header("Location: ../login.php");
?>
<?php
	if(isset($_GET['type']) && isset($_GET['val']))
	{
		$type=$_GET['type'];
		$val=$_GET['val'];

		if($type=='network')
		{
			$out="<option value=''>Select Zone...</option>";
			database::connect();
			$result=mysql_query("select zones.zone_id,zones.zone_name from zone_network,zones where zone_network.network_id='$val' and zone_network.zone_id=zones.zone_id") or die(mysql_error());
			database::disconnect();
			while($row=mysql_fetch_assoc($result))
			{
				$out.="<option value='".$row['zone_id']."'>".$row['zone_name']."</option>";
			}
			echo $out;
		}
	}
	else if(isset($_GET['type']) && isset($_GET['val1']) && isset($_GET['val2']))
	{
		$type=$_GET['type'];
		$val1=$_GET['val1'];	
		$val2=$_GET['val2'];

		if($type=='type')
		{
			database::connect();
			$result=mysql_query("select type_available from zone_network where zone_id='$val1' and network_id='$val2'");
			database::disconnect();
			$result=mysql_fetch_array($result);
			switch($result[0])
			{
				case '0':
					$out="<option value='0'>Post Paid</option>";
					break;
				case '1':
					$out="<option value='1'>Pre Paid</option>";
					break;
				case '2':
					$out="<option value='1'>Pre Paid</option>";
					$out.="<option value='0'>Post Paid</option>";
					break;
			}
			echo $out;
		}
	}


















?>