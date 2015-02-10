	<!DOCTYPE html>
<html>
	<head>
	<title>ATOS Social Media-Testing</title>
	<meta name = "viewport" content = "width= device-width, initial-scale=1.0">
	<link href  = "../css/bootstrap.min.css" rel = "stylesheet">
	<link href  = "../css/login.css" rel = "stylesheet">
	</head>
	<body>
			

<div class="container">
    

    <div class="omb_login">
    	<h3 class="omb_authTitle">Welcome to ATOS Twitter Monitor</h3>
		
		<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-6">	
			    <form class="omb_loginForm" autocomplete="off" method="POST" action = "login.php">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" class="form-control" name="username" placeholder="Email Address">
					</div>
					<span class="help-block"></span>
										
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<input  type="password" class="form-control" name="password" placeholder="Password">
					</div>
					<br>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
				</form>
			</div>
    	</div>
		<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-3">
				<label class="checkbox">
					<input type="checkbox" value="remember-me">Remember Me
				</label>
			</div>
			
		</div>	    	
	</div>



        </div>
   

        	<div class = "navbar navbar-default navbar-fixed-bottom">
			<div class = "container">
				<p class = "navbar-text pull-left">2014 Developed by ATOS 4 UCL Team<br>All Rights Reserved</p>
			</div>
		</div>
		
    </body>
</html>