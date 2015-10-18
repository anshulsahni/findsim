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
}

function loadDataStep2()
{
	var val=document.getElementById('zone_scrolldown').value;
	var data=("zone="+val);
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
	if(c.length==0){alert("Please Select Atleast One Networks..."); return false;}
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
			// alert("clicked")
			c[i]=categories[x].value;
			i++;
		}
	}
	if(c.length==0){alert("Please select Atlease One Categories..."); return false;}
	var data=("categories="+JSON.stringify(c));
	loadStep(4,data);
	selectActive(4);

}

function loadDataStep5()
{

}

function loadDataStep6()
{

}