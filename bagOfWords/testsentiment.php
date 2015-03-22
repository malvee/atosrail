<!DOCTYPE html>
<html>
<body>

<form action="" method="post">
    Sentence: <input type="text" name="text" ><br>

<?php
include "runAlgo.php"; 

$sentiment = array();
$sentiment = returnSentiment($_POST['text']);

?>
</form>

<p> The score is <?php echo $sentiment[0] ?></p>

</body>
</html>


