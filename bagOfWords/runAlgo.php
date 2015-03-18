<?php 
$myfile = fopen("wordArray.txt", "r") or die("Unable to open file!");
$a = fgets($myfile);
$GLOBALS["wordArray"] = unserialize($a);

$myfile2 = fopen("negativeWordArray.txt", "r") or die("Unable to open file!");
$GLOBALS["negativeWordArray"] = unserialize(fgets($myfile2));

$myfile3 = fopen("positiveWordArray.txt", "r") or die("Unable to open file!");
$GLOBALS["positiveWordArray"] = unserialize(fgets($myfile3));

$myfile4 = fopen("returnCountArray.txt", "r") or die("Unable to open file!");
$GLOBALS["returnCountArray"] = unserialize(fgets($myfile4));
function returnMaximum($a)
{
	$g = $GLOBALS["wordArray"][$a]["g"];
	$b = $GLOBALS["wordArray"][$a]["b"];
	$n = $GLOBALS["wordArray"][$a]["n"];
	$gCount = $GLOBALS["returnCountArray"]["g"];
	$bCount = $GLOBALS["returnCountArray"]["b"];
	$nCount = $GLOBALS["returnCountArray"]["n"];
	if ( (  ($g/$gCount) > ($b/$bCount) ) && ( ($g/$gCount) > ($n/$nCount) ) )
	{
		return "g";
	}
	else if ( ( ($b/$bCount) > ($g/$gCount) ) && ( ($b/$bCount) > ($n/$nCount)  )  )
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
		if (in_array($value, $GLOBALS["positiveWordArray"]))
		{
			$score += 1;
		}
		else if (array_key_exists($value, $GLOBALS["wordArray"]))
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
	$returnArray = array();
	if ($score > 0)
	{
		$returnArray[0] = $score;
		$returnArray[1] = "g";
	}
	else if ($score < 0)
	{
		$returnArray[0] = $score;
		$returnArray[1] = "b";
	}
	else
	{
		$returnArray[0] = $score;
		$returnArray[1] = "n";
	}
	return $returnArray;
	
}


?>