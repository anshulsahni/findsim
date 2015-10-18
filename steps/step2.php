<?php
	include("../include/misc.php");
?>
<?php
	session_start();
	if (isset($_POST['email']))
	{
		database::connect();
		$_SESSION['email_addr']=$email=$_POST['email'];
		mysql_query("insert into emails values(null,'$email')");
		database::disconnect();
	}
	$_SESSION['type']=$_POST['type'];
	$zone=$_SESSION['zone']=$_POST['zone'];

?>
<?php
	database::connect();
	$network_result=mysql_query("select networks.selected,networks.rating,networks.no_of_comments,networks.network_id,networks.network_name from zone_network,networks where 
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
				 		 	
				 		 	<span class='selected_counts'><span class='selected_counts_1'>".$row['selected']."</span><br><span class='selected_counts_2'>Selected</span></span>
				 		 	<span class='comment_counts' title='Click to see the comments' onClick='showcomments(&#39;networks&#39;,&#39;".$row['network_id']."&#39;)'><span class='comment_counts_1'>".$row['no_of_comments']."</span><br><span class='comment_counts_2'>comments</span></span>				 		 	
				 		 	<span class='step2_rating_band_wrapper'>
								<span class='step2_rating_container'>";
								for ($i=1; $i<=round($row['rating']); $i++)
									echo "<img src='./imgs/rated.png'>";
								for ($i=1; $i<=(5-round($row['rating'])); $i++)
									echo "<img src='./imgs/unrated.png'>";
				echo 
								"</span>
							</span>
							<span class='icon_img'><img src='./imgs/icons/".$row['network_id'].".png'></span>
				 		 </div>";
				}
			?>
		</form>	
	</div>
	<div id='step2_navigation_bar' class='step_navigation_bar'>
		<div style='float:left'>
			<input type='button' value='Back' class='navigation_buttons' onClick="loadDataStep1()">
		</div>
		<div style='float:right;'>
			<input type='button' onClick="loadDataStep3()" value='Proceed' class='navigation_buttons'>
		</div>
	</div>
</div>
