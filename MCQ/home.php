<?php
	session_start();
	if(isset($_SESSION['uname']))
	{
		$uname=$_SESSION['uname'];
	}
	else
	{
		header("location:index.php?msg=TRY LOGIN/REGISTARION FIRST");
	}
?>
<?php
if ( isset( $_GET[ 'msg' ] ) ) {
	$msg = $_GET[ 'msg' ];
echo '<script> alert("' . $msg . '");</script>';
echo '<script>window.location="index.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>HOME</title>
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
			height: 420px;
			width: 1120px;
			box-shadow: 10px 10px 10px grey;
			border-style: ridge ;
				overflow: auto;
		}
	</style>
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
								$sql="SELECT uid,name FROM tests WHERE active_flag='active' ";
								$result=mysqli_query($db_conn,$sql);
								while($row=mysqli_fetch_assoc($result))
								{
									$uid=$row['uid'];
									$name=$row['name'];
									echo "<a class=\"dropdown-item\" href=\"instruction.php?uid=$uid\">".$name."</a>";
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
								$sql="SELECT uid,name FROM tests WHERE active_flag='active' ";
								$result=mysqli_query($db_conn,$sql);
								while($row=mysqli_fetch_assoc($result))
								{
									$name=$row['name'];
									$uid=$row['uid'];
									echo "<a class=\"dropdown-item\" href=\"result.php?uid=$uid\">".$name."</a>";
								}
							?>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="editProfile.php">Edit Profile</a>
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
			<h1>Welcome to Online Test System</h1>
			<hr>
		</div>
		<br>
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-body box">
					<img src="ots.png" alt="" style="height: 400px; width: 1100px;">
				</div>
			</div>
		</div>
	</body>
</html>