<?php
$myfile = fopen("positiveWords.txt", "r") or die("Unable to open file!");
$positiveWordsArray = array();
$c = 0;
while (!feof($myfile))
{
	$a = trim(fgets($myfile));
	if ($a !== "")
	{
		$positiveWordsArray[$c] = $a;
	}
	$c++;
}
$write = serialize($positiveWordsArray);
$a = fopen("positiveWordArray.txt", "w") or die("Unable to open file!");
fwrite($a, $write);


?>