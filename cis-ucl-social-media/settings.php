<html>
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
	$_GLOBALS["dbArray"] = preg_split('/\s+/', trim($ans[0]["query"]));
	if(!isset($_POST["array"]) || !isset($_POST["sentText"]) )
	{
		echo "<form action = settings.php method = 'POST'>";
		foreach($_GLOBALS["dbArray"] as $x)
		{
			echo "<input type = 'checkbox' name = 'array[]' value = '$x' checked> $x ";
		}
		echo "<br>";
		echo "<input type = 'text' name = 'sentText'>";
		echo "<input type = 'submit'>"; 
		echo "</form>";
		echo "<br>";
		echo "<form action=\"all.php\">
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
			$sql = "UPDATE users SET query= '$string'  WHERE username='daviddaly'";
			$stmt = $conn->prepare($sql);
	    	$stmt->execute();
			$string = "";

			
		}
		echo "<form action = settings.php method = 'POST'>";
		foreach($_GLOBALS["dbArray"] as $x)
		{
			echo "<input type = 'checkbox' name = 'array[]' value = '$x' checked> $x ";
		}
		echo "<br>";
		echo "<input type = 'text' name = 'sentText'>";
		echo "<input type = 'submit'>"; 
		echo "</form>";
		echo "<br>";
		echo "<form action=\"all.php\">
    <input type=\"submit\" value=\"Go to App\">
	</form>";
	 }
}
else
{
	echo "You do not have permission to view this page";
}
	 
	
	


?>
</html>