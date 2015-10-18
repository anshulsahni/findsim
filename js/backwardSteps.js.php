<?php session_start(); ?>
function loadBackwardStep1()
{
	loadStep(1,'');
}

function loadBackwardStep2()
{
	var data=("zone="+"<?php echo $_SESSION['zone'];?>");
	loadStep(2,data);
	selectActive(2);
}

function loadBackwardStep3()
{
	var data=("networks="+'<?php echo $_SESSION['networks'];?>');
	loadStep(3,data);
	selectActive(3);
}