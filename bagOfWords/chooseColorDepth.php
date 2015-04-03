<?php

function decideGoodColorDepth($a)
	{
		if($a == 1 || $a==2)
			{
				return "goodColor1";
			}
			else if($a == 3 || $a==4)
			{
				return "goodColor2";
			}
			else if($a == 5 || $a == 6)
			{
				return "goodColor3";
			}
			else if($a == 7 || $a==8)
			{
				return "goodColor4";
			}
			else if($a >= 9)
			{
				return "goodColor5";
			}
	}

	function decideBadColorDepth($a)
	{
			if($a == -1 || $a==-2)
			{
				return "badColor1";
			}
			else if($a == -3 || $a== -4)
			{
				return "badColor2";
			}
			else if($a == -5 || $a == -6)
			{
				return "badColor3";
			}
			else if($a == -7 || $a== -8)
			{
				return "badColor4";
			}
			else if($a <= -9)
			{
				return "badColor5";
			}
	}

?>