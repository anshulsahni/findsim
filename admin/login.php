<?php
	require("./include/misc.php");
?>
<?php
	if(isset($_POST['login_submit']))
	{
		$user=htmlentities($_POST['usrname']);
		$pass=md5(htmlentities($_POST['password']));
		database::connect();
		$login_result=mysql_query("select * from admin_user where user_name='$user' and passwd='$pass'");
		if(mysql_num_rows($login_result)>0)
		{
			session_start();
			$_SESSION['username']=$user;
			header("Location: ./admin.php");
		}
		else
		{
			echo "<script type='text/javascript'>
					alert('Your UserName and Password is invalid for Login');
				</script>";
		}
	}
?>

<html>
<head>
	<title>FIND SIM LOGIN</title>
	<link rel="stylesheet" type="text/css" href="./css/login.css">
</head>
<body>
	<?php include("./include/header.inc"); ?>
	<div id='wrapper'>
		<div id='container'>
			<div id='login_container' >
				<form action='./login.php' name='login_form' method='post'>
					<table>
						<tr>
							<td>
								<input type='text' name='usrname' id='usr_name' placeholder='Enter User Name'>
							</td>
						</tr>
						<tr>
							<td>
								<input type='password' name='password' id='pass_word' placeholder='Enter Password'>
							</td>
						</tr>
					</table>
					<div id='login_btn_wrapper'>
						<input type='submit' name='login_submit' value='LOGIN'>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include("./include/footer.inc"); ?>
</body>
</html>