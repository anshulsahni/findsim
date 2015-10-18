<?php
	include("../include/misc.php");
?>
<?php
	if(isset($_GET['table']) && isset($_GET['val']))
	{
		session_start();
		$email=$_SESSION['email_addr'];
		$table=$_GET['table'];
		$val=$_GET['val'];
		database::connect();
			mysql_query("insert into likes values(null,'$table',$val,'$email')") or die(mysql_error());
		database::disconnect();
	}
?>