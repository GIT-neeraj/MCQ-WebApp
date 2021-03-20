<?php
session_start();
if ( isset( $_SESSION[ 'uname' ] ) )
	header( "location:home.php" );
?>
<?php
if ( isset( $_GET[ 'msg' ] ) ) {
	$msg = $_GET[ 'msg' ];
echo '<script> alert("' . $msg . '");</script>';
echo '<script>window.location="index.php";</script>';
}
?>
<?php
if ( isset( $_POST[ 'login_submit' ] ) ) {
	include_once( 'db_connect.php' );
	$uoe = $_POST[ 'uoe' ];
	$pswrd = md5( $_POST[ 'pswrd' ] );
	$sql = "SELECT * FROM participation WHERE uname='$uoe' OR email='$uoe' LIMIT 1";
	$query = mysqli_query( $db_conn, $sql );
	$ucheck = mysqli_num_rows( $query );
	if ( $ucheck == 0 ) {
		header( "location:index.php?msg=USERNAME OR EMAIL ID NOT FOUND" );
	} else {
		$row = mysqli_fetch_assoc( $query );
		$uname = $row[ 'uname' ];
		$pswrd2 = $row[ 'password' ];
		if ( $pswrd != $pswrd2 ) {
			header( "location:index.php?msg=PASSWORD IS INCORRECT" );
		} else {
			session_start();
			$_SESSION[ 'uname' ] = $uname;
			header( "location:home.php" );
		}
	}
}
?>
<?php
if ( isset( $_POST[ "reg_submit" ] ) ) {
	include_once( 'db_connect.php' );
	$name = preg_replace( '#[^A-Za-z ]#i', '', $_POST[ 'name' ] );
	$password = md5( $_POST[ 'password' ] );
	$c_password = md5( $_POST[ 'c_password' ] );
	$regno = preg_replace( '#[^A-Za-z0-9]#i', '', $_POST[ 'regno' ] );
	$dept = $_POST[ 'dept' ];
	$year = $_POST[ 'year' ];
	$uname = $_POST[ 'uname' ];
	$email = mysqli_real_escape_string( $db_conn, $_POST[ 'email' ] );
	$gender = $_POST[ 'gender' ];
	$phone = preg_replace( '#[^0-9]#i', '', $_POST[ 'phone' ] );
	$sql = "SELECT * from participation WHERE uname='$uname' LIMIT 1";
	$query = mysqli_query( $db_conn, $sql );
	$u_check = mysqli_num_rows( $query );
	$sql = "SELECT * FROM participation WHERE email='$email' LIMIT 1";
	$query = mysqli_query( $db_conn, $sql );
	$e_check = mysqli_num_rows( $query );
	if ( $name == "" || $password == "" || $c_password == "" || $regno == "" || $dept == "" || $year == "" || $uname == "" || $email == "" || $gender == "" || $phone == "" )
		header( "location:index.php?msg=PLEASE FILL UP ALL THE FIELDS" );
	else if ( $u_check > 0 )
		header( "location:index.php?msg=THE USERNAME IS ALREADY TAKEN" );
	else if ( $e_check > 0 )
		header( "loaction:index.php?errmsg=THIS EMAIL ID IS ALREADY USED IN ANOTHER REGISTRATION" );
	else if ( strlen( $uname ) < 3 || strlen( $uname ) > 16 )
		header( "location:index.php?msg=THE LENGTH OF THE USERNAME SHOULD BE BETWEEN 3 TO 16" );
	else if ( strlen( $phone ) != 10 || !is_numeric( $phone ) )
		header( "location:index.php?msg=ENTER A VALID PHONE NUMBER" );
	else if ( strlen( $regno ) > 29 )
		header( "loaction:index.php?msg=REGISTRATION NUMBER IS TOO LONG" );
	else if ( $password != $c_password )
		header( "location:index.php?msg=PASSWORD FIELD DOESN'T MATCH" );
	else {
		$sql = "INSERT INTO participation (name, password, regno, dept, year, uname, email, gender, phone)VALUES('$name','$password','$regno','$dept','$year','$uname','$email','$gender','$phone')";
		$query = mysqli_query( $db_conn, $sql );
		header( "location:index.php?msg=REGISTRATION DONE SUCCESFULLY" );
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			function y() {
				var x = document.getElementById( 'dept' ).value;
				if ( x != "mca" )
					document.getElementById( 'four' ).style.display = "block";
				else {
					document.getElementById( 'four' ).style.display = "none";
					document.getElementById( 'year' ).value = "1";
				}
			}
			function reg() {
				var x = document.getElementById( 'regno' ).value;
				if ( x.length > 29 ) {
					alert( "Registration Number is too long" );
					document.getElementById( 'regno' ).value = "";
				}
			}
			function checkuname() {
				var x = document.getElementById( 'uname' ).value;
				if ( x != "" ) {
					document.getElementById( 'uname' ).style.background = "url(checking.gif) no-repeat";
					document.getElementById( 'uname' ).style.backgroundSize = "25px 25px";
					document.getElementById( 'uname' ).style.backgroundPosition = "right";
					var ajx = new XMLHttpRequest();
					ajx.onreadystatechange = function () {
						if ( this.readyState == 4 && this.status == 200 ) {
							if ( this.responseText == "length of username should be between 3 to 16" ) {
								document.getElementById( 'uname' ).style.background = "url(error.gif) no-repeat";
								document.getElementById( 'uname' ).style.backgroundSize = "25px 25px";
								document.getElementById( 'uname' ).style.backgroundPosition = "right";
								document.getElementById( 'uname' ).title = "Lenght of username should be between 3 to 16";
							} else if ( this.responseText == "not alphanumeric" ) {
								document.getElementById( 'uname' ).style.background = "url(error.gif) no-repeat";
								document.getElementById( 'uname' ).style.backgroundSize = "25px 25px";
								document.getElementById( 'uname' ).style.backgroundPosition = "right";
								document.getElementById( 'uname' ).title = "Username should be alphanumeric";
							} else if ( this.responseText == "username taken" ) {
								document.getElementById( 'uname' ).style.background = "url(error.gif) no-repeat";
								document.getElementById( 'uname' ).style.backgroundSize = "25px 25px";
								document.getElementById( 'uname' ).style.backgroundPosition = "right";
								document.getElementById( 'uname' ).title = "This username is already taken (Try another one)";
							} else if ( this.responseText == "ok" ) {
								document.getElementById( 'uname' ).style.background = "url(ok.gif) no-repeat";
								document.getElementById( 'uname' ).style.backgroundSize = "25px 25px";
								document.getElementById( 'uname' ).style.backgroundPosition = "right";
								document.getElementById( 'uname' ).title = "Username accepted";
							}
						}
					}
					ajx.open( "POST", "unameCheck.php", true );
					ajx.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
					ajx.send( "unamecheck=" + x );
				} else {
					document.getElementById( 'uname' ).style.background = "none";
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
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-11">
					<h1> MCQ KHICHDI </h1>
				</div>
				<div class="col-md-1">
					<button type="button" data-toggle="modal" data-target="#myModal"> LOGIN</button>
				</div>
			</div>
			<br><br><br>
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 align="center"> Registration Form</h3>
						</div>
						<br>
						<form action="" method="POST">
							<div class="panel-body">
								<div class="form-group" style="width:100%; float:left;">
									<input type="text" name="name" id="name" placeholder="Full Name" pattern="[A-Za-z ]{1,}" title="Only alphabets are allowed" class="form-control" required>
								</div>
								<div class="form-group" style="width: 50%; float: left;">
									<input type="password" name="password" id="password" placeholder="Password" title="Password lenght 8-16" class="form-control" pattern=.{8,16} required>
								</div>
								<div class="form-group" style="width: 50%; float: left;">
									<input type="password" name="c_password" id="c_password" placeholder="Confirm Password" title="Password lenght 8-16" class="form-control" pattern=.{8,16} required onblur="check_password();">
								</div>
								<div class="form-group" style="width:40%; float:left">
									<input type="text" name="regno" id="regno" placeholder="Registration Number" onblur="reg();" pattern="[A-Z0-9a-z]{1,}" title="Only alpha-numreric characters are allowed" class="form-control" required>
								</div>
								<div class="form-group" style="width:30%; float:left;">
									<select name="dept" id="dept" class="form-control" onchange="y();">
										<option value="mca" selected>MCA</option>
										<option value="cse">CSE</option>
										<option value="ece">ECE</option>
									</select>
								</div>
								<div class="form-group" style="width:30%; float:left;">
									<select name="year" id="year" class="form-control">
										<option value="1" selected>1<sup>st</sup> year</option>
										<option value="2">2<sup>nd</sup> year</option>
										<option value="3">3<sup>rd</sup> year</option>
										<option value="4" style="display:none;" id="four">4<sup>th</sup> year</option>
									</select>
								</div>
								<div class="form-group" style="width:50%; float:left;">
									<input type="text" name="uname" id="uname" placeholder="Enter a Username" pattern="[A-Za-z0-9]{3,16}" title="Only alpha-numreric characters are allowed with lenght of 3 to 16" class="form-control" onkeyup="checkuname();" required autocomplete="off">
								</div>
								<div class="form-group" style="width:50%; float:left;">
									<input type="email" name="email" id="email" placeholder="E-mail ID" title="Enter a Valid E-mail address" class="form-control" onblur="checkemail();" required autocomplete="off">
								</div>
								<div class="form-group" style="width:30%; float:left">
									<select name="gender" id="gender" class="form-control">
										<option value="male" selected>MALE</option>
										<option value="female">FEMALE</option>
									</select>
								</div>
								<div class="form-group" style="width:70%; float:left;">
									<input type="text" name="phone" id="phone" placeholder="Phone Number" title="Enter a Valid Phone Number" class="form-control" pattern="[0-9]{10,10}" required>
								</div>
							</div>
							<div class="panel-footer">
								<div class="form-group">
									<center><input type="submit" name="reg_submit" value="Register">
									</center>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<!-- The Modal -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Take the Quiz</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<form action="" method="post">
					<div class="form-group">
						<label for="email">Username:</label>
						<input type="text" class="form-control" id="uoe" name="uoe">
					</div>
					<div class="form-group">
						<label for="pass">Password:</label>
						<input type="password" class="form-control" id="pswrd" name="pswrd">
					</div>
					<input type="submit" class="btn btn-primary" value="Submit" name="login_submit">
				</form>
			</div>
		</div>
	</div>
</div>