<?php 
$myfile = fopen("2b.txt", "r") or die("Unable to open file!");
$fileArray = array();
$c = 0;
while (!feof($myfile))
{
	$a = trim(fgets($myfile));
	if ($a !== "")
	{
		$fileArray[$c] = $a;
	}
	$c++;
	
}
$myfile2 = fopen("3cleaned.txt", "r") or die("Unable to open file!");
while (!feof($myfile2))
{
	$a = trim(fgets($myfile2));
	if ($a !== "")
	{
		$fileArray[$c] = $a;
	}
	$c++;
}
$myfile2 = fopen("1.txt", "r") or die("Unable to open file!");
while (!feof($myfile2))
{
	$a = trim(fgets($myfile2));
	if ($a !== "")
	{
		$fileArray[$c] = $a;
	}
	$c++;
}
$structuredArray = array();
$c = 0;
$temp = array();
foreach ($fileArray as $x)
{
	$temp = explode(">!!!<", $x);
	$z = trim( strtolower( preg_replace("([^a-zA-Z ]+)", "", preg_replace("([@#][^ ]?)", "", trim($temp[0])))));
	if($z !== "")
	{
		$structuredArray[$c]["text"] = $z;
		$structuredArray[$c]["sentiment"] = strtolower(trim($temp[1]));
		$c++;
	}

}

$wordArray = array("a" => array("g" => 0, "b" => 0, "n" => 0));

foreach($structuredArray as $x)
{
	$tempArray = array();
	$tempArray = explode(" ",$x["text"]);
	$currentSentiment = $x["sentiment"];
	foreach ($tempArray as $word)
	{
		if (!array_key_exists($word, $wordArray))
		{
			if ($currentSentiment == "g")
			{
				$wordArray[$word]["g"] = 1;
				$wordArray[$word]["b"] = 0;
				$wordArray[$word]["n"] = 0;
			}
			else if ($currentSentiment == "b")
			{
				$wordArray[$word]["b"] = 1;
				$wordArray[$word]["g"] = 0;
				$wordArray[$word]["n"] = 0;
			}
			else if ($currentSentiment== "n")
			{
				$wordArray[$word]["n"] = 1;
				$wordArray[$word]["b"] = 0;
				$wordArray[$word]["g"] = 0;
			}
		}
		else
		{
			if ($currentSentiment == "g")
			{
				$wordArray[$word]["g"] += 1;
			}
			else if ($currentSentiment == "b")
			{
				$wordArray[$word]["b"] += 1;

			}
			else if ($currentSentiment == "n")
			{
				$wordArray[$word]["n"] += 1;

			}
		}
	}

}
$myfile3 = fopen("stopWords.txt", "r") or die("Unable to open file!");
$stopWordsArray = array();
$stopWordsArray["the"] = 1;
while (!feof($myfile3))
{
	$a = trim(fgets($myfile3));
	if ($a !== "")
	{
		$stopWordsArray[$a] = 1;
	}
}

foreach($stopWordsArray as $index => $value)
{
	if(array_key_exists($index, $wordArray))
	{
		unset($wordArray[$index]);
	}
}
print_r($wordArray);
$write = serialize($wordArray);

$a = fopen("wordArray.txt", "w") or die("Unable to open file!");
fwrite($a, $write);


?>