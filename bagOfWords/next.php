<html>

<head>

    <title>ATOS Rail Sentiment</title>
    <meta name = "viewport" content = "width= device-width, initial-scale=1.0">
    <link href  = "../css/bootstrap.min.css" rel = "stylesheet">
    <link href  = "../css/styles.css" rel = "stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js">
    </script>
    <script src="../js/bootstrap.js"></script>
    <script src="../twemoji/twemoji.min.js"></script>

</head>

<body>
    <?php 
    include "testDate.php"; 
    include "runAlgo.php";
    include "twitteroauth.php";
    include "chooseColorDepth.php";
    session_start();
    function safeTweet($x)
    {
        $xArray =  preg_split('/\s+/', $x);
        $newStr = '';
        foreach ($xArray as $y)
        {
            $newStr .= ' '.trim($y);
        }
        return $newStr;
    }
    function addhref($x)
    {
        return " <a href=' " . $x . " ' target='_blank' > ". $x . "</a>" ;
    }
    function isLink($x)    // gets a string and prints out the links within it
    {   
        $words = explode(" ", $x);
        $counts = 0;
        foreach ($words as $word) 
        {
            if(strncmp("http://", $word, 7) == 0 || strncmp("https://", $word, 8) == 0)
            {
                $replacement = array ($counts => addhref($word));
                $words = array_replace($words, $replacement);
            }
            $counts++;
        }
        return implode(" ", $words);
    }
    $host = "eu-cdbr-azure-north-c.cloudapp.net";
    $user = "bf5a119d46ef1d";
    $pwd = "1b7bd7ec";
    $db = "atosraiASL0S22pH";
    $api_key='ba28ee0ae71432fe85206c36d0e6a641';
    $consumer = "5blMAfvgOmZBZyfM2usfcX97c";
    $counsumerSecret = "oYVA9roicxA0nVSX7kXujVnb0Eyn0EFpqy4cSpQ5ZpUyzxeaHQ";
    $accessToken = "2319828684-dXOy6CW1Mf7nsm32YMbH9qcwMLP8NtetGTxTAbC";
    $accessTokenSecret = "mp4svtYl7DQAWQmGCBAppHO5aBr8HVmB04T6xU4c7GK8E";
    $twitter = new TwitterOAuth($consumer, $counsumerSecret, $accessToken, $accessTokenSecret);
    try 
    {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e)
    {
        die(var_dump($e));
    }
    $username = trim($_SESSION["username"]);
    $sql_select = "SELECT * FROM users WHERE username = '$username' ";
    $stmt = $conn->query($sql_select);
    $ans = $stmt->fetchAll();
    $queryArray = preg_split('/\s+/', trim($ans[0]["query"]));
    $twitterQueryString = "";
    foreach($queryArray as $x)
    {
        $twitterQueryString .= "%40".$x."%20OR%20"."%23".$x."%20OR%20";
    }
    $twitterQueryString = substr($twitterQueryString,0, strlen($twitterQueryString) - 8);
    ?>

    <div class = "navbar navbar-default navbar-static-top">
        <div class ="container">
            <a href="settings.php" class = "navbar-brand" >
                <img class = "navbar-brand"   style="padding: 0.5em;width: 3.8em; height: 3.8em; float: left; margin-top: -1.25em" src="menuconreal.png">
            </a>
            <div class = "collapse navbar-collapse navHeaderCollapse">
                <ul class = "nav navbar-nav navbar-right">
                    <li><a href="reload.php">RELOAD</a></li>
                    <li><a onclick="window.location.reload();">NEXT</a></li>
                    <li><a href="previous.php">PREVIOUS</a></li>
                    <li><a href = "index.php">LOG OUT</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class = "container">
        <div class = "row">
            <br>
            <div class = "col-md-3">
                <a href="bad.php" class = "btn btn-danger btn-block">Bad</a>
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
                            $max_id = $_SESSION["lastTweet"];
                            $twitterQueryString = "https://api.twitter.com/1.1/search/tweets.json?q=".$twitterQueryString."&count=100&max_id=".$max_id;
                            $tweets = $twitter -> get($twitterQueryString);
                            $array = array("text" => array(), "sentiment" => array());
                            $count = 0;
                            $GLOBALS['contains'] = array();
                            function isIn($x, $y)
                            {
                                if (empty($contains))
                                    return 0;
                                for($counter = 0; $counter < $y; $counter++)
                                {
                                    if ($contains[$counter] == $x)
                                        return 1;
                                }
                                return 0;
                            }
                            $c = 0;
                            foreach($tweets as $tweet)
                            {
                                foreach ($tweet as $t)
                                {
                                    if (isset($t->text))
                                    {
                                        if ( !isIn( preg_replace("/[^a-zA-Z ]+/", "", $t->text), $count))
                                        {
                                            if($c == 0)
                                            {
                                                $_SESSION["firstTweet"] = $t->id_str;
                                            }
                                            $c++;
                                            $text =  preg_replace("/[^a-zA-Z ]+/", "", $t->text);
                                            $returnSentiment = returnSentiment($text);
                                            $sentiment= $returnSentiment[1];
                                            $score = $returnSentiment[0];
                                            $tweetText = isLink((string)$t->text);
                                            $tweetText = safeTweet($tweetText). " ". $score;
                                            if ((string)$sentiment == "g")
                                            {
                                                $goodColorDepth = decideGoodColorDepth($score);
                                                echo "<tr class = \"$goodColorDepth\">
                                                <center><td>";
                                                ?>
                                                <script>
                                                var e = twemoji.parse("<?php echo addcslashes($tweetText, '\"'); ?>"); 
                                                document.write(e);
                                                </script>
                                                <?php 
                                                echo"</td></center>"
                                                ."<center><td>". "<img src =". $t->user->profile_image_url .">" ."</td></center>"
                                                ."<center><td>".dateF($t->created_at)."</td></center>"
                                                ."</tr>";
                                                $array["text"][$count] = addcslashes($tweetText, '"');
                                                $array["sentiment"][$count] = (string) $sentiment;
                                                $array["profile_pic"][$count] = (string) $t->user->profile_image_url;
                                                $array["created_at"][$count] = (string) dateF($t->created_at);
                                                $array["score"][$count] = (string) $score;
                                                $contains[$count] = (string)$text;
                                                $count++;
                                            }
                                            else if((string)$sentiment == "b")
                                            {
                                                $badColorDepth = decideBadColorDepth($score);
                                                echo "<tr class = \"$badColorDepth\">
                                                <center><td>";?>
                                                    <script >
                                                    var e = twemoji.parse("<?php echo addcslashes($tweetText, '\"'); ?>"); 
                                                    document.write(e);
                                                    </script>
                                                    <?php 
                                                    echo"</td></center>"
                                                    ."<center><td>". "<img src =". $t->user->profile_image_url .">" ."</td></center>"
                                                    ."<center><td>".dateF($t->created_at)."</td></center>"
                                                    ."</tr>";
                                                    $array["text"][$count] = addcslashes($tweetText, '"');
                                                    $array["sentiment"][$count] = (string) $sentiment;
                                                    $array["profile_pic"][$count] = (string) $t->user->profile_image_url;
                                                    $array["created_at"][$count] = (string)dateF($t->created_at);
                                                    $array["score"][$count] = (string) $score;
                                                    $contains[$count] = (string)$text;
                                                    $count++;
                                                }
                                                else if((string)$sentiment == "n")
                                                {
                                                    echo "<tr class = \"yellowClass\">
                                                    <center><td>";?>
                                                        <script>
                                                        var e = twemoji.parse("<?php echo addcslashes($tweetText, '\"'); ?>"); 
                                                        document.write(e);
                                                        </script>
                                                        <?php 
                                                        echo"</td></center>"
                                                        ."<center><td>". "<img src =". $t->user->profile_image_url .">" ."</td></center>"
                                                        ."<center><td>".dateF($t->created_at)."</td></center>"
                                                        ."</tr>";
                                                        $array["text"][$count] = addcslashes($tweetText, '"');
                                                        $array["sentiment"][$count] = (string) $sentiment;
                                                        $array["profile_pic"][$count] = (string) $t->user->profile_image_url;
                                                        $array["created_at"][$count] = (string) dateF($t->created_at);
                                                        $array["score"][$count] = (string) $score;
                                                        $contains[$count] = (string)$text;
                                                        $count++;
                                                    }
                                                    else
                                                    {
                                                      echo "<tr class = \"yellowClass\">
                                                      <center><td>";?>
                                                          <script>
                                                          var e = twemoji.parse("<?php echo addcslashes($tweetText, '\"'); ?>"); 
                                                          document.write(e);
                                                          </script>
                                                          <?php 
                                                          echo"</td></center>"
                                                          ."<center><td>". "<img src =". $t->user->profile_image_url .">" ."</td></center>"
                                                          ."<center><td>".dateF($t->created_at)."</td></center>"
                                                          ."</tr>";
                                                          $array["text"][$count] = addcslashes($tweetText, '"');
                                                          $array["sentiment"][$count] = (string) $sentiment;
                                                          $array["profile_pic"][$count] = (string) $t->user->profile_image_url;
                                                          $array["created_at"][$count] = (string) dateF($t->created_at);
                                                          $array["score"][$count] = (string) $score;
                                                          $contains[$count] = (string)$text;
                                                          $count++;
                                                      }
                                                      $_SESSION["lastTweet"] = $t->id_str;
                                                  }
                                              }
                                          }
                                      }
                                      $_SESSION["passed_array"] = $array;
                                      echo "<p>Tweets Ready</p>";
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
        </body>
        </html>