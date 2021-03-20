<?php
		session_start();
		if(isset($_SESSION['uname']))
		{
			$uname=$_SESSION['uname'];
			include_once('db_connect.php');
			$sql="SELECT * FROM participation WHERE uname='$uname' LIMIT 1 ";
			$result=mysqli_query($db_conn,$sql);
			$row=mysqli_fetch_assoc($result);
			$name=$row['name'];
			$regno=$row['regno'];
			$dept=$row['dept'];
			$year=$row['year'];
			$email=$row['email'];
			$gender=$row['gender'];
			$phone=$row['phone'];
		}
		else
		{
			header("location:index.php?msg=TRY LOGIN/REGISTARION FIRST");
		}
?>
<?php
	if ( isset( $_GET[ 'msg' ] ) )
	{
		$msg = $_GET[ 'msg' ];
echo '<script> alert("' . $msg . '");</script>';
echo '<script>window.location="editProfile.php";</script>';
}
?>
<?php
	if ( isset( $_POST[ "update" ] ) )
	{
		include_once( 'db_connect.php' );
		$name = preg_replace( '#[^A-Za-z ]#i', '', $_POST[ 'name' ] );
		$password = $_POST[ 'password' ];
		$c_password = $_POST[ 'c_password'];
		$regno = preg_replace( '#[^A-Za-z0-9]#i', '', $_POST[ 'regno' ] );
		$dept = $_POST[ 'dept' ];
		$year = $_POST[ 'year' ];
		$email = mysqli_real_escape_string( $db_conn, $_POST[ 'email' ] );
		$gender = $_POST[ 'gender' ];
		$phone = preg_replace( '#[^0-9]#i', '', $_POST[ 'phone' ] );
		$sql_query = "SELECT * FROM participation WHERE email='$email' AND uname!='$uname' LIMIT 1";
		$query_result = mysqli_query( $db_conn, $sql_query );
		$e_check = mysqli_num_rows( $query_result );
		if ( $name == "" || $regno == "" || $dept == "" || $year == "" || $email == "" || $gender == "" || $phone == "" )
			header( "location:editProfile.php?msg=PLEASE FILL UP ALL THE FIELDS" );
		else if ( $e_check > 0 )
			header( "location:editProfile.php?msg=THIS EMAIL ID IS ALREADY USED IN ANOTHER REGISTRATION" );
		else if ( strlen( $phone ) != 10 || !is_numeric( $phone ) )
			header( "location:editProfile.php?msg=ENTER A VALID PHONE NUMBER" );
		else if ( strlen( $regno ) > 29 )
			header( "loaction:editProfile.php?msg=REGISTRATION NUMBER IS TOO LONG" );
		else if ( $password != $c_password )
			header( "location:editProfile.php?msg=PASSWORD FIELD DOESN'T MATCH" );
		else if($password!="" && $c_password!="")
		{
			$password=md5($password);
			echo "<script>alert('php mae aagya 3');</script>";
			$sql_query = "UPDATE participation SET name='$name', password='$password', regno='$regno', dept='$dept', year='$year', email='$email', gender='$gender', phone='$phone' WHERE uname='$uname' ";
			if($query_result = mysqli_query( $db_conn, $sql_query ))
				header( "location:editProfile.php?msg=UPDATED SUCCESFULLY" );
			else
				header("location:editProfile.php?msg=something went wrong");
		}
		else
		{
			$sql_query = "UPDATE participation SET name='$name', regno='$regno', dept='$dept', year='$year', email='$email', gender='$gender', phone='$phone' WHERE uname='$uname' ";
			if($query_result = mysqli_query( $db_conn, $sql_query ))
			{
				header( "location:editProfile.php?msg=UPDATED SUCCESFULLY" );
			}
			else
				header("location:editProfile.php?msg=something went wrong");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>EDIT PROFILE</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<style>
	/* Stackoverflow preview fix, please ignore */
	.navbar-nav {
	flex-direction: row;
	}
	
	.nav-link {
	padding-right: .5rem !important;
	padding-left: .5rem !important;
	}
	
	/* Fixes dropdown menus placed on the right side */
	.ml-auto .dropdown-menu {
	left: auto !important;
	right: 0px;
	}
	.dropdown-item:hover {
		background-color: orange;
	}
		
		hr{
			box-shadow: 5px 5px 5px blue;
				color: blue;
		}
		.box{
			height: 450px;
			width: 1120px;
			box-shadow: 10px 10px 10px grey;
			border-style: ridge ;
			background-color: white;
		}
	</style>
	<script>
		function reg() {
				var x = document.getElementById( 'regno' ).value;
				if ( x.length > 29 ) {
					document.getElementById('msg').style.display="block";
					document.getElementById('msg').innerHTML="Registration number is too long";
					document.getElementById( 'regno' ).value = "";
				}
			}
		function y() {
				var x = document.getElementById( 'dept' ).value;
				if ( x != "mca" )
					document.getElementById( 'four' ).style.display = "block";
				else {
					document.getElementById( 'four' ).style.display = "none";
					document.getElementById( 'year' ).value = "1";
				}
			}
			function checkemail() {
				var x = document.getElementById( 'email' ).value;
				if ( x != "" ) {
					document.getElementById( 'email' ).style.background = "url(checking.gif) no-repeat";
					document.getElementById( 'email' ).style.backgroundSize = "25px 25px";
					document.getElementById( 'email' ).style.backgroundPosition = "right";
					var ajx = new XMLHttpRequest();
					ajx.onreadystatechange = function () {
						if ( this.readyState == 4 && this.status == 200 ) {
							if ( this.responseText == "invalid" ) {
								document.getElementById( 'email' ).style.background = "url(error.gif) no-repeat";
								document.getElementById( 'email' ).style.backgroundSize = "25px 25px";
								document.getElementById( 'email' ).style.backgroundPosition = "right";
								document.getElementById( 'email' ).title = "Invalid E-mail address";
							}
							if ( this.responseText == "taken" ) {
								document.getElementById( 'email' ).style.background = "url(error.gif) no-repeat";
								document.getElementById( 'email' ).style.backgroundSize = "25px 25px";
								document.getElementById( 'email' ).style.backgroundPosition = "right";
								document.getElementById( 'email' ).title = "This E-mail addess is already used in another registration";
							}
							if ( this.responseText == "ok" ) {
								document.getElementById( 'email' ).style.background = "url(ok.gif) no-repeat";
								document.getElementById( 'email' ).style.backgroundSize = "25px 25px";
								document.getElementById( 'email' ).style.backgroundPosition = "right";
								document.getElementById( 'email' ).title = "E-mail ok";
							}
						}
					}
					ajx.open( "POST", "emailCheck.php", true );
					ajx.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
					ajx.send( "emailcheck=" + x );
				} else {
					document.getElementById( 'email' ).style.background = "none";
				}
			}
		function check()
		{
			var name=document.getElementById('name').value;
			var regno=document.getElementById('regno').value;
			var dept=document.getElementById('dept').value;
			var year=document.getElementById('year').value;
			var email=document.getElementById('email').value;
			var phone=document.getElementById('phone').value;
			var p=doctype.getElementById('password').value;
			var c_p=document.getElementsById('c_password').value;
			if(name=="" || regno=="" || dept=="" || year=="" || email=="" || phone=="")
			{
				document.getElementById('msg').style.display="block";
				document.getElementById('msg').innerHTML="PLEASE FILL ALL THE FIELDS";
				return false;
			}
			else if(p!=c_p)
			{
				document.getElementById( "password" ).value = "";
				document.getElementById( "c_password" ).value = "";
				document.getElementById('msg').style.display="block";
				document.getElementById('msg').innerHTML="PASSWORD FIELDS DOESN'T MATCH";
			}
			else if ( regno.length > 29 )
			{
				document.getElementById( 'regno' ).value = "";
				document.getElementById('msg').style.display="block";
				document.getElementById('msg').innerHTML="REGISTARION NUMBER TOO LONG";
			}
			else
			{
				document.getElementById('msg').style.dsiplay="none";
				return true;
			}
		}
		function check_password() {
				var p = document.getElementById( "password" ).value;
				var cp = document.getElementById( "c_password" ).value;
				if ( p != cp ) {
					alert( "Password field doesn't match" );
					document.getElementById( "password" ).value = "";
					document.getElementById( "c_password" ).value = "";
				}
			}
	</script>
	<body style="background-color:#e6ffe6;">
		<div class="container">
			<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
				<a href="home.php" class="navbar-brand">
					<i class="fa fa-home"></i> Home
				</a>
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
							Take Test
						</a>
						<div class="dropdown-menu">
							<?php
								include_once('db_connect.php');
								$sql="SELECT name FROM tests WHERE active_flag='active' ";
								$result=mysqli_query($db_conn,$sql);
								while($row=mysqli_fetch_assoc($result))
								{
									$t=$row['name'];
									echo "<a class=\"dropdown-item\" href=\"test.php?t='$t'\">".$t."</a>";
								}
							?>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
							Results
						</a>
						<div class="dropdown-menu">
							<?php
								include_once('db_connect.php');
								$sql="SELECT name FROM tests WHERE active_flag='active' ";
								$result=mysqli_query($db_conn,$sql);
								while($row=mysqli_fetch_assoc($result))
								{									
									$t=$row['name'];
									echo "<a class=\"dropdown-item\" href=\"result.php?t='$t'\">".$t."</a>";
								}
							?>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="editProfile.php" >Edit Profile</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle navbar-brand" href="#" id="navbardrop" data-toggle="dropdown">
							<i class="fa fa-user"></i><?php echo " ".$uname ?>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out" style="font-size:24px;color:red"></i>Logout</a>
						</div>
					</li>
				</ul>
			</nav>
		</div>
		<br>
		<div class="container">
			<h2 align="center">Update your Personal Data</h2>
			<hr>
		</div>
		<br>
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-body box">
					<div class="row">
						<div class="col-md-3">
						</div>
						<div class="col-md-6">
							<br><br>
							<form action="" method="POST">
								<div class="form-group" style="width:100%; float:left;">
									<input type="text" name="name" id="name" placeholder="Full Name" pattern="[A-Za-z ]{1,}" title="Only alphabets are allowed" class="form-control" value='<?php echo $name; ?>' required>
								</div>
								<div class="form-group" style="width: 50%; float: left;">
									<input type="password" name="password" id="password" placeholder="Password" title="Password lenght 8-16" class="form-control" pattern=.{8,16}>
								</div>
								<div class="form-group" style="width: 50%; float: left;">
									<input type="password" name="c_password" id="c_password" placeholder="Confirm Password" title="Password lenght 8-16" class="form-control" pattern=.{8,16} onblur="check_password();">
								</div>
								<div class="form-group" style="width:40%; float:left">
									<input type="text" name="regno" id="regno" placeholder="Registration Number" onblur="reg();" pattern="[A-Z0-9a-z]{1,}" title="Only alpha-numreric characters are allowed" class="form-control" value=<?php echo $regno; ?> required>
								</div>
								<?php
									if($dept=="mca")
										echo "<div class=\"form-group\" style=\"width:30%; float:left;\">
																<select name=\"dept\" id=\"dept\" class=\"form-control\" onchange=\"y();\">
																					<option value=\"mca\" selected>MCA</option>
																					<option value=\"cse\">CSE</option>
																					<option value=\"ece\">ECE</option>
																</select>
											</div>";
									else if($dept=="cse")
										echo "<div class=\"form-group\" style=\"width:30%; float:left;\">
																<select name=\"dept\" id=\"dept\" class=\"form-control\" onchange=\"y();\">
																					<option value=\"mca\">MCA</option>
																					<option value=\"cse\" selected>CSE</option>
																					<option value=\"ece\">ECE</option>
																</select>
											</div>";
									else if($dept=="ece")
										echo "<div class=\"form-group\" style=\"width:30%; float:left;\">
																<select name=\"dept\" id=\"dept\" class=\"form-control\" onchange=\"y();\">
																					<option value=\"mca\">MCA</option>
																					<option value=\"cse\">CSE</option>
																					<option value=\"ece\" selected>ECE</option>
																</select>
											</div>";
								?>
								<?php
									if($year=="1")
										echo "<div class=\"form-group\" style=\"width:30%; float:left;\">
																<select name=\"year\" id=\"year\" class=\"form-control\">
																					<option value=\"1\" selected>1<sup>st</sup> year</option>
																					<option value=\"2\">2<sup>nd</sup> year</option>
																					<option value=\"3\">3<sup>rd</sup> year</option>
																					<option value=\"4\" style=\"display:none;\" id=\"four\">4<sup>th</sup> year</option>
																</select>
											</div>";
									else if($year=="2")
										echo "<div class=\"form-group\" style=\"width:30%; float:left;\">
																<select name=\"year\" id=\"year\" class=\"form-control\">
																					<option value=\"1\">1<sup>st</sup> year</option>
																					<option value=\"2\" selected>2<sup>nd</sup> year</option>
																					<option value=\"3\">3<sup>rd</sup> year</option>
																					<option value=\"4\" style=\"display:none;\" id=\"four\">4<sup>th</sup> year</option>
																</select>
											</div>";
									else if($year=="3")
										echo "<div class=\"form-group\" style=\"width:30%; float:left;\">
																<select name=\"year\" id=\"year\" class=\"form-control\">
																					<option value=\"1\">1<sup>st</sup> year</option>
																					<option value=\"2\">2<sup>nd</sup> year</option>
																					<option value=\"3\" selected>3<sup>rd</sup> year</option>
																					<option value=\"4\" style=\"display:none;\" id=\"four\">4<sup>th</sup> year</option>
																</select>
											</div>";
									else if($year=="4")
										echo "<div class=\"form-group\" style=\"width:30%; float:left;\">
																<select name=\"year\" id=\"year\" class=\"form-control\">
																					<option value=\"1\">1<sup>st</sup> year</option>
																					<option value=\"2\">2<sup>nd</sup> year</option>
																					<option value=\"3\">3<sup>rd</sup> year</option>
																					<option value=\"4\" style=\"display:none;\" id=\"four\" selected>4<sup>th</sup> year</option>
																</select>
											</div>";
								?>
								<div class="form-group" style="width:50%; float:left;">
									<input type="text" name="uname" id="uname" placeholder="Enter a Username" pattern="[A-Za-z0-9]{3,16}"  class="form-control" required autocomplete="off" value='<?php echo $uname; ?>' disabled title="THIS IS PERMANENT" >
								</div>
								<div class="form-group" style="width:50%; float:left;">
									<input type="email" name="email" id="email" placeholder="E-mail ID" title="Enter a Valid E-mail address" class="form-control" onblur="checkemail();" required autocomplete="off" value='<?php echo $email; ?>'>
								</div>
								<?php
									if($gender=="male")
										echo "<div class=\"form-group\" style=\"width:30%; float:left\">
																<select name=\"gender\" id=\"gender\" class=\"form-control\">
																					<option value=\"male\" selected>MALE</option>
																					<option value=\"female\">FEMALE</option>
																</select>
											</div>";
									else if($gender=="female")
										echo "<div class=\"form-group\" style=\"width:30%; float:left\">
																<select name=\"gender\" id=\"gender\" class=\"form-control\">
																					<option value=\"male\">MALE</option>
																					<option value=\"female\" selected>FEMALE</option>
																</select>
											</div>";
								?>
								<div class="form-group" style="width:70%; float:left;">
									<input type="text" name="phone" id="phone" placeholder="Phone Number" title="Enter a Valid Phone Number" class="form-control" pattern="[0-9]{10,10}" required value='<?php echo $phone; ?>'>
								</div>
								<center><span id="msg" style="display: none; color:red;">Message</span></center>
								<br>
								<div class="form-group">
									<center><input type="submit" name="update" value="UPDATE" class="btn-primary" onclick="return check();">
									</center>
								</div>
							</form>
							<span>NOTE: You can leave the Password field empty or you can fill it in order to change the Password.</span>
						</div>
						<div class="col-md-3">
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>