<html>

<head>
	
	<title>ATOS Rail Sentiment</title>
			<meta name = "viewport" content = "width= device-width, initial-scale=1.0">
			<link href  = "../css/bootstrap.min.css" rel = "stylesheet">
			<link href  = "../css/styles.css" rel = "stylesheet">
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="../js/bootstrap.js"></script>
		<script src="../twemoji/twemoji.min.js"></script>
		
</head>

<body>
	
<?php
    include "testDate.php"; 
	ini_set('max_execution_time', 300);
	include "twitteroauth.php";
	include "DatumboxAPI.php";
	session_start();


 	function addhref($x)
 	{
		return "<a href=\"" . $x . " \"> " . $x . "</a>" ;
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

		

			
			<div class = "navbar navbar-default navbar-static-top">

		<div class ="container">

			
					<a href="settings.php" class = "navbar-brand" >
					<img class = "navbar-brand"   style="padding: 0.5em;width: 3.8em; height: 3.8em; float: left; margin-top: -1.25em" src="menuconreal.png">
					</a>

					<div class = "collapse navbar-collapse navHeaderCollapse">
					<ul class = "nav navbar-nav navbar-right">
						<li><a href = "index.php">LOG OUT</a></li>
					</ul>
				</div>

				</div></div>


					
					

			
	

		
			



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
										$tweetText = isLink((string)$t->text);
										echo "<tr class = \"success\">
    									<center><td>";
    									?>
										
										<!--
    									**************************************************************
    									Javascript code for Emoticon Rendering and Printing Tweet Text
    									**************************************************************	
    								-->
    									
    									<script type="text/javascript">

    									var e = '<?php echo addslashes($tweetText); ?>'; 

    									var e = '<?php echo addSlashes($tweetText); ?>'; //http://stackoverflow.com/questions/4287357/access-php-variable-in-javascript

   										var f = twemoji.parse(e);
    									document.write(f);
   										</script>
										
										<!--
    									**************************************************************
    									Javascript code for Emoticon Rendering and Printing Tweet Text
    									**************************************************************	
    								-->	

    									<?php 
    									echo"</td></center>"
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
										$tweetText = isLink((string)$t->text);
										echo "<tr class = \"danger\">
    									<center><td>";?>

    									<!--
    									**************************************************************
    									Javascript code for Emoticon Rendering and Printing Tweet Text
    									**************************************************************	
    								-->	
    									
    									<script type="text/javascript">

    									var e = '<?php echo addslashes($tweetText); ?>'; 

    									var e = '<?php echo addSlashes($tweetText); ?>'; //http://stackoverflow.com/questions/4287357/access-php-variable-in-javascript

   										var f = twemoji.parse(e);
    									document.write(f);
   										</script>
										
										<!--
    									**************************************************************
    									Javascript code for Emoticon Rendering and Printing Tweet Text
    									**************************************************************	
    								-->	

    									<?php 
    									echo"</td></center>"
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
										$tweetText = isLink((string)$t->text);
										echo "<tr class = \"warning\">
    									<center><td>";?>

    									<!--
    									**************************************************************
    									Javascript code for Emoticon Rendering and Printing Tweet Text
    									**************************************************************	
    								-->	
    									
    									<script type="text/javascript">

    									var e = '<?php echo addslashes($tweetText); ?>'; 

    									var e = '<?php echo addSlashes($tweetText); ?>'; //http://stackoverflow.com/questions/4287357/access-php-variable-in-javascript

   										var f = twemoji.parse(e);
    									document.write(f);
   										</script>
										
										<!--
    									**************************************************************
    									Javascript code for Emoticon Rendering and Printing Tweet Text
    									**************************************************************	
    								-->	

    									<?php 
    									echo"</td></center>"
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
										$tweetText = isLink((string)$t->text);
										echo "<tr class = \"warning\">
    									<center><td>";?>

    									<!--
    									**************************************************************
    									Javascript code for Emoticon Rendering and Printing Tweet Text
    									**************************************************************	
    								-->	
    									
    									<script type="text/javascript">
	 									var e = '<?php echo addslashes($tweetText); ?>'; 

   										var f = twemoji.parse(e);
    									document.write(f);
   										</script>
										
										<!--
    									**************************************************************
    									Javascript code for Emoticon Rendering and Printing Tweet Text
    									**************************************************************	
    								-->	

    									<?php 
    									echo"</td></center>"
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
			
			

		

















<?php			
		}
	}
	else
		echo "You do not have permisiion to view this page";
		
?>
</body>
</html>