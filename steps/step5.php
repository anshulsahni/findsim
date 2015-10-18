<?php
 	include("../include/misc.php");
 	session_start();
 	$plan_ids=$_SESSION['plan_ids']=json_decode($_POST['plan_ids']);
 	$plan_names=$_SESSION['plan_names']=json_decode($_POST['plan_names']);
?>
<head>
	<script type="text/javascript" id='ajax_js_response'>
			var data=('categories=<?php echo $_SESSION['categories'];?>');
			loadStep(4,data);
			selectActive(4);
	</script>
</head>
<div id='step5' class='steps'>
	<p style='text-align:left; font-size:25px;' class='msg' >Select Your Favorite.....</p>
	<div style='top:50px; width:800px; height:100%'>
		<?php
			$network_keys=array();
			$plan_cluster=array();
			foreach ($plan_names as $key)
				{ 	array_push($network_keys,substr($key,2,2)); }	
			$network_keys=array_unique($network_keys);

			foreach ($network_keys as $key)
			 	{ 	$plan_cluster[$key]=array(); }

			for($i=0;$i<count($plan_names);$i++)
			{
				$str=substr($plan_names[$i],2,2);
			 	array_push($plan_cluster[$str],$plan_ids[$i]);
			}
			database::connect();
			echo "<form name='step5_option_container'><ul id='step5_ul'>";
			foreach ($plan_cluster as $network=>$value)
			{
				echo "<li>";
				$network_name_result = mysql_query("select network_name from networks where network_id='$network'"); $network_name_result=mysql_fetch_assoc($network_name_result);
				echo "<div class='step5_network_name'><input type='radio' value='$network' name='step5_networks'>".$network_name_result['network_name']."</div><br>";
				$total=0;
				foreach ($value as $plan_id)
				{
					mysql_query("update plans set selected=selected+1 where sno=$plan_id") or die(mysql_error());
					$plans=mysql_query("select plan_category.category_name,plans.amt 
										from 
											plan_category,plans 
										where 
											plans.sno=$plan_id and plans.plan_cat=plan_category.category_id");
					$plans=mysql_fetch_assoc($plans);
					echo "<span class='step5_category_name'>".$plans['category_name']."</span><span class='step5_amt'>".$plans['amt']."</span><br>";
					$total+=$plans['amt'];
				}
				echo "<div class='step5_total_band'><span class='step5_total'>Total</span><span class='step5_total_figure'>".$total."</span></div>";
				echo "<div class='step5_network_icon'><img src='./imgs/icons/$network.png'></div>";
				echo "</li>";
			}
			echo "</ul></form>";
		?>
	</div>
	<div id='step5_navigation_bar' class='step_navigation_bar'>
		<div style='float:left'>
			<input type='button' value='Back' class='navigation_buttons' onClick="eval(document.getElementById('ajax_js_response').innerHTML)">
		</div>
		<div style='float:right'>
			<input type='button' value='Proceed' class='navigation_buttons' onClick='loadDataStep6()'>
		</div>
	</div>
</div>