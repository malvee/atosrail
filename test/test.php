<?php
$o = "";
exec("java -cp myJar.jar Hello test.txt", $o);
print_r($o);
?>