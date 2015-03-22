<?php 
$myfile = fopen("wordArray.txt", "r") or die("Unable to open file!");
$a = fgets($myfile);
$GLOBALS["wordArray"] = unserialize($a);

$myfile2 = fopen("negativeWordArray.txt", "r") or die("Unable to open file!");
$GLOBALS["negativeWordArray"] = unserialize(fgets($myfile2));

function returnMaximum($a)
{
	$g = $GLOBALS["wordArray"][$a]["g"];
	$b = $GLOBALS["wordArray"][$a]["b"];
	$n = $GLOBALS["wordArray"][$a]["n"];
	if ($g > $b && $g > $n)
	{
		return "g";
	}
	else if ($b > $g && $b > $n)
	{
		return "b";
	}
	else
		return "n";
}
function returnSentiment($a)
{
	$temp = explode(" ", trim(strtolower($a)));
	$score = 0;
	foreach ($temp as $key => $value) 
	{
		if (array_key_exists($value, $GLOBALS["wordArray"]))
		{
			 if (returnMaximum($value) == "g")
			 {
			 	$score += 1;
			 }
			 else if (returnMaximum($value) == "b")
			 {
			 	$score -= 1;
			 }
		}
		else if (in_array($value, $GLOBALS["negativeWordArray"]))
		{
			$score -= 1;
		}
	
	}
	if ($score > 0)
		return "g";
	else if ($score < 0)
		return "b";
	else
		return "n";
	
}

echo returnSentiment("  insulting insultingly ");
?>