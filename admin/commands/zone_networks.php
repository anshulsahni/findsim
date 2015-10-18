<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		include("../include/misc.php");
		database::connect();
		if(isset($_GET['view']))
			$view=$_GET['view'];
		else
			$view='network';		
	}
	else
		header("Location: ../login.php");
?>
<?php
	function tellZoneName($val)
	{
		$result=mysql_query("select zone_name from zones where zone_id='$val'");
		$result=mysql_fetch_array($result);
		return $result[0];
	}

	function tellNetworkName($val)
	{
		$result=mysql_query("select network_name from networks where network_id='$val'");
		$result=mysql_fetch_array($result);
		return $result[0];
	}
	function tellType($val)
	{
		if ($val==0)
			return "Post Paid Only";
		else if ($val==1)
			return "Pre-Paid Only";
		else if ($val==2)
			return "Both";
	}

?>
<div id='zone_network' class='command_response'>
	<table border="1px">
		<?php 
			display_elements($view);		
		?>
	</table>
</div>
<?php
	function display_elements($v)
	{
		if($v=='zone')
		{
			$zone_result=mysql_query("select DISTINCT(zone_id) from zone_network");
			while($z_result=mysql_fetch_assoc($zone_result))
			{
				$zone_network_result=mysql_query("select * from zone_network where zone_id='".$z_result['zone_id']."'");
				echo "<tr><td colspan=2><span class='table_heading' style='font-weight:900;'>".tellZoneName($z_result['zone_id'])."</span></td></tr>";
				while($row=mysql_fetch_assoc($zone_network_result))
				{
					echo "<tr><td>".tellNetworkName($row['network_id'])."</td><td>".tellType($row['type_available'])."</td><tr>";
				}
			}
		}
		else if($v=='network')
		{
			$network_result=mysql_query("select DISTINCT(network_id) from zone_network");
			while($n_result=mysql_fetch_assoc($network_result))
			{
				$zone_network_result=mysql_query("select * from zone_network where network_id='".$n_result['network_id']."'");
				echo "<tr><td colspan=3><span class='table_heading' style='font-weight:900;'>".tellNetworkName($n_result['network_id'])."</span></td></tr>";
				while($row=mysql_fetch_assoc($zone_network_result))
				{
					echo "<tr><td>".tellZoneName($row['zone_id'])."</td><td>".tellType($row['type_available'])."</td><td><input type='button' onClick='delZoneNetwork(".$row['id'].")' /></td></tr>";
				}
			}	
		}
	}
?>