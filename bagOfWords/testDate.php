<html>
<?php
function findMinDif($x, $y, $z)
{
	$time = explode(":", $x);
	$index = 0;
	$TweettotalMin = 0;
	foreach ($time as $local) 
	{
	if ($index == 0)
 		$TweettotalMin += 60* $local;
 	if ($index == 1)
 		$TweettotalMin += $local;
 		$index++;
	}
	$realtotalMin = 60*$y + $z ;
	return $realtotalMin - $TweettotalMin;
}
function trimThat($x)
{
	$date2 = explode(" ", $x);
	$date2[0] = $date2[2]; 
	$date2[2] = " ";
	$date2[3] = " ";
	$date2[4] = " ";
	$date2[5] = " ";
	return implode(" ", $date2);
}
function extend($d)
{
	if(strlen($d) == 1)
		return "0" . $d ;
	else
		return $d;
}
function printIt($y, $x)
{
	$hours = floor($y / 60) - 1;
	$minutes = $y % 60 ;
	if($hours > 23)
		return trimThat($x);
	else
		if($hours == 0)
			return $minutes . " m" ;
		else
			return $hours. " h,". $minutes. " m";
}
function dateF($x)
{
	$tweetdates = explode(" ", $x);
	$localtime = getdate();
	$i = 0;
	foreach ($localtime as $local) 
	{
 		$nowdates[$i] = $local;
 		$i++;
	}
	$nowdates[2] += 8;
	
	if(strncmp($nowdates[8], $tweetdates[0], 3) == 0)  // same day of the week
		if(strncmp(extend($nowdates[3]), $tweetdates[2], 2) == 0)    // same day of the month
			if(strncmp($nowdates[9], $tweetdates[1], 3) == 0) // same month of the year
				if(strncmp($nowdates[6], $tweetdates[5], 4) == 0) // same year
				{
					$minutesdif = findMinDif($tweetdates[3], $nowdates[2], $nowdates[1]);
					$hours = floor($minutesdif / 60) - 1;
					$minutes = $minutesdif % 60 ;
					if($minutes == 0 && $hours == 0)
						return "A few seconds ago";
					else
						if($hours == 0)
							return $minutes . " m" ;
						else
							return $hours. " h,". $minutes. " m";
				}
				else
					return  trimThat($x) ;
			else
				return  trimThat($x) ;
		else
			return trimThat($x) ;
	else
	{
		switch($tweetdates[0])
		{
			case "Mon":
				if(strcmp($nowdates[8],"Tuesday") == 0)
				{
					$minutesdif = findMinDif($tweetdates[3], $nowdates[2], $nowdates[1]);
					$minutesdif += (24*60);
					return printIt($minutesdif, $x);
				}
				else
					return  trimThat($x);
				break;

			case "Tue":
				if(strcmp($nowdates[8],"Wednesday") == 0)
				{
					$minutesdif = findMinDif($tweetdates[3], $nowdates[2], $nowdates[1]);
					$minutesdif += (24*60);
					return printIt($minutesdif, $x);
				}
				else
					return  trimThat($x);
				break;

			case "Wed":
				if(strcmp($nowdates[8],"Thursday") == 0)
				{
					$minutesdif = findMinDif($tweetdates[3], $nowdates[2], $nowdates[1]);
					$minutesdif += (24*60);
					return printIt($minutesdif, $x);
				}
				else
					return  trimThat($x);
				break;

			case "Thu":
				if(strcmp($nowdates[8],"Friday") == 0)
				{
					$minutesdif = findMinDif($tweetdates[3], $nowdates[2], $nowdates[1]);
					$minutesdif += (24*60);
					return printIt($minutesdif, $x);
				}
				else
					return trimThat($x);
				break;

			case "Fri":
				if(strcmp($nowdates[8],"Saturday") == 0)
				{
					$minutesdif = findMinDif($tweetdates[3], $nowdates[2], $nowdates[1]);
					$minutesdif += (24*60);
					return printIt($minutesdif, $x);
				}
				else
					return trimThat($x);
				break;

			case "Sat":
				if(strcmp($nowdates[8],"Sunday") == 0)
				{
					$minutesdif = findMinDif($tweetdates[3], $nowdates[2], $nowdates[1]);
					$minutesdif += (24*60);
					return printIt($minutesdif, $x);
				}
				else
					return trimThat($x);
				break;

			case "Sun":
				if(strcmp($nowdates[8],"Monday") == 0)
				{
					$minutesdif = findMinDif($tweetdates[3], $nowdates[2], $nowdates[1]);
					$minutesdif += (24*60);
					return printIt($minutesdif, $x);
				}
				else
					return  trimThat($x);
				break;
		}
		
	}


}




?>
</html>