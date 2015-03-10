
<html>
	<head>
	<title>The Collaborators Network</title>
	<meta name = "viewport" content = "width= device-width, initial-scale=1.0">
	<link href  = "../css/bootstrap.min.css" rel = "stylesheet">
	<link href  = "../css/login.css" rel = "stylesheet">
	<script>
function validateForm() {
	var z =  document.forms["myForm"]["email"].value;
    var x = document.forms["myForm"]["fpassword"].value;
    var y = document.forms["myForm"]["fpassword2"].value;
        if (x == null || x == "" || y == null || y == "" || z == null || z == "") {
        alert("Please fill out all the details.");
        return false;
    }
    if (x != y) {
        alert("The passwords must match");
        return false;
    }

}
</script>



	</head>
	<body >

		<div class = "navbar navbar-default navbar-static-top">
			<div class = "container">
			
			</div>
		</div>
			

<div class="container">
    

    <div class="omb_login">
    	<h3 class="omb_authTitle">Welcome to InstaChat</h3>
		
		<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-6">	
			    <form class="omb_loginForm" autocomplete="off" method="POST" action = "login.php" name = "myForm" onsubmit="return validateForm()">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" class="form-control" name="email" placeholder="Email Address">
					</div>
					<span class="help-block"></span>
										
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<input  type="password" class="form-control" name="fpassword" placeholder="Password">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<input  type="password" class="form-control" name="fpassword2" placeholder="Re-type Password">
					</div>
					<br>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
				</form>
			</div>
    	</div>
	

		<div class="row omb_row-sm-offset-3 omb_loginOr">
					
					<div class="col-xs-12 col-sm-6">
						<hr class="omb_hrOr">
						<span class="omb_spanOr"></span>
					</div>

				</div>

	</div>



        </div>
   

        	<div class = "navbar navbar-default navbar-fixed-bottom">
			<div class = "container">
				<p class = "navbar-text pull-left">2014 Developed by Sumaiya & Sachi<br>All Rights Reserved</p>
			</div>
		</div>
		
    </body>
</html>