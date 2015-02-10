
<html>
	<head>
<?php
session_start();
error_reporting(0);
if ($_SESSION["loggedIn"] ==1)
{
?>
	<title>Twitter Analysis</title>
	<meta name = "viewport" content = "width= device-width, initial-scale=1.0">
	<link href  = "../css/bootstrap.min.css" rel = "stylesheet">
	<link href  = "../css/styles.css" rel = "stylesheet">
	</head>
	<body>
		



			<div class = "container">
				<div class = "row">
					<div class = "col-md-3">
						<a href="#" class = "btn btn-danger btn-block">Bad</a>
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
					$count = 0;
					$array = $_SESSION["passed_array"];
					foreach( $array["sentiment"] as $temp)
					{
						if ($temp == "negative")
						{

						echo "<tr class = \"danger\">
    <center><td>".(string)$array['text'][$count]."</td></center>"
    									."<center><td>". "<img src =". (string)$array['profile_pic'][$count] .">" ."</td></center>"
    									."<center><td>".(string)$array['created_at'][$count]."</td></center>"
  										."</tr>";
						}
						$count++;
					}
					
					?>
		</tbody>
		</table>




						</div>
					</div>
				</div>
			</center>
		
			
			

		</div>
		<div class = "navbar navbar-inverse navbar-fixed-bottom">
			<div class = "container">
				<p class = "navbar-text pull-left">2014 Developed by ATOS-4 Proud Team<br>All Rights Reserved</p>
			</div>
		</div>


		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="../js/bootstrap.js"></script>
		<?php }
		else
		{
			echo "Access Denied";
		}
		?>
	</body>
</html>
