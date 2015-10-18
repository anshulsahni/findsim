<?php
	include("../include/misc.php");
?>
<?php
	session_start();
	$_SESSION['categories']=$_POST['categories'];
	$categories=json_decode($_SESSION['categories']);
	$networks=json_decode($_SESSION['networks']);
	$zone=$_SESSION['zone'];
?>
<head>
	<script type="text/javascript" id='ajax_js_response'>
			var data=("networks="+'<?php echo $_SESSION['networks'];?>');
			loadStep(3,data);
			selectActive(3);
	</script>
</head>
<div id='step4' class='steps'>
	<p style='text-align:left; font-size:25px;' class='msg' >From Your Choices The available Plans are....</p>
	<div style='top:50px;'>
		<?php
			database::connect();
			foreach ($networks as $network)
			{
					$temp_result=mysql_query("select network_name from networks where network_id='$network'") or die(mysql_error());
					$temp_result=mysql_fetch_assoc($temp_result);
					echo "<hr><span class='step4_network_name'>".$temp_result['network_name']."</span><hr>";
					foreach ($categories as $category)
					{
						$temp_result=mysql_query("select category_name from plan_category where category_id='$category'");
						$temp_result=mysql_fetch_assoc($temp_result);
						echo "<span class='step4_category_name'>".$temp_result['category_name']."</span><br>";

						echo "<table border=1px class='step4_table'>
								<tr style='background-color:#042B64;'>
									<th>Cost</th><th>TalkTime</th><th>2G Data</th><th>3G Data</th><th>Validity</th><th>Messages</th><th>Other</th><th>Comments</th>
								</tr>
								<tr><td colspan=8 class='postpre'>Pre Paid</td></tr>";
						$plan_result=mysql_query("select * from plans where network_id='$network' and plan_cat='$category' and zone_id='$zone' and type=1") or die(mysql_error());
						if(mysql_num_rows($plan_result)==0)
							echo"<tr><td colspan=8 class='no_plan_available'>No Plan Available</td></tr>";
						else
						{
							while($row=mysql_fetch_assoc($plan_result))
							{
								echo "<tr>
										<td>".$row['amt']."</td><td>".$row['talktime']."</td><td>".$row['data2g']."</td><td>".$row['data3g']."</td><td>".$row['validity']."</td><td>".$row['msgs']."</td><td>".$row['other']."</td><td>".$row['comment']."</td>
									</tr>";

							}
						}
						echo "<tr><td colspan=8 class='postpre'>Post Paid</td></tr>";
						$plan_result=mysql_query("select * from plans where network_id='$network' and plan_cat='$category' and zone_id='zone' and type=0") or die(mysql_error());
						if(mysql_num_rows($plan_result)==0)
							echo "<tr><td colspan=8 class='no_plan_available'>No Plan Available</td></tr>";
						else
						{	
							while($row=mysql_fetch_assoc($plan_result))
							{
								echo "<tr>
										<td>".$row['amt']."</td><td>".$row['talktime']."</td><td>".$row['data2g']."</td><td>".$row['data3g']."</td><td>".$row['validity']."</td><td>".$row['msgs']."</td><td>".$row['other']."</td><td>".$row['comment']."</td>
									</tr>";
							}
						}
						echo "</table><br>";
					}
				echo "<br><br>";
			}
			database::disconnect();
		?>
	</div>
	<div id='step4_navigation_bar' class='step_navigation_bar' style='background-color:red;'>
		<div style='float:left'>
			<input type='button' value='Back' class='navigation_buttons' onClick="eval(document.getElementById('ajax_js_response').innerHTML)">
		</div>
	</div>
</div>