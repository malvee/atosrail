<?php 
$b = 0;
$g = 0;
$n = 0; 
$myfile = fopen("1.txt", "r") or die("Unable to open file!");
while (!feof($myfile))
{
	$a =  substr(trim(fgets($myfile)), -1);
	if ($a !== "")
	{
		if ($a == "g")
		{
			$g++;
		}
		else if($a == "b")
		{
			$b++;
		}
		else if($a == "n")
		{
			$n++;
		}
	}
	
}

$myfile = fopen("2b.txt", "r") or die("Unable to open file!");
while (!feof($myfile))
{
	$a =  substr(trim(fgets($myfile)), -1);
	if ($a !== "")
	{
		if ($a == "g")
		{
			$g++;
		}
		else if($a == "b")
		{
			$b++;
		}
		else if($a == "n")
		{
			$n++;
		}
	}
	
}

$myfile = fopen("3cleaned.txt", "r") or die("Unable to open file!");
while (!feof($myfile))
{
	$a =  substr(trim(fgets($myfile)), -1);
	if ($a !== "")
	{
		if ($a == "g")
		{
			$g++;
		}
		else if($a == "b")
		{
			$b++;
		}
		else if($a == "n")
		{
			$n++;
		}
	}
	
}
$array = array();
$array["g"] = $g;
$array["b"] = $b;
$array["n"] = $n;
$write = serialize($array);
$a = fopen("returnCountArray.txt", "w") or die("Unable to open file!");
fwrite($a, $write);


?>