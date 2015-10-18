<?php
	include("../include/misc.php");
?>
<?php
	session_start();
	$_SESSION['categories']=$_POST['categories'];
	$categories=json_decode($_SESSION['categories']);
	$networks=json_decode($_SESSION['networks']);
	$zone=$_SESSION['zone'];
	$type=$_SESSION['type'];
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
	<span id='reset' onClick='deselectAllInStep4()'>Deselect All...</span>
	<div style='top:50px;'>
	<form name='option_container'>
		<?php
			database::connect();
			foreach ($categories as $category)
				mysql_query("update plan_category set selected=selected+1 where category_id='$category'");
			foreach ($networks as $network)
			{
					$temp_result=mysql_query("select network_name from networks where network_id='$network'") or die(mysql_error());
					$temp_result=mysql_fetch_assoc($temp_result);
					echo "<hr><span class='icon_img_step4' style=''><img src='./imgs/icons/".$network.".png'></span><hr>";
					foreach ($categories as $category)
					{
						$temp_result=mysql_query("select category_name from plan_category where category_id='$category'");
						$temp_result=mysql_fetch_assoc($temp_result);
						echo "<span class='step4_category_name'>".$temp_result['category_name']."</span><br>";

						echo "<table border=1px class='step4_table'>
								<tr style='background-color:#042B64;'>
									<th></th><th>Cost</th><th>TalkTime</th><th>2G Data</th><th>3G Data</th><th>Validity</th><th>Messages</th><th>Other</th><th>No. Of Comments</th><th>No. Of Times Selected</th>
								</tr>
								<tr><td colspan=10 class='postpre'>".($type==1?"PrePaid":"PostPaid")."</td></tr>";
						$plan_result=mysql_query("select * from plans where network_id='$network' and plan_cat='$category' and zone_id='$zone' and type=$type") or die(mysql_error());
						if(mysql_num_rows($plan_result)==0)
							echo"<tr><td colspan=10 class='no_plan_available'>No Plan Available</td></tr>";
						else
						{
							while($row=mysql_fetch_assoc($plan_result))
							{
								echo "<tr>
										<td><input type='radio' name='$zone$network$category$type' value='".$row['sno']."'></td>
										<td>".$row['amt']."</td><td>".$row['talktime']."</td><td>".$row['data2g']."</td><td>".$row['data3g']."</td><td>".$row['validity']."</td><td>".$row['msgs']."</td><td>".$row['other']."</td><td class='comment_counts' style='text-decoration:underline; color:#c00; font-weight:700; font-style:italic;'onClick='showcomments(&#39;plans&#39;,&#39;".$row['sno']."&#39;)' title='This plan got ".$row['no_of_comments']." comments. Please click to see the comments'>".$row['no_of_comments']."</td><td class='comment_counts' style='color:#c00; font-weight:700; font-style:italic;' title='This plan got ".$row['selected']." times selected'>".$row['selected']."</td>
									</tr>";

							}
						}
						// echo "<tr><td colspan=8 class='postpre'>Post Paid</td></tr>";
						// $plan_result=mysql_query("select * from plans where network_id='$network' and plan_cat='$category' and zone_id='zone' and type=0") or die(mysql_error());
						// if(mysql_num_rows($plan_result)==0)
						// 	echo "<tr><td colspan=8 class='no_plan_available'>No Plan Available</td></tr>";
						// else
						// {	
						// 	while($row=mysql_fetch_assoc($plan_result))
						// 	{
						// 		echo "<tr>
						// 				<td>".$row['amt']."</td><td>".$row['talktime']."</td><td>".$row['data2g']."</td><td>".$row['data3g']."</td><td>".$row['validity']."</td><td>".$row['msgs']."</td><td>".$row['other']."</td><td>".$row['comment']."</td>
						// 			</tr>";
						// 	}
						// }
						echo "</table><br>";
					}
				echo "<br><br>";
			}
			database::disconnect();
		?>
	</form>
	</div>
	<div id='step4_navigation_bar' class='step_navigation_bar'>
		<div style='float:right'>
			<input type='button' value='Proceed' class='navigation_buttons' onClick='loadDataStep5()'>
		</div>
		<div style='float:left'>
			<input type='button' value='Back' class='navigation_buttons' onClick="eval(document.getElementById('ajax_js_response').innerHTML)">
		</div>
	</div>
</div>