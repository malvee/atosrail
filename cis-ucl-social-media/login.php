<html>
<body>
<?php
    include "testDate.php"; 
	ini_set('max_execution_time', 300);
	include "twitteroauth.php";
	include "DatumboxAPI.php";
	session_start();
	function addhref($x)
	{
		return "<a href=\"" . $x . "\" target=\"_blank\" > ". $x . "</a>" ;
	}
	function isLink($x)    // gets a string and prints out the links within it
	{	
		$words = explode(" ", $x);
		$counts = 0;
		foreach ($words as $word) 
		{
			if(strncmp("http://", $word, 7) == 0)
			{
				$replacement = array ($counts => addhref($word));
				$words = array_replace($words, $replacement);
			}
			$counts++;
		}
		return implode(" ", $words);
	}
	$host = "eu-cdbr-azure-north-b.cloudapp.net";
    $user = "b1ab8a4c6aa690";
    $pwd = "efd91e32";
    $db = "atosraiAaM0G4XAp";
    try 
    {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e)
    {
        die(var_dump($e));
    }
	if (isset($_POST["username"]) && isset($_POST["password"]))
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$sql_select = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
	    $stmt = $conn->query($sql_select);
	    $ans = $stmt->fetchAll();
		if (count($ans) == 0)
		{
			echo "Sorry No match found";
			$_SESSION["loggedIn"] = 0;
		}
		else
		{
			
			$queryArray = preg_split('/\s+/', trim($ans[0]["query"]));
			$twitterQueryString = "";
			foreach($queryArray as $x)
			{
				$twitterQueryString .= "%40".$x."%20OR%20"."%23".$x."%20OR%20";
			}
			$_SESSION["loggedIn"] = 1;
			$api_key='ba28ee0ae71432fe85206c36d0e6a641';
			$consumer = "5blMAfvgOmZBZyfM2usfcX97c";
			$counsumerSecret = "oYVA9roicxA0nVSX7kXujVnb0Eyn0EFpqy4cSpQ5ZpUyzxeaHQ";
			$accessToken = "2319828684-dXOy6CW1Mf7nsm32YMbH9qcwMLP8NtetGTxTAbC";
			$accessTokenSecret = "mp4svtYl7DQAWQmGCBAppHO5aBr8HVmB04T6xU4c7GK8E";
			$twitter = new TwitterOAuth($consumer, $counsumerSecret, $accessToken, $accessTokenSecret);
?>

			<title>ATOS Rail Sentiment</title>
			<meta name = "viewport" content = "width= device-width, initial-scale=1.0">
			<link href  = "../css/bootstrap.min.css" rel = "stylesheet">
			<link href  = "../css/styles.css" rel = "stylesheet">

			<!--****************Menu code links start*******************-->
			<link rel="shortcut icon" href="../favicon.ico"> 
			<link rel="stylesheet" type="text/css" href="css/component.css" />
			<script src="js/modernizr.custom.js"></script>
			<!--****************Menu code links end*******************-->
			
			<div class = "navbar navbar-default navbar-static-top">

		<div class ="container">

				<!-- ***********************************************************
										Menucon code start
					 ***********************************************************-->

			<!-- Codrops top bar -->
			
			<div class="main">
				
				<div class="side">
					<nav class="dr-menu">
						<div class="dr-trigger"><span class="dr-icon dr-icon-menu"></span><a class="dr-label">SEARCH</a></div>
						<ul>
							<?php
	$host = "eu-cdbr-azure-north-b.cloudapp.net";
    $user = "b1ab8a4c6aa690";
    $pwd = "efd91e32";
    $db = "atosraiAaM0G4XAp";

     $sql_select = "SELECT * FROM users WHERE username = 'daviddaly'";
    $stmt = $conn->query($sql_select);
    $ans = $stmt->fetchAll();
	$_GLOBALS["dbArray"] = preg_split('/\s+/', trim($ans[0]["query"]));
	if(!isset($_POST["array"]) || !isset($_POST["sentText"]) )
	{
		echo "<form action = test.php method = 'POST'>";
		foreach($_GLOBALS["dbArray"] as $x)
		{
			echo "<input type = 'checkbox' name = 'array[]' value = '$x' checked> $x ";
		}
		echo "<br>";
		echo "<input type = 'text' name = 'sentText'>";
		echo "<input type = 'submit'>"; 
		echo "</form>";
		echo "<br>";
		echo "<form action=\"login.php\">
    <input type=\"submit\" value=\"Go to App\">
	</form>";

	}
	else if ( isset($_POST["array"]))
	{
		$_GLOBALS["dbArray"] = array();
		foreach($_POST["array"] as $x)
		{
			array_push($_GLOBALS["dbArray"], $x);
		}
		$string = "";
		foreach($_GLOBALS["dbArray"] as $x)
		{
			$string .= (" ".$x);
		}
		$string = trim($string);
		$db -> query("UPDATE users SET query= '$string'  WHERE username='daviddaly'");
		$string = "";


		if ( isset($_POST["sentText"])  && (preg_replace('/\s+/', '', $_POST["sentText"]) !== "") )
		{
			$sentTextArray = preg_split('/\s+/', trim($_POST["sentText"]));
			foreach ($sentTextArray as $x)
			{
				$count = 0;
				foreach ($_GLOBALS["dbArray"] as $y)
				{
					if (!(strtolower($x) == strtolower($y)))
						$count++;
					else
						break;
				}
				if ($count == count($_GLOBALS["dbArray"]))
					array_push($_GLOBALS["dbArray"], $x);

			}
			$string = "";
			foreach($_GLOBALS["dbArray"] as $x)
			{
				$string .= (" ".$x);
			}
			$string = trim($string);
			$db -> query("UPDATE users SET query= '$string'  WHERE username='daviddaly'");
			$string = "";

			
		}
		echo "<form action = test.php method = 'POST'>";
		foreach($_GLOBALS["dbArray"] as $x)
		{
			echo "<input type = 'checkbox' name = 'array[]' value = '$x' checked> $x ";
		}
		echo "<br>";
		echo "<input type = 'text' name = 'sentText'>";
		echo "<input type = 'submit'>"; 
		echo "</form>";
		echo "<br>";
		echo "<form action=\"login.php\">
    <input type=\"submit\" value=\"Go to App\">
	</form>";
	 }
	 
    ?>
							<!--<li><a  href="#">Jason Quinn</a></li>
							<li><a  href="#">Videos</a></li>
							<li><a  href="#">Favorites</a></li>
							<li><a  href="#">Subscriptions</a></li>
							<li><a  href="#">Downloads</a></li>
							<li><a  href="#">Settings</a></li>
							<li><a  href="#">Logout</a></li>-->
						</ul>
					</div>
					</nav>
				

			<div class = "collapse navbar-collapse navHeaderCollapse">
					<ul class = "nav navbar-nav navbar-right">
						<li><a href = "index.php">LOG OUT</a></li>
					</ul>
				</div>

</div>		
		</div>
		</div>
			</div>
				
		<!-- /container-->
		<script src="js/ytmenu.js"></script>


				<!-- ***********************************************************
										Menucon code end
					 ***********************************************************-->

					<!--<a href="settings.php" class = "navbar-brand" >
					<img class = "navbar-brand"   style="padding: 0.5em;width: 3.8em; height: 3.8em; float: left; margin-top: -1.25em" src="menuconreal.png">
				</a>-->


					
					

			
	

		
			



			<div class = "container">
				<div class = "row">
					<br>
					<div class = "col-md-3">
						<a href="bad.php" class = "btn btn-danger btn-block">Bad</a>
					</div>
					<div class = "col-md-3">
						<a href="success.php" class = "btn btn-success btn-block">Good</a>
					</div>
					<div class = "col-md-3">
						<a href="warning.php" class = "btn btn-warning btn-block">Neutral</a>
					</div>
					<div class = "col-md-3">
						<a href="all.php" class = "btn btn-default btn-block">All</a>
					</div>
				</div>
			</div>

			<br>

			<center>
				<div class = "container">
					<div class = "row">
						<div class = "col-md-12">
						<table class ="table">
						<tbody>
					<?php 
					$twitterQueryString = "https://api.twitter.com/1.1/search/tweets.json?q=".$twitterQueryString."&result_type=recent&count=30";
					$tweets = $twitter -> get($twitterQueryString);
					
					$DatumboxAPI = new DatumboxAPI($api_key);
					$array = array("text" => array(), "sentiment" => array());
					$count = 0;
					$GLOBALS['contains'] = array();
					function isIn($x, $y)
					{
						if (empty($contains))
							return 0;
						for($counter = 0; $counter < $y; $counter++)
						{
							if ($contains[$counter] == $x)
								return 1;
						}
						return 0;
					}
					
					
					foreach($tweets as $tweet)
					{
						foreach ($tweet as $t)
						{
							if (isset($t->text))
							{
								
								if ( !isIn( preg_replace("/(?![:\)\()])\p{P}/u", "", $t->text), $count))
								{
									$text =  preg_replace("/(?![:\)\()])\p{P}/u", "", $t->text);
									$sentiment=$DatumboxAPI->SentimentAnalysis($text);
									if ((string)$sentiment == "positive")
									{
										echo "<tr class = \"success\">
    									<center><td>".isLink((string)$t->text)."</td></center>"
    									."<center><td>". "<img src =". $t->user->profile_image_url .">" ."</td></center>"
    									."<center><td>".dateF($t->created_at)."</td></center>"
  										."</tr>";
					  					$array["text"][$count] = (string) isLink((string)$t->text);
										$array["sentiment"][$count] = (string) $sentiment;
										$array["profile_pic"][$count] = (string) $t->user->profile_image_url;
										$array["created_at"][$count] = (string) dateF($t->created_at);
										$contains[$count] = (string)$text;
										$count++;
									}
									else if((string)$sentiment == "negative")
									{
										echo "<tr class = \"danger\">
    									<center><td>".islink((string)$t->text)."</td></center>"
    									."<center><td>". "<img src =". $t->user->profile_image_url .">" ."</td></center>"
    									."<center><td>".dateF($t->created_at)."</td></center>"
  										."</tr>";
					  					$array["text"][$count] = (string) isLink((string)$t->text);
										$array["sentiment"][$count] = (string) $sentiment;
										$array["profile_pic"][$count] = (string) $t->user->profile_image_url;
										$array["created_at"][$count] = (string)dateF($t->created_at);
										$contains[$count] = (string)$text;
										$count++;
									}
									else if((string)$sentiment == "neutral")
									{
										echo "<tr class = \"warning\">
    									<center><td>".islink((string)$t->text)."</td></center>"
    									."<center><td>". "<img src =". $t->user->profile_image_url .">" ."</td></center>"
    									."<center><td>".dateF($t->created_at)."</td></center>"
  										."</tr>";
					  					$array["text"][$count] = (string) isLink((string)$t->text);
										$array["sentiment"][$count] = (string) $sentiment;
										$array["profile_pic"][$count] = (string) $t->user->profile_image_url;
										$array["created_at"][$count] = (string) dateF($t->created_at);
										$contains[$count] = (string)$text;
										$count++;
									}
									else
									{
										echo "<tr class = \"warning\">
    									<center><td>".isLink((string)$t->text)."</td></center>"
    									."<center><td>". "<img src =". $t->user->profile_image_url .">" ."</td></center>"
    									."<center><td>".dateF($t->created_at)."</td></center>"
  										."</tr>";
					  					$array["text"][$count] = (string) isLink((string)$t->text);
										$array["sentiment"][$count] = "neutral";
										$array["profile_pic"][$count] = (string) $t->user->profile_image_url;
										$array["created_at"][$count] = (string) dateF($t->created_at);
										$contains[$count] = (string)$text;
										$count++;
									}
									
								}

							}
				
						}

				
					}
					
					$_SESSION["passed_array"] = $array;
					echo "<p>Tweets Ready</p>";
					?>
			</tbody>
			</table>
			

			
		


						</div>
					</div>
				</div>
			</center>
			<br><br><br><br>

			
		<div class = "navbar navbar-default navbar-fixed-bottom" >
			<div class = "container">
				<p class = "navbar-text pull-left">2014 Developed by UCL ATOS Team 4<br>All Rights Reserved</p>
			</div>
		</div>
			
			

		


		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="../js/bootstrap.js"></script>















<?php			
		}


	}
	else
		echo "You do not have permisiion to view this page";
		
?>
</body>
</html>