<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		include("../include/misc.php");
		database::connect();
		$networks_result=mysql_query("select * from networks");
		database::disconnect();
	}	
	else
	{
		header("Location: ../login.php");
	}

?>
<div id='networks' class='command_response'>
	<table border="1px">
		<tr>
			<th>NetworkId(2 Characters)</th>
			<th>Network Name</th>
		</tr>
		<?php
			while($row=mysql_fetch_assoc($networks_result))
			{
				
				echo"
					<tr>
						<td>".$row['network_id']."</td>".
						"<td>".$row['network_name']."</td>".
						"<td style='padding:4px 5px;'><input type=button value='DELETE' onClick='networkDelete(&#39;".$row['network_id']."&#39;)'></td>".
					"</tr>";
			}
		?>
	</table>
</div>
<div id='network_entry' class='entry'>
	<div id='form_holder'>
		<form name='network_form'>
			<table>
				<tr>
					<td><input type='text' name='network_id' placeholder='New Network Id'></td>
					<td><input type='text' name='network_name' placeholder='New Network Name'></td>
					<td>
						<input type='button' name='network_create' onClick="networkCreate()" value='CREATE'>
					</td>					
				</tr>
			</table>
		</form>
	</div>
</div>