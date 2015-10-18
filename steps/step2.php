<?php
	include("../include/misc.php");
?>
<?php
	session_start();
	$zone=$_SESSION['zone']=$_POST['zone'];
	database::connect();
	$network_result=mysql_query("select networks.network_id,networks.network_name from zone_network,networks where 
		zone_network.zone_id='$zone' and zone_network.network_id=networks.network_id") or die(mysql_error());
	database::disconnect();	
?>
<head>
	<script type="text/javascript" id='ajax_js_response'></script>
</head>
<div id='step2' class='steps'>
	<p style='text-align:left; font-size:25px;' class='msg' >Select From Available Networks....</p>
	<div style='top:50px;'>
		<form name='select_zones' method='post'>
			<?php
				while($row=mysql_fetch_assoc($network_result))
				{
					echo "<div class='option_wrapper'>
						  	<div class='box_wrapper'>
				 		 		<input class='checkbox' type='checkbox' name='networks[]' value='".$row['network_id']."'>
				 		 	</div>
				 		 	<span class='network_name'>".$row['network_name']."</span>
				 		 </div>";
				}
			?>
		</form>	
	</div>
	<div id='step2_navigation_bar' class='step_navigation_bar' style='background-color:red;'>
		<div style='float:left'>
			<input type='button' value='Back' class='navigation_buttons' onClick="loadDataStep1()">
		</div>
		<div style='float:right;'>
			<input type='button' onClick="loadDataStep3()" value='Proceed' class='navigation_buttons'>
		</div>
	</div>
</div>
