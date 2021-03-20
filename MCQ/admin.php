<?php
	session_start();
	if(isset($_SESSION['admin']))
		header("location:adminHome.php");
?>

<?php
	if(isset($_POST['login']))
	{
		include_once('db_connect.php');
		$uname=$_POST['uname'];
		$pswrd=md5($_POST['pswrd']);
		$sql_query="SELECT * FROM admin WHERE username='$uname' AND password='$pswrd' LIMIT 1 ";
		if(! $result=mysqli_query($db_conn,$sql_query)){
			echo "<script>alert(\"oops\")</script>";
			exit();
		}
		$check=mysqli_num_rows($result);
		if($check > 0){
			
			session_start();
			$_SESSION['admin']=$uname;
			header("location:adminHome.php");
		}
		else{
			echo "<script>alert(\"Wrong Username Password\")</script>";
			echo "<script>window.location=\"admin.php\";</script>";
			exit();
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>ADMIN</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  		<style type="text/css" media="screen">
  			img
  			{
  				border-radius:50%;
  			}	
  		</style>
	</head>
	<body style="background-color:#E6E6FA">
		<br><br>
		<div class="container" style="background-color:#E6E6FA" >
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<div class="panel panel-primary">
						<div class="panel-heading">ADMIN LOGIN</div>
						<div class="panel-body">
							<br><br><br>
							<center><img src="admin.png" alt="Avatar" style="width:200px"></center>
							<br><br><br>
							<form method="POST">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input type="text" class="form-control" name="uname" placeholder="Username">
								</div>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input type="password" class="form-control" name="pswrd" placeholder="Password">
								</div>
								<br>
								<input type="submit" name="login" class="btn btn-primary btn-block" value="LOGIN" style="border-radius: 25px;">
							</form>
							<br><br><br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>