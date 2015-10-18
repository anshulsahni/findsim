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
	<p style='text-align:left; font-size:25px;' class='msg' >Fill the details....</p>
	<div style='top:50px;'>
		<table border=0px id='step1_table'>
			<tr><td>
				<input type='text' placeholder="Enter Your Email" id='email_text_box' maxlength=50>
			</tr></td>
			<tr><td>
				<select id='type_dropdown'>
					<option value='1'>PrePaid Plan</option>
					<option value='0'>PostPaid Plan</option>					
				</select>
			</tr></td>
			<tr><td>
				<select id='zone_scrolldown' class='scroll_input'>
					<?php
						while($row=mysql_fetch_assoc($zone_result))
						{
							echo "<option value='".$row['zone_id']."'>".$row['zone_name']."</option>";
						}
					?>
				</select>
			</tr></td>
		</table>
	</div>
	<div id='step1_navigation_bar' class='step_navigation_bar'>
		<div style='float:right;'>
			<input type='button' onClick="loadDataStep2()" value='Go To Next Step' class='navigation_buttons'>
		</div>
	</div>	
</div>