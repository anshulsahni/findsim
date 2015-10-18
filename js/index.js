function createAjaxObj()
{
	if(window.XMLHttpRequest)
		return new XMLHttpRequest();
	else
		return new ActiveXObject("Microsoft.XMLHTTP");
}

function selectActive(val)
{
	$('#navigation_container div ul li').addClass('non_active_menu').removeClass('active_menu');
	$("#navigation_container div ul li:eq("+(val-1)+")").removeClass('non_active_menu').addClass('active_menu');
}

function loadStep(val,post_data)
{
	xml=createAjaxObj();
	xml.open("post","./steps/step"+val+".php",true);
	xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xml.send(post_data);
	xml.onreadystatechange=function(){
		if(xml.readyState==4 && xml.status==200)
		{
			document.getElementById('content_container').innerHTML=xml.responseText;
		}
	}
}

function loadDataStep1()
{
	loadStep(1,'');
	selectActive(1);
}

function loadDataStep2()
{
	var val=document.getElementById('zone_scrolldown').value;
	var val1=document.getElementById('type_dropdown').value;	
	var val2=document.getElementById('email_text_box').value;
	if(val2.length!=0)
		var data=("zone="+val+"&type="+val1+"&email="+val2);
	else
		var data=("zone="+val+"&type="+val1);
	loadStep(2,data);
	selectActive(2);
}

function loadDataStep3()
{
	// networks=new Array();
	networks=document.getElementsByName('networks[]');
	var c= new Array();
	var i=0;
	for(var x in networks)
	{
		 if(networks[x].checked==true)
		 {
		 	c[i]=networks[x].value;
		 	i++;
		 }
	}
	if(c.length==0)	//{alert("please select atleast one of the networks"); return false;}
	{
		i=0;
		for(var x in networks)
		{
			if(networks[x].value!=null)
			{c[i]=networks[x].value;
			i++;}
		}
	}
	var data=("networks="+JSON.stringify(c));
	loadStep(3,data);
	selectActive(3);
}

function loadDataStep4()
{
	categories=document.getElementsByName('category[]');
	var c=new Array();
	var i=0;
	for(var x in categories)
	{
		if(categories[x].checked==true)
		{
			c[i]=categories[x].value;
			i++;
		}
	}
	if(c.length==0)		//{alert("Please select Atlease One Categories..."); return false;}
	{
		for(var x in categories)
		{
			if(categories[x].value!=null)
			{c[i]=categories[x].value;
				i++;}	
		}
	}
	var data=("categories="+JSON.stringify(c));
	loadStep(4,data);
	selectActive(4);

}

function loadDataStep5()
{
	var c= Array();
	var d= Array();
	var j=0;
	var option_array=document.forms['option_container'].elements;
	for(i=0;i<option_array.length;i++)
	{
		if(option_array[i].checked==true)
			{
				c[j]=option_array[i].value;
				d[j]=option_array[i].getAttribute('name');
				j++;
			}
	}
	if(c.length==0){alert("Please Select atleast one plan option"); return false;}
	var data=("plan_ids="+JSON.stringify(c)+"&plan_names="+JSON.stringify(d));
	loadStep(5,data);
	selectActive(5);
}

function loadDataStep6()
{
	var c = document.forms['step5_option_container'].elements['step5_networks'].value;
	var data=("step5_networks="+c);
	loadStep(6,data);
	selectActive(6);
}
function showcomments(val1,val2)
{
	xml=createAjaxObj();
	xml.open("get","./commands/showcomments.php?table="+val1+"&id="+val2,true);
	xml.send();
	xml.onreadystatechange=function()
	{
		if(xml.readyState==4 && xml.status==200)
		{
			document.getElementById('comments_container').innerHTML=xml.responseText;			
			$("#comments").fadeIn(500);			
		}
	}
}

//comment fuction
function hideComments()
{	$("#comments").fadeOut(); }

//step4 clear function
function deselectAllInStep4()
{	document.forms['option_container'].reset(); }

//rating function
function doRating(network,rate)
{
	var xml=createAjaxObj();
	xml.open("get","./commands/network_rate.php?network="+network+"&rate="+rate,true);
	xml.send();
	xml.onreadystatechange=function()
	{
		if(xml.readyState==4 && xml.status==200)
		{
			$("#step6").children().hide();
			$("#final_message").show();
		}
	}
}

//step7 functions
function show_step7_comments(table)
{
	var val=document.forms['step7_holder'].elements[table].value;
	if (val=='')
		return false;
	
	xml=createAjaxObj();
	xml.open("get","./commands/show_step7_comments.php?table="+table+"&val="+val,true);
	xml.send();
	xml.onreadystatechange=function()
	{
		if(xml.readyState==4 && xml.status==200)
		{
			document.getElementById('step7_comments').innerHTML=xml.responseText;
		}
	}
}
// like function
function like(table,val,thi)
{
	xml=createAjaxObj();
	xml.open("get","./commands/like.php?table="+table+"&val="+val,true);
	xml.send();
	xml.onreadystatechange=function()
	{
		if(xml.readyState==4 && xml.status==200)
		{
			$(thi).html(xml.responseText);
		}
	}
}
//comment submission
function comment_submit(table,val)
{
	var comment=document.getElementsByName('comment_input')[0].value;
	if (comment.length==0) {return false;}
	xml=createAjaxObj();
	xml.open("get","./commands/submit_comments.php?table="+table+"&val="+val+"&comment="+comment,true);
	xml.send();
	xml.onreadystatechange=function()
	{
		if(xml.readyState==4 && xml.status==200)
		{
			showcomments(table,val);
		}
	}
}
//function to ask and save the email in between the process
function askAndSaveEmail(table,val)
{
	var email_id=prompt("Enter your email id");
	if (email_id.length!=0)
	{
		xml=createAjaxObj();
		xml.open("get","./commands/askAndSaveEmail.php?email="+email_id,true);
		xml.send();
		xml.onreadystatechange=function()
		{
			if(xml.readyState==4 && xml.status==200)
			{
				showcomments(table,val);
			}
		}
	}
}
