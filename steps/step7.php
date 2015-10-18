<?php 
	// if(!(isset($_SESSION['email_addr'])))
		// die("Invalid Entry");
	include("../include/misc.php"); 
?>
<?php
	database::connect();
		$networks=mysql_query("select * from networks");	
		$plan_categories=mysql_query("select * from plan_category");
		$plans=mysql_query("select 
								plans.sno,plans.amt,
								zones.zone_name,networks.network_name,plan_category.category_name
							from
								plans,zones,networks,plan_category
							where
								plans.zone_id=zones.zone_id and
								plans.network_id=networks.network_id and
								plans.plan_cat=plan_category.category_id
								");
?>
<div id='step7' class='steps' style='width:800px;'>
	<p style='text-align:left; font-size:25px;' class='msg' >Feel Free to add Your Comments.....</p>
	<div style='top:50px; width:800px;'>
		<div style='margin:0px auto; display:table;'>
		<form name='step7_holder'>
		<p style='text-align:left; font-size:25px;' class='msg' >Comment the networks....</p>
		<select name='networks' onChange="show_step7_comments('networks')">
			<option value=''>Select Network...</option>
			<?php
				while($row=mysql_fetch_assoc($networks))
					echo "<option value='".$row['network_id']."'>".$row['network_name']."</option>";
			?>
		</select>
		<br><br>
		<p style='text-align:left; font-size:25px;' class='msg' >Comment the plan category....</p>
		<select name='plan_category' onChange="show_step7_comments('plan_category')">
			<option value=''>Select Category...</option>
			<?php
				while($row=mysql_fetch_assoc($plan_categories))
					echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";
			?>
		</select>
		<br><br>
		<p style='text-align:left; font-size:25px;' class='msg' >Comment the plans....</p>
		<select name='plans' onChange="show_step7_comments('plans')">
			<option value=''>Select Plan...</option>
			<?php
				while($row=mysql_fetch_assoc($plans))
					echo "<option style='white-space:pre;' value='".$row['sno']."'>".$row['zone_name']."       ".$row['network_name']."  ".$row['category_name']."  ".$row['amt']."</option>";
			?>
		</select>
		</form>
		</div>
		<div id='step7_comments'>


		</div>	 	
	</div>
</div>
