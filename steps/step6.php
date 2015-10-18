<?php
	include("../include/misc.php");
	session_start();
?>

<?php
	database::connect();
	$network_result=mysql_query("select * from networks");

	$step5_networks=$_POST['step5_networks'];
	mysql_query("update networks set selected=selected+1 where network_id='$step5_networks'");
	$a=mysql_query("select network_name from networks where network_id='$step5_networks'");
	$a=mysql_fetch_assoc($a);
	$step5_networks=$a['network_name'];
	database::disconnect();

?>
<head>
	<script type="text/javascript" id='ajax_js_response'>
		$(".stars").mouseenter(function(){
			$(this).prevAll().andSelf().addClass('stars_hover');
			$(this).nextAll().removeClass('stars_hover');
		});
		$(".stars").click(function(){
			var network=document.getElementById('zone_scrolldown').value;
			var rate=$(this).attr('id');
			doRating(network,rate);
		});
	</script>
</head>
<div id='step6' class='steps' onmousemove="eval(document.getElementById('ajax_js_response').innerHTML)">
	<p style='text-align:left; font-size:25px;' class='msg' >Please Complete the following Survey...</p>
	<div style='top:50px;'>
		<div class='msg'><span style='font-weight:500'>You Chose </span><span style='color:red;'><?php echo $step5_networks; ?></span></div><br>
		<div class='msg'>Please Select Your Previous Network and Rate it...</div>
		<div id='dropdown_holder'>
			<select id='zone_scrolldown' class='scroll_input'>
				<?php
					while($row=mysql_fetch_assoc($network_result))
						echo "<option value='".$row['network_id']."'>".$row['network_name']."</option>";
				?>
			</select>			
		</div>
		<div id='rating_band_wrapper'>
			<div id='rating_container'>
				<div id='1' class='stars'></div>
				<div id='2' class='stars'></div>
				<div id='3' class='stars'></div>
				<div id='4' class='stars'></div>
				<div id='5' class='stars'></div>
			</div>
		</div>
	</div>
	<div id='final_message' style='display:none;'>
		<div class='msg' style='font-size:28px;'>
			Your Rating and Survey has been Recorded
		</div>
</div>
