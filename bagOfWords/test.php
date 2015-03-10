<html>

<head>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="../twemoji/twemoji.min.js"></script>
<head>
<body>

	<?php
			include "twitteroauth.php";		
			$consumer = "5blMAfvgOmZBZyfM2usfcX97c";
			$counsumerSecret = "oYVA9roicxA0nVSX7kXujVnb0Eyn0EFpqy4cSpQ5ZpUyzxeaHQ";
			$accessToken = "2319828684-dXOy6CW1Mf7nsm32YMbH9qcwMLP8NtetGTxTAbC";
			$accessTokenSecret = "mp4svtYl7DQAWQmGCBAppHO5aBr8HVmB04T6xU4c7GK8E";
			$twitter = new TwitterOAuth($consumer, $counsumerSecret, $accessToken, $accessTokenSecret);
			$twitterQueryString = "https://api.twitter.com/1.1/search/tweets.json?q="."%40momshadalvee"."&result_type=recent&count=30";
			$tweets = $twitter -> get($twitterQueryString);
			foreach($tweets as $tweet)
					{
						foreach ($tweet as $t)
						{
							if (isset($t->text))
							{
								$text = $t->text;
								echo $text;
							?>

							
							<?php }
						}
					}
	?>
<script>



 </script>
</body>
</html>
