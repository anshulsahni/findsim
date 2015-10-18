function createAjaxObj()
{
	if(window.XMLHttpRequest)
		return new XMLHttpRequest();
	else
		return new ActiveXObject("Microsoft.XMLHTTP");
}

function selectCommand(file)
{
	xml=createAjaxObj();
	xml.open("GET","./commands/"+file+".php",true);
	xml.send();
	xml.onreadystatechange=function()
	{
		if(xml.readyState==4 && xml.status==200)
		{
			document.getElementById("action_panel").innerHTML=xml.responseText;
		}
	}
}

function zoneCreate()
{
	var zone_id=document.forms['zone_form'].elements['zone_id'].value;
	var zone_name=document.forms['zone_form'].elements['zone_name'].value;
		if(zone_id.length!=2 || zone_name.length==0 || zone_name.length>=40)
			alert("Invalid values entered for creating a zone");
		else
		{
			var xml=createAjaxObj();
			xml.open("get","./commands/zone_action.php?action=create&zone_id="+zone_id+"&zone_name="+zone_name,true);
			xml.send();
			xml.onreadystatechange=function()
			{
				if(xml.readyState==4 && xml.status==200)
					{ 	alert(xml.responseText);
						selectCommand('zones'); }
			}
		}
}

function zoneDelete(val)
{
	var xml=createAjaxObj();
	xml.open("get","./commands/zone_action.php?action=delete&zone_id="+val,true);
	xml.send();
	xml.onreadystatechange=function()
	{
		if(xml.readyState==4 && xml.status==200)
		{	alert(xml.responseText);
			selectCommand('zones');	}
	}
}

function networkCreate()
{
	var network_id=document.forms['network_form'].elements['network_id'].value;
	var network_name=document.forms['network_form'].elements['network_name'].value;
	
	if(network_id.length!=2 || network_name.length==0 || network_name.length>=40)
		alert("Invalid values entered for creating a zone");
	else
	{
		var xml=createAjaxObj();
		xml.open("get","./commands/network_action.php?action=create&network_id="+network_id+"&network_name="+network_name,true);
		xml.send();
		xml.onreadystatechange=function()
		{
			if(xml.readyState==4 && xml.status==200)
				{	alert(xml.responseText);
					selectCommand('networks'); }
		}	
	}
}

function networkDelete(val)
{
	var xml=createAjaxObj();
	xml.open("get","./commands/network_action.php?action=delete&network_id="+val,true);
	xml.send();
	xml.onreadystatechange=function()
	{
		if(xml.readyState==4 && xml.status==200)
			{	alert(xml.responseText);
				selectCommand('networks'); }
	}
}

function delZoneNetwork(val)
{
	xml=createAjaxObj();
	xml.open("get","./commands/delZoneNetwork.php?val="+val,true);
	xml.send();
	xml.onreadystatechange=function()
	{
		if(xml.readyState==4 && xml.status==200)
			{ alert(xml.responseText);
				selectCommand('zone_network'); }	
	}
}

function upgradeZoneNetwork(val)
{
	xml=createAjaxObj();
	xml.open("get","./commands/upgradeZoneNetwork.php?val="+val,true);
	xml.send();
	xml.onreadystatechange=function()
	{
		if(xml.readyState==4 && xml.status==200)
				selectCommand('zone_network');	
	}
}

function createZoneNetwork()
{
	var zones=document.forms['zone_network_form'].elements['zones'].value;
	var networks=document.forms['zone_network_form'].elements['networks'].value;
	var type_available=document.forms['zone_network_form'].elements['type_available'].value;
	if(zones.length!=0 && networks.length!=0)
	{
		xml=createAjaxObj();
		xml.open("get","./commands/createZoneNetwork.php?zone_id="+zones+"&network_id="+networks+"&type_available="+type_available,true);
		xml.send();
		xml.onreadystatechange=function()
		{
			if(xml.readyState==4 && xml.status==200)
				{ alert(xml.responseText);
					selectCommand('zone_network'); }
		}
	}
	else
		alert("Null Values are not accepted");
}
function categoryCreate()
{
	var category_id=document.forms['category_form'].elements['category_id'].value;
	var category_name=document.forms['category_form'].elements['category_name'].value;
	
		if(category_id.length!=2 || category_name.length==0 || category_name.length>=40)
			alert("Invalid values entered for creating a zone");
		else
		{
			var xml=createAjaxObj();
			xml.open("get","./commands/category_action.php?action=create&category_id="+category_id+"&category_name="+category_name,true);
			xml.send();
			xml.onreadystatechange=function()
			{
				if(xml.readyState==4 && xml.status==200)
					{ 	alert(xml.responseText);
						selectCommand('plan_category'); }
			}
		}
}
function categoryDelete(val)
{
	var xml=createAjaxObj();
	xml.open("get","./commands/category_action.php?action=delete&category_id="+val,true);
	xml.send();
	xml.onreadystatechange=function()
	{
		if(xml.readyState==4 && xml.status==200)
			{	alert(xml.responseText);
				selectCommand('plan_category'); } 
	}
}