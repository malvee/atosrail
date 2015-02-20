
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
		
			<div class = "navbar navbar-default navbar-static-top">
			<div class = "container">

					<a href="settings.php" class = "navbar-brand" >
					<img class = "navbar-brand"   style="padding: 0.5em;width: 4em; height: 3.9em; float: left; margin-top: -1.25em" src="menuconreal.png">
				</a>

					<ul class = "nav navbar-nav navbar-right">
						<li><a href = "index.php">Log Out</a></li>
					</ul>
				


			</div>
			
		</div>



			<div class = "container">
				<div class = "row">
					<div class = "col-md-3">
						<a href="bad.php" class = "btn btn-danger btn-block">Bad</a>
					</div>
					<div class = "col-md-3">
						<a href="#" class = "btn btn-success btn-block">Good</a>
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
						if ($temp == "positive")
						{

						echo "<tr class = \"success\">
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
		
			
			

		<div class = "navbar navbar-default navbar-fixed-bottom" >
			<div class = "container">
				<p class = "navbar-text pull-left">2014 Developed by UCL ATOS Team 4<br>All Rights Reserved</p>
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
