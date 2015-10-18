<?php
	if(isset($_SESSION))
		session_destroy();
?>

<html>
<head>
	<title>Find My Sim</title>
	<link rel="stylesheet" type="text/css" href="./css/index.css">

	<script type="text/javascript" src="./js/jquery.js"></script>
	<script type="text/javascript" src="./js/index.js"></script>
	

	<script type="text/javascript">
		$(document).ready(function(){
			loadDataStep1();
			selectActive(1);
		});

	</script>
</head>
<body>
	<div id='wrapper'>
		<?php include("./include/header.inc") ?>
		<div id='container'>
			<div id='navigation_container'>
				<div>
					<ul>
						<li>Step1</li>
						<li>Step2</li>
						<li>Step3</li>
						<li>Step4</li>
						<li>Step5</li>
						<li>Step6</li>
						<li>Step7</li>
					</ul>
				</div>
			</div>
			<div id='content_container'>

			</div>
		</div>
		<?php include("./include/footer.inc") ?>
	</div>
</body>
</html>