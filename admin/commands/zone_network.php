<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		include("../include/misc.php");
		database::connect();
		if(isset($_GET['view']))
			$view=$_GET['view'];
		else
			$view='zone';		
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
<div id='zone_network_action_panel' class='entry'>
	<form name='zone_network_form'>
		<table border=0px>
			<tr>
				<td>
					<select name='zones'>
						<option value=''>Select Zone...</option>
						<?php 
							$create_zone_result=mysql_query("select * from zones");
							while($row=mysql_fetch_assoc($create_zone_result))
							{
								echo "<option value='".$row['zone_id']."'>".$row['zone_name']."</option>";
							}
						?>
					</select>
				</td>
				<td>
					<select name='networks'>
						<option value=''>Select Network...</option>
						<?php
							$create_network_result=mysql_query("select * from networks");
							while($row=mysql_fetch_assoc($create_network_result))
							{
								echo "<option value='".$row['network_id']."'>".$row['network_name']."</option>";
							}
						?>
					</select>
				</td>
				<td>
					<select name='type_available'>
						<option value='1'>Pre Paid Only</option>
						<option value='0'>Post Paid Only</option>
						<option value='2'>Both (Pre Paid and Post Paid)</option>
					</select>
				</td>
				<td>
					<input type='button' onClick="createZoneNetwork()" value="CREATE">
				</td>
			</tr>
		</table>
	</form>

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
				echo "<tr><td colspan=4><span class='table_heading' style='font-weight:900;'>".tellZoneName($z_result['zone_id'])."</span></td></tr>";
				while($row=mysql_fetch_assoc($zone_network_result))
				{
					echo "<tr><td>".tellNetworkName($row['network_id'])."</td><td>".tellType($row['type_available'])."</td><td style='padding:4px 5px;'><input type='button' onClick='delZoneNetwork(".$row['id'].")' value='DELETE'/></td><td style='padding:4px 5px;'><input type='button' onClick='upgradeZoneNetwork(".$row['id'].")' value='UPGRADE'/></td><tr>";
				}
			}
		}
		else if($v=='network')
		{
			$network_result=mysql_query("select DISTINCT(network_id) from zone_network");
			while($n_result=mysql_fetch_assoc($network_result))
			{
				$zone_network_result=mysql_query("select * from zone_network where network_id='".$n_result['network_id']."'");
				echo "<tr><td colspan=4><span class='table_heading' style='font-weight:900;'>".tellNetworkName($n_result['network_id'])."</span></td></tr>";
				while($row=mysql_fetch_assoc($zone_network_result))
				{
					echo "<tr><td>".tellZoneName($row['zone_id'])."</td><td>".tellType($row['type_available'])."</td><td style='padding:4px 5px;'><input type='button' onClick='delZoneNetwork(".$row['id'].")' value='DELETE'/></td><td style='padding:4px 5px;'><input type='button' onClick='upgradeZoneNetwork(".$row['id'].")' value='UPGRADE'/></td></tr>";
				}
			}	
		}
	}
?>