<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		include("../include/misc.php");
		database::connect();
		$plan_result=mysql_query("select * from plans");
	}
	else
	{
		header("Location: ../login.php");
	}
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
	function tellPlanCat($val)
	{
		$result=mysql_query("select category_name from plan_category where category_id='$val'");
		$result=mysql_fetch_array($result);
		return $result[0];
	}
	function tellType($val)
	{
		if ($val==0)
			return "Post Paid";
		else if ($val==1)
			return "Pre Paid";
	}
?>
<div id='plans' class='command_response'>
	<table border="1px" style='width:1000px;'>
		<tr>
			<th>Serial No.</th>
			<th>Network</th>
			<th>Zone</th>
			<th>PostPaid/PrePaid</th>
			<th>Category of Plan</th>
			<th>Amount</th>
			<th>TalkTime</th>
			<th>2G Data</th>
			<th>3G Data</th>
			<th>Validity</th>
			<th>Messages</th>
			<th>Other</th>
			<th>Comments</th>
		</tr>
		<?php
			$i=1;
			while($row=mysql_fetch_assoc($plan_result))
			{
				echo "<tr>
					<td>$i</td>
					<td>".tellNetworkName($row['network_id'])."</td>
					<td>".tellZoneName($row['zone_id'])."</td>
					<td>".tellType($row['type'])."
					<td>".tellPlanCat($row['plan_cat'])."</td>
					<td>".$row['amt']."</td>
					<td>".$row['talktime']."</td>
					<td>".$row['data2g']."</td>
					<td>".$row['data3g']."</td>
					<td>".$row['validity']."</td>
					<td>".$row['msgs']."</td>
					<td>".$row['other']."</td>
					<td>".$row['comment']."</td>
					<td style='padding: 4px 5px'> <input type='button' onClick='plan_del(".$row['sno'].")' value='DELETE'>
					</tr>";
					$i++;
			}
		?>
	</table>
</div>
<br><br>
<div id='plan_entry'>
	<div id='form_holder'>
		<form name='plan_form'>
			<table class='form_table'>
				<tr>
					<td>
						<select name='network' onChange="loadZones()">
							<option value=''>Select Network...</option>						
							<?php 
								$plan_zone_result=mysql_query("select distinct(networks.network_id),networks.network_name from networks,zone_network where networks.network_id = zone_network.network_id ") or die(mysql_error());
								while($row=mysql_fetch_assoc($plan_zone_result))
								{
									echo "<option value='".$row['network_id']."'>".$row['network_name']."</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<select name='zone' onChange="loadType()">
							<option value=''>Select Zone...</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<select name='plan_cat'>
							<option value=''>Select Plan Category...</option>
							<?php
								$plan_zone_result=mysql_query("select * from plan_category") or die(mysql_error());
								while($row=mysql_fetch_assoc($plan_zone_result))
								{
									echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";	
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<select name='type'>
							<option value=''>Select Type...</option>
						</select>							
					</td>
				</tr>
				<tr> 	<td>	<input type='text' name='amt' placeholder='Enter Amount (Numbers Only)'>	</td>	</tr>
				<tr>	<td>	<input type='text' name='talktime' placeholder='Enter TalkTime' maxlength=25>		</td> 	</tr>
				<tr>	<td>	<input type='text' name='data2g' placeholder='Enter 2G Data' maxlength=25>		</td> 	</tr>
				<tr>	<td>	<input type='text' name='data3g' placeholder='Enter 3G Data' maxlength=25> 		</td> 	</tr>
				<tr>	<td>	<input type='text' name='validity' placeholder='Enter Validity' maxlength=25>		</td> 	</tr>
				<tr>	<td>	<input type='text' name='msgs' placeholder='Enter Messages' maxlength=25>			</td>	</tr>	
				<tr>	<td>	<input type='text' name='other' placeholder='Enter Any Other Details' maxlength=25>		</td> 	</tr>
				<tr>	<td>	<input type='text' name='comment' placeholder='Enter Comments' maxlength=30>		</td>	</tr>
				<tr>	<td>	<input type='button' onClick='plan_create()' value='CREATE NEW PLAN'> 	</td>	</tr>
			</table>
		</form>	
	</div>
</div>