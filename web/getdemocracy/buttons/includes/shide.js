function allOff()
{
	var one = document.getElementById('buttons-180150-dn').style;
	one.display = "none";
	var two = document.getElementById('buttons-180150-mac').style;
	two.display = "none";
	var three = document.getElementById('buttons-180150-itv').style;
	three.display = "none";
	var three = document.getElementById('buttons-180150-os').style;
	three.display = "none";
	var one = document.getElementById('buttons-18060-dn').style;
	one.display = "none";
	var two = document.getElementById('buttons-18060-mac').style;
	two.display = "none";
	var three = document.getElementById('buttons-18060-itv').style;
	three.display = "none";
	var three = document.getElementById('buttons-18060-os').style;
	three.display = "none";
	var one = document.getElementById('buttons-12060-dn').style;
	one.display = "none";
	var two = document.getElementById('buttons-12060-mac').style;
	two.display = "none";
	var three = document.getElementById('buttons-12060-itv').style;
	three.display = "none";
	var three = document.getElementById('buttons-12060-os').style;
	three.display = "none";
	var three = document.getElementById('buttons-8831').style;
	three.display = "none";
}

function turnOn(layer)
{
	allOff();
	var style2 = document.getElementById(layer).style;
    style2.display = "block";
}