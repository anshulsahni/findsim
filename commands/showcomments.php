<?php
	require("../include/misc.php");
	session_start();
?>
<?php
	if(isset($_GET['table']) && isset($_GET['id']))
	{
		$table=$_GET['table']; 
		$id=$_GET['id'];
		database::connect();
		if($table=="networks")
			$comments=mysql_query("select * from network_comments where network_id='$id'");
		else if($table=="plans")
			$comments=mysql_query("select * from plan_comments where plan_id=$id");
		else if($table=="plan_category")
			$comments=mysql_query("select * from plan_cat_comments where category_id='$id'");
		
		echo "<table class='comment_table'>";
		if(mysql_num_rows($comments)>0)
		{
			
			while($row=mysql_fetch_assoc($comments))
			{
				$comment=$row['comment'];
				$email=$row['email_id'];
				$likes=$row['likes'];
				$sno=$row['sno'];

				if (isset($_SESSION['email_addr']))
				{	
					$s_email=$_SESSION['email_addr'];
					// echo "select * from likes where email_id='$s_email' and comment_table='$table' and comment_id=$id";
					$like_verify=mysql_query("select * from likes where email_id='$s_email' and comment_table='$table' and comment_id=$sno") or die(mysql_error());
					if (mysql_num_rows($like_verify)>0)
						$like_button=false;
					else
						$like_button=true;
				}
				else
					$like_button=false;
				echo "
						<tr><td><span class='comment_comment'>$comment</span><span class='comment_likes'>$likes Likes</td></tr>
						<tr><td><span class='comment_email'>By: $email</span>".($like_button?"<span class='like_button' onClick='like(&#39;$table&#39;,$sno,this)'>Like</span>":"")."</td></tr>
						<tr><td><hr></td></tr>
						";
			}			
		}
		else
			echo "<tr><td><span class='no_comments_available'>No Comments available</span></td></tr>";

		if (isset($_SESSION['email_addr']))
		{
			echo "
					<tr><td style='padding:5px 0px'>
							<input type='text' name='comment_input' placeholder='Give Your Comment' maxlength=255 class='comment_input'>
							<input type='button' onClick='comment_submit(&#39;".$table."&#39;,&#39;".$id."&#39;)' value='Comment' class='comment_input'>
					</td></tr>
				";			
		}
		else
		{
			echo"
					<tr><td style='padding:5px 0px; text-align:center;'>
						<input type='button' name='enter_email' onClick='askAndSaveEmail(&#39;".$table."&#39;,&#39;".$id."&#39;)' value='Want to add a comment' class='enter_email'>
					</td></tr>
				";
		}
		echo "</table>";
	}
	database::disconnect();

?>