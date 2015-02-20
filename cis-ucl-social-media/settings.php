<html>

<head>
	<title>Settings</title>
	<meta name = "viewport" content = "width= device-width, initial-scale=1.0">
	<link href  = "../css/bootstrap.min.css" rel = "stylesheet">
	<link href  = "../css/login.css" rel = "stylesheet">
	<link href  = "../css/jackchan.css" rel = "stylesheet">
	</head>
	<body>

		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="js/bootstrap.js"></script>

		<div class = "navbar navbar-default navbar-static-top">
			<div class = "container">
				<a  class = "navbar-brand" >
					<img class = "navbar-brand" class = "active" style="padding: 0.5em;width: 5em; height: 4em; float: left; margin-top: -1.25em" src="logo.jpg">
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
 if($_SESSION["loggedIn"] == 1)
 {
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
    $sql_select = "SELECT * FROM users WHERE username = 'daviddaly'";
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
			if( $GLOBALS % 4 ==3)
			{
				echo "<br>";
			}
			echo"<div class = \"col-md-3\">";
			echo "<button class=\"btn btn-lg btn btn-block\">";
			echo "<input type = 'checkbox' name = 'array[]' value = '$x' checked> $x ";
			echo "</button>";
			echo"</div>";
			
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
		$sql = "UPDATE users SET query= '$string'  WHERE username='daviddaly'";
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
			$sql = "UPDATE users SET query= '$string'  WHERE username='daviddaly'";
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
			if(  % 4 ==3)
			{
				echo "<br>";
			}
			echo"<div class = \"col-md-3\">";
			echo "<button class=\"buttonParam btn btn-lg btn btn-block\">";
			echo "<input type = 'checkbox' name = 'array[]' value = '$x' checked> $x ";
			echo "</button>";
			echo"</div>";
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
 }
 else
 {
 	echo "You do not have permission to view this page";
 }
	 
	
	


?>


<div class = "navbar navbar-default navbar-fixed-bottom">
			<div class = "container">
				<p class = "navbar-text pull-left">2014 Developed by UCL ATOS Team 4<br>All Rights Reserved</p>
			</div>
		</div>


		
    </body>

</html>