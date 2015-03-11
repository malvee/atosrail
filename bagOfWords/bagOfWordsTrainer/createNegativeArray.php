<?php
$myfile = fopen("negativeWords.txt", "r") or die("Unable to open file!");
$negativeWordsArray = array();
$c = 0;
while (!feof($myfile))
{
	$a = trim(fgets($myfile));
	if ($a !== "")
	{
		$negativeWordsArray[$c] = $a;
	}
	$c++;
}
$write = serialize($negativeWordsArray);
$a = fopen("negativeWordArray.txt", "w") or die("Unable to open file!");
fwrite($a, $write);


?>