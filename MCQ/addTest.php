<?php
	session_start();
	if(! isset($_SESSION['admin']))
	{
		header("location:admin.php");
	}
?>
<?php
	if(isset($_GET['msg']))
	{
		$msg=$_GET['msg'];
		echo "<script>alert('".$msg."');</script>";
		echo "<script>window.location=\"addTest.php\";</script>";
	}
?>
<?php
	if(isset($_POST['test_submit']))
	{
		include_once('db_connect.php');

		$test=$_POST['name'];
		$duration=$_POST['duration'];
		if(isset($_POST['status']))
			$status=$_POST['status'];
		else
			$status="inactive";

		$sql_query="SELECT uid from tests WHERE name='$test' LIMIT 1";
		$result=mysqli_query($db_conn,$sql_query);
		$tcheck=mysqli_num_rows($result);
		if($tcheck > 0)
		{
			header("location:addTest.php?msg=Test name already exist");
			exit();
		}

		$sql_query="CREATE TABLE mcq.$test ( uid INT NOT NULL AUTO_INCREMENT , question VARCHAR(500) NOT NULL , a VARCHAR(100) NOT NULL , b VARCHAR(100) NOT NULL , c VARCHAR(100) NOT NULL , d VARCHAR(100) NOT NULL , correct_option VARCHAR(5) NOT NULL , PRIMARY KEY (uid)) ENGINE = InnoDB";
		mysqli_query($db_conn,$sql_query);

		$sql_query="INSERT INTO tests (uid, name, duration_minutes, active_flag) VALUES (NULL, '$test', '$duration', '$status')";
		mysqli_query($db_conn,$sql_query);

		$test_ans=$test."_ans";

		$sql_query="CREATE TABLE mcq.$test_ans ( uname VARCHAR(20) NOT NULL attempted VARCHAR(5) NOT NULL , PRIMARY KEY (uname)) ENGINE = InnoDB";
		mysqli_query($db_conn,$sql_query);

		header("location:addTest.php?msg=Everything done Successfully");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Add Test</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
			hr
			{
				box-shadow: 3px 3px 3px;
				size: 10px;
				border-color: #0099ff;
			}
			#minutes
			{
				background-color: rgb(230, 230, 230);
				cursor: context-menu;
				border-color: rgb(230, 230, 230);
			}
		</style>
	</head>
	<body>
		<div class="container">
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li>	&nbsp;	&nbsp;	&nbsp;</li>
						<li><a class="navbar-brand glyphicon glyphicon-home" href="adminHome.php">  Home</a></li>
						<li><a href="userInfo.php">Users Info</a></li>
						<li class="dropdown active"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Modules <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li class="active"><a href="addTest.php">Add Test</a></li>
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
			<h1 style="font-family: monospace;">ADD Test</h1>
			<hr>
			<div class="panel panel-default">
				<div class="panel panel-heading">
					<span class="glyphicon glyphicon-edit">&nbsp;ADD TEST</span>
				</div>
				<div class="panel panel-body" style="height:400px;">
					<div class="col-md-1">
					</div>
					<div class="col-md-7">
						<form method="POST">
							<div class="form-group" >
								<label class="control-label" for="name" style="width:20%; float:left; font-size:20px; text-align: right;">Test Name: &nbsp;</label>
								<input type="text" name="name" id="name" placeholder="Test Name" pattern="[A-Za-z0-9 ]{1,}" title="Alphanumeric Value" class="form-control" required style="width:60%; float:left;">
							</div>
							<br><br><br>
							<div class="form-group" >
								<label class="control-label" for="duration" style="width:20%; float:left; font-size:20px; text-align:right;">Duration: &nbsp;</label>
								<input type="text" name="duration" id="duration" placeholder="Duration" pattern="[0-9]{1,}" title="Numeric Value" class="form-control" required style="width:30%; float:left;">
								<label class="btn btn-default" style="width:30%; text-align: center;" id="minutes">Minutes</label>
							</div>
							<div class="form-group">
								<label class="control-label" for="duration" style="width:20%; float:left; font-size:20px; text-align:right;">Active: &nbsp;</label>
								 <div class="checkbox"><label><input type="checkbox" value="active" style="height: 25px;" name="status" checked></label></div>
							</div>
							<div class="form-group">
									<center><input type="submit" name="test_submit" Value="ADD" class="btn btn-primary"></center>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>