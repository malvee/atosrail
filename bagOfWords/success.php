
<html>
	<head>
<?php
session_start();
include "chooseColorDepth.php";
error_reporting(0);
if ($_SESSION["loggedIn"] ==1)
{
?>
	<title>Twitter Analysis</title>
	<meta name = "viewport" content = "width= device-width, initial-scale=1.0">
	<link href  = "../css/bootstrap.min.css" rel = "stylesheet">
	<link href  = "../css/styles.css" rel = "stylesheet">
	<link href  = "../css/selectTweetColorDepth.css" rel = "stylesheet">
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="../js/bootstrap.js"></script>
		<script src="../twemoji/twemoji.min.js"></script>
	</head>
	<body background = "photography.png">
		
				<div class = "navbar navbar-default navbar-static-top">

		<div class ="container">

			
					<a href="settings.php" class = "navbar-brand" >
					<img class = "navbar-brand"   style="padding: 0.5em;width: 3.8em; height: 3.8em; float: left; margin-top: -1.25em" src="menuconreal.png">
					</a>

					<div class = "collapse navbar-collapse navHeaderCollapse">
					<ul class = "nav navbar-nav navbar-right">
						<li><a href="reload.php">RELOAD</a></li>
						<li><a href="next.php">NEXT</a></li>
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
						if ($temp == "g")
						{
							$derivedScore = $array["score"][$count];
							$goodColorDepth = decideGoodColorDepth($derivedScore);
							echo "<tr class = \"$goodColorDepth\">
    								<center><td>";
    							?>
										
										
    									
    									<script type="text/javascript">
    									var e = twemoji.parse("<?php echo $array['text'][$count]; ?>"); 
    									document.write(e);
   										</script>


    									<?php 
    									echo"</td></center>"
    									."<center><td>". "<img src =". $array['profile_pic'][$count] .">" ."</td></center>"
    									."<center><td>".$array['created_at'][$count]."</td></center>"
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
		
			
			
<br><br><br><br>

			
		<div class = "navbar navbar-default navbar-fixed-bottom" >
			<div class = "container">
				<p class = "navbar-text pull-left">2014 Developed by UCL ATOS Team 4<br>All Rights Reserved</p>
			</div>
		</div>


	
			<?php }
		else
		{
			echo "Access Denied";
		}
		?>
	</body>
</html>
