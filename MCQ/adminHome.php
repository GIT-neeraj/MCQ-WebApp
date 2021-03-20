<?php
	session_start();
	if(! isset($_SESSION['admin']))
	{
		header("location:admin.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Home</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
			.box
			{
				height: 450px;
				width: 1160px;
				box-shadow: 10px 10px 10px grey;
				border-style: ridge ;
				overflow: auto;
			}
			hr
			{
				box-shadow: 5px 5px 5px blue;
				color: grey;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li>	&nbsp;	&nbsp;	&nbsp;</li>
						<li class="active"><a class="navbar-brand glyphicon glyphicon-home" href="adminHome.php">  Home</a></li>
						<li><a href="userInfo.php">Users Info</a></li>
						<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Modules <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="addTest.php">Add Test</a></li>
							<li><a href="manageTest.php">Manage Test</a></li>
						</ul>
					</li>
					<li><a href="testResult.php">Test Result</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				</ul>
			</div>
		</nav>
		<div class="container">
			<h1>Welcome Admin</h1>
			<hr>
		</div>
		<br>
		<div class="container box">
		</div>
	</div>
</body>
</html>