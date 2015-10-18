<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		include("../include/misc.php");
		database::connect();
		$zones_result=mysql_query("select * from zones");
		database::disconnect();
	}	
		else
		{
			header("Location: ../login.php");
		}


?>
<div id='zones' class='command_response'>
	<table border="1px">
		<tr>
			<th>ZoneId(2 Characters)</th>
			<th>Zone Name</th>
		</tr>
		<?php
			while($row=mysql_fetch_assoc($zones_result))
			{
				
				echo"
					<tr>
						<td>".$row['zone_id']."</td>".
						"<td>".$row['zone_name']."</td>".
						"<td style='padding:4px 5px;'><input type='button' value='DELETE' onClick='zoneDelete(&#39;".$row['zone_id']."&#39;)'></td>".
					"</tr>";
			}
		?>
	</table>
</div>
<div id='zone_entry' class='entry'>
	<div id='form_holder'>
		<form name='zone_form'>
			<table>
				<tr>
					<td><input type='text' name='zone_id' placeholder='New Zone Id'></td>
					<td><input type='text' name='zone_name' placeholder='New Zone Name'></td>
					<td>
						<input type='button' name='zone_create' onClick="zoneCreate()" value='CREATE'> 
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>