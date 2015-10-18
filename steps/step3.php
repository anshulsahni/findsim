<?php
	include("../include/misc.php")
?>
<?php
	session_start();
	$_SESSION['networks']=$_POST['networks'];
	database::connect();
	$plan_cat=mysql_query("select * from plan_category") or die("Database Error");
	database::disconnect();
?>
<head>
	<script type="text/javascript" id='ajax_js_response'>
			var data=("zone="+'<?php echo $_SESSION['zone'];?>');
			loadStep(2,data);
			selectActive(2);
	</script>
</head>
<div id='step3' class='steps'>
	<p style='text-align:left; font-size:25px;' class='msg' >Select From Available Networks....</p>
	<div style='top:50px;'>
		<form>
			<?php
				while($row=mysql_fetch_assoc($plan_cat))
				{
					echo "<div class='option_wrapper'>
							  	<div class='box_wrapper'>
					 		 		<input class='checkbox' type='checkbox' name='category[]' value='".$row['category_id']."'>
					 		 	</div>
					 		<span class='network_name'>".$row['category_name']."</span>
					 		</div>";
				}
			?>
		</form>
	</div>
	<div id='step3_navigation_bar' class='step_navigation_bar' style='background-color:red;'>
		<div style='float:left'>
			<input type='button' value='Back' class='navigation_buttons' onClick="eval(document.getElementById('ajax_js_response').innerHTML)">
		</div>
		<div style='float:right;'>
			<input type='button' onClick="loadDataStep4()" value='Proceed' class='navigation_buttons'>
		</div>
	</div>
</div>