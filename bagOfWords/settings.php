<html>

<head>
	<title>Settings</title>
	<meta name = "viewport" content = "width= device-width, initial-scale=1.0">
	<link href  = "../css/bootstrap.min.css" rel = "stylesheet">
	<link href  = "../css/login.css" rel = "stylesheet">

		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</head>
	<body background = "photography.png">


		<div class = "navbar navbar-default navbar-static-top">
			<div class = "container">
				<a  class = "navbar-brand" >
					<img class = "navbar-brand" class = "active" style="padding: 0.3em;width: 4.5em; height: 3.5em; float: left; margin-top: -1.25em" src="logo.jpg">
				</a>

				<div class = "collapse navbar-collapse navHeaderCollapse">
					<ul class = "nav navbar-nav navbar-right">
						<li><a href = "all.php">BACK</a></li>
						<li><a href = "index.php">LOG OUT</a></li>
					</ul>
				</div>

			</div>
		</div>

<?php
session_start();
error_reporting(0);
 //if($_SESSION["loggedIn"] == 1)
 //{
	$countForBreakOne = 0;
	$countForBreakTwo = 0;
		$host = "eu-cdbr-azure-north-c.cloudapp.net";
	    $user = "bf5a119d46ef1d";
	    $pwd = "1b7bd7ec";
	    $db = "atosraiASL0S22pH";
    try 
    {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e)
    {
        die(var_dump($e));
    }
    $username = trim($_SESSION["username"]);
    $sql_select = "SELECT * FROM users WHERE username = '$username'";
    $stmt = $conn->query($sql_select);
    $ans = $stmt->fetchAll();
	$GLOBALS["dbArray"] = preg_split('/\s+/', trim($ans[0]["query"]));
	if(!isset($_POST["array"]) || !isset($_POST["sentText"]) )
	{
		echo"<center>";
		echo "<form action = settings.php method = 'POST'>";
		echo"<div class = \"container\">";
		echo"<div class = \"row\">";
		
		foreach($GLOBALS["dbArray"] as $x)
		{
			
			echo"<div class = \"col-md-3\">";
			echo "<button class=\"btn btn-lg btn btn-block\">";
			echo "<input type = 'checkbox' name = 'array[]' value = '$x' checked> $x ";
			echo "</button>";
			echo"</div>";
			$countForBreakOne++;
			if( ($countForBreakOne % 4) ==0)
			{
				echo "<br></br>";
				echo "<br></br>";
			}
		}
		
		echo"</div></div>";
		echo"<br><br>";
		echo "<input type = 'text' name = 'sentText'>";
		echo "<input type = 'submit'>"; 
		echo "</form>";
		echo"</center>";
		/*echo"<center>";
		echo "<form action=\"all.php\">
    <input type=\"submit\" value=\"Go to App\">
	</form>";
	echo"</center>";*/

	}
	else if ( isset($_POST["array"]))
	{
		$GLOBALS["dbArray"] = array();
		foreach($_POST["array"] as $x)
		{
			array_push($GLOBALS["dbArray"], $x);
		}
		$string = "";
		foreach($GLOBALS["dbArray"] as $x)
		{
			$string .= (" ".$x);
		}
		$string = trim($string);
		$sql = "UPDATE users SET query= '$string'  WHERE username='$username'";
		$stmt = $conn->prepare($sql);
    	$stmt->execute();
		$string = "";


		if ( isset($_POST["sentText"])  && (preg_replace('/\s+/', '', $_POST["sentText"]) !== "") )
		{
			$sentTextArray = preg_split('/\s+/', trim($_POST["sentText"]));
			foreach ($sentTextArray as $x)
			{
				$count = 0;
				foreach ($GLOBALS["dbArray"] as $y)
				{
					if (!(strtolower($x) == strtolower($y)))
						$count++;
					else
						break;
				}
				if ($count == count($GLOBALS["dbArray"]))
					array_push($GLOBALS["dbArray"], $x);

			}
			$string = "";
			foreach($GLOBALS["dbArray"] as $x)
			{
				$string .= (" ".$x);
			}
			$string = trim($string);
			$sql = "UPDATE users SET query= '$string'  WHERE username='$username'";
			$stmt = $conn->prepare($sql);
	    	$stmt->execute();
			$string = "";

			
		}
		echo"<center>";
		echo "<form action = settings.php method = 'POST'>";
		echo"<div class = \"container\">";
		echo"<div class = \"row\">";
		
		foreach($GLOBALS["dbArray"] as $x)
		{
			
			echo"<div class = \"col-md-3\">";
			echo "<button class=\"btn btn-lg btn btn-block\">";
			echo "<input type = 'checkbox' name = 'array[]' value = '$x' checked> $x ";
			echo "</button>";
			echo"</div>";
			$countForBreakTwo++;
			if( ($countForBreakTwo % 4) == 0)
			{
				echo "<br></br>";
				echo "<br></br>";
			}
		}
		
		echo"</div></div>";
		echo"<br><br>";
		echo "<input type = 'text' name = 'sentText'>";
		echo "<input type = 'submit'>"; 
		echo "</form>";
		echo"</center>";
		/*echo"<center>";
		echo "<form action=\"login.php\">
    <input type=\"submit\" value=\"Go to App\">
	</form>";
	echo"</center>";*/
	 }
 
 //else
 //{
 	//echo "You do not have permission to view this page";
 //}
	 
	
	


?>


<div class = "navbar navbar-default navbar-fixed-bottom">
			<div class = "container">
				<p class = "navbar-text pull-left">2014 Developed by ATOS 4 UCL Team<br>All Rights Reserved</p>
			</div>
		</div>


		
    </body>

</html>