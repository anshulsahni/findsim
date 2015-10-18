<?php
	session_start();
	if(isset($_SESSION['username']))
		include("./include/misc.php");
	else
		header("Location: ./login.php");
?>

<html>
<head>
	<title>FIND SIM ADMIN PANEL</title>
	<link rel="stylesheet" type="text/css" href="./css/admin.css">

	<script type="text/javascript" src="./js/admin.js"></script>
	<script type="text/javascript" src="./js/plan.js"></script>
</head>
<body>
	<?php include("./include/header.inc"); ?>
	<div id='wrapper'>
		<div id='container'>
			<div id='command_panel'>
				<span class='adminMsg'>Select the option you want to view or edit</span>
					<ul>
						<li>
							<input type='button' id='btn1' onClick="selectCommand('zones')" value='ZONES'>
						</li>
						<li>
							<input type='button' id='btn5' onClick="selectCommand('networks')" value='NETWORKS'>
						</li>
						<li>
							<input type='button' id='btn2' onClick="selectCommand('zone_network')" value='ZONES AND NETWORKS'>
						</li>
						<li>
							<input type='button' id='btn3' onClick="selectCommand('plan_category')" value='PLAN CATEGORY'>
						</li>
						<li>
							<input type='button' id='btn4' onClick="selectCommand('plans')" value='PLANS'>
						</li>
					</ul>
				</div>
				<div id='action_panel'>


				</div>
		</div>
</body>
</html>