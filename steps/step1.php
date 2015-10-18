<?php
	include("../include/misc.php");
?>

<?php
	database::connect();
	$zone_result=mysql_query("select * from zones");
	database::disconnect();
?>
<head>
	<script type="text/javascript" id='ajax_js_response'></script>
</head>
<div id='step1' class='steps'>
	<p style='text-align:left; font-size:25px;' class='msg' >Select Your Zone....</p>
	<div style='top:50px;'>
		<select id='zone_scrolldown' class='scroll_input'>
			<?php
				while($row=mysql_fetch_assoc($zone_result))
				{
					echo "<option value='".$row['zone_id']."'>".$row['zone_name']."</option>";
				}
			?>
		</select>
	</div>
	<div id='step1_navigation_bar' class='step_navigation_bar' style='background-color:red;'>
		<div style='float:right;'>
			<input type='button' onClick="loadDataStep2()" value='Proceed' class='navigation_buttons'>
		</div>
	</div>	
</div>