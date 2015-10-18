<?php
	include("../include/misc.php");
	session_start();
?>
<?php
	if(isset($_GET['table']) && isset($_GET['val']))
	{
		$table=$_GET['table'];
		$val=$_GET['val'];
		$comment=$_GET['comment'];
		$email=$_SESSION['email_addr'];
		database::connect();

		if($table=='networks')
			mysql_query("insert into network_comments values (null,'$val','$comment','$email',0)") or die(mysql_error());
		else if($table=='plan_category')
			mysql_query("insert into plan_cat_comments values (null,'$val','$comment','$email',0)");
		else if($table=='plans')
			mysql_query("insert into plan_comments values (null,'$val','$comment','$email',0)");
		database::disconnect();
	}

?>