<?php
	session_start();
	session_unset('email_addr');
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
							<li>Step0</li>
							<li>Step1</li>
							<li>Step2</li>
							<li>Step3</li>
							<li>Step4</li>
							<li>Step5</li>
						</ul>
					</div>
				</div>
				<div id='content_container'>

				</div>
			</div>
			<?php include("./include/footer.inc") ?>
		</div>
		<div id='comments'>
			<div id='comments_header'>Comments<span id='cross' onClick="hideComments()">X</span></div>
			<div id='comments_container'></div>
			<div id='comments_footer'></div>
		</div>
	</body>
</html>