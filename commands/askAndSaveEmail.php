<?php
	include("../include/misc.php");
	session_start();
?>
<?php
	if(isset($_GET['email']))
	{
		database::connect();
		$_SESSION['email_addr']=$_GET['email'];
		mysql_query("insert into emails values(null,'".$_GET['email']."')");
		database::disconnect();
	}

?>