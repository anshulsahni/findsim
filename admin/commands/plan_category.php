<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		include("../include/misc.php");
		database::connect();
		$category_result=mysql_query("select * from plan_category");
		database::disconnect();
	}	
		else
		{
			header("Location: ../login.php");
		}

?>
<div id='plan_categories' class='command_response'>
	<table border="1px">
		<tr>
			<th>CategoryId(2 Characters)</th>
			<th>Category Name</th>
		</tr>
		<?php
			while($row=mysql_fetch_assoc($category_result))
			{
				
				echo"
					<tr>
						<td>".$row['category_id']."</td>".
						"<td>".$row['category_name']."</td>".
						"<td style='padding:4px 5px;'><input type='button' value='DELETE' onClick='categoryDelete(&#39;".$row['category_id']."&#39;)'></td>";
					"</tr>";
			}
		?>
	</table>
</div>
<div id='category_entry' class='entry'>
	<div id='form_holder'>
		<form name='category_form'>
			<table>
				<tr>
					<td><input type='text' name='category_id' placeholder='New Category Id'></td>
					<td><input type='text' name='category_name' placeholder='New Category Name'></td>
					<td>
						<input type='button' name='category_create' onClick="categoryCreate()" value='CREATE'>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>