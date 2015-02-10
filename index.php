<html>
<?php
	 $host = "eu-cdbr-azure-north-b.cloudapp.net";
    $user = "b1ab8a4c6aa690";
    $pwd = "efd91e32";
    $db = "atosraiAaM0G4XAp";
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    $sql_select = "SELECT * FROM users";
    $stmt = $conn->query($sql_select);
    $registrants = $stmt->fetchAll(); 
    foreach($registrants as $registrant)
    {
    	echo $registrant["query"];
    }

?>

</html>