<?php
	include("../include/misc.php");
	session_start();
?>

<?php
	if(isset($_GET['table']) && isset($_GET['val']))
	{
		$table=$_GET['table'];
		$val=$_GET['val'];
		database::connect();
		if($table=="networks")
			$comments=mysql_query("select * from network_comments where network_id='$val'");
		else if($table=="plan_category")
			$comments=mysql_query("select * from plan_cat_comments where category_id='$val'");
		else if($table=="plans")
			$comments=mysql_query("select * from plan_comments where plan_id=$val");	
		echo "<p style='text-align:left; font-size:22px; margin-top:20px;' class='msg' >Comments By Our Users...</p>";
		echo "<table class='step7_comment_table'>";
		if(mysql_num_rows($comments)>0)
		{			
			while($row=mysql_fetch_assoc($comments))
			{
				$comment=$row['comment'];
				$email=$row['email_id'];
				$s_email=$_SESSION['email_addr'];
				$likes=$row['likes'];
				$sno=$row['sno'];
				$like_verify=mysql_query("select * from likes where email_id='$s_email' and comment_table='$table' and comment_id=$sno") or die(mysql_error());
				if (mysql_num_rows($like_verify)>0)
					$like_button=false;
				else
					$like_button=true;
				echo "
						<tr><td><span class='step7_comment_comment'>$comment</span><span class='step7_comment_likes'>$likes Likes</td></tr>
						<tr><td><span class='step7_comment_email'>By: $email</span>". ($like_button?"<span class='like_button' onClick='like(&#39;$table&#39;,$sno,this)'>Like</span>":"") ."</td></tr>
						<tr><td><hr></td></tr>
						";
			}
		}
		else
			{echo "<tr><td><span class='step7_no_comments_available'>No Comments available</span></td></tr>";}
		echo "
				<tr><td style='padding:5px 0px'>
						<input type='text' name='comment_input' placeholder='Give Your Comment' maxlength=255 class='comment_input'>
						<input type='button' onClick='comment_submit(&#39;".$table."&#39;,&#39;".$val."&#39;)' value='Comment' class='comment_input'>
				</td></tr>
			";
		echo "</table>";


	}

?>