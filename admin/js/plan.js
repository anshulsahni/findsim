function loadZones()
{
	var val=document.forms['plan_form'].elements['network'].value;
	xml=createAjaxObj();
	xml.open("get","./commands/load.php?type=network&val="+val,true);
	xml.send();
	xml.onreadystatechange=function(){
		if (xml.readyState==4 && xml.status==200)
		{
			document.forms['plan_form'].elements['zone'].innerHTML=xml.responseText;
		}
	}
}
function loadType()
{
	var val1=document.forms['plan_form'].elements['zone'].value;
	var val2=document.forms['plan_form'].elements['network'].value;
	xml=createAjaxObj();
	xml.open("get","./commands/load.php?type=type&val1="+val1+"&val2="+val2,true);
	xml.send();
	xml.onreadystatechange=function(){
		if(xml.readyState==4 && xml.status==200)
		{
			document.forms['plan_form'].elements['type'].innerHTML=xml.responseText;
		}
	}
}
function plan_del(val)
{
	xml=createAjaxObj();
	xml.open("get","./commands/del_plan.php?val=+"+val,true);
	xml.send();
	xml.onreadystatechange=function(){
		if(xml.readyState==4 && xml.status==200)
		{
			selectCommand('plans');
		}
	}
}
function plan_create()
{
	var flag=true;
	var elements=new Array();
	for(var i=0; i<12;i++)
		elements[i]=document.forms['plan_form'].elements[i].value;

	for(var i=0;i<12;i++)
	{
		if(elements[i].length==0)
		{
			alert("Fill all the values in the form");
			flag=false; break;
		}
	}
	if (flag==true)
	{
		xml=createAjaxObj();
		xml.open("get","./commands/plan_create.php?network="+elements[0]+"&zone="+elements[1]+"&plan_cat="+elements[2]+"&type="+elements[3]+"&amt="+elements[4]+"&talktime="+elements[5]+"&data2g="+elements[6]+"&data3g="+elements[7]+"&validity="+elements[8]+"&msgs="+elements[9]+"&other="+elements[10]+"&comment="+elements[11],true);
		xml.send();
		xml.onreadystatechange=function()
		{
			if(xml.readyState==4 && xml.status==200)
			{				
				selectCommand('plans');
			}
		}
	}
}