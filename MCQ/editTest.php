<?php
	session_start();
	if(isset($_SESSION['admin']) && isset($_GET['uid']))
	{
		$uid=$_GET['uid'];
		include_once('db_connect.php');
		$sql_query="SELECT * FROM tests WHERE uid='$uid' LIMIT 1";
		$result=mysqli_query($db_conn,$sql_query);
		$check=mysqli_num_rows($result);
		if($check==0)
		{
			header("location:manageTest.php?msg=Test not found");
		}
		else
		{
			$row=mysqli_fetch_assoc($result);
			$test=$row['name'];
			$duration=$row['duration_minutes'];
			$status=$row['active_flag'];
		}
	}
	else if(isset($_SESSION['admin']))
	{
		header("location:manageTest.php?msg=Test not selected");
	}
	else
	{
		header("location:admin.php");
	}
?>
<?php
	if(isset($_POST['test_update']))
	{
		include_once('db_connect.php');
		$test_new=$_POST['name'];
		$duration_new=$_POST['duration'];
		if(isset($_POST['status']))
			$status_new=$_POST['status'];
		else
			$status_new="inactive";

		$test_ans=$test."_ans";
		$test_new_ans=$test_new."_ans";

		$sql_query="ALTER TABLE $test RENAME TO $test_new";
		mysqli_query($db_conn,$sql_query);
		$sql_query="ALTER TABLE $test_ans RENAME TO $test_new_ans";
		mysqli_query($db_conn,$sql_query);

		$sql_query="UPDATE tests SET name='$test_new' , duration_minutes='$duration_new' , active_flag='$status_new' WHERE uid='$uid' LIMIT 1 ";
		mysqli_query($db_conn,$sql_query);

		header("location:manageTest.php?msg=Everything done successfully");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Edit Test</title>
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
								<li><a href="addTest.php">Add Test</a></li>
								<li class="active"><a href="manageTest.php">Manage Test</a></li>
							</ul>
						</li>
						<li><a href="testResult.php">Test Result</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
					</ul>
				</div>
			</nav>
			<h1 style="font-family: monospace;">Edit Test</h1>
			<hr>
			<div class="panel panel-default">
				<div class="panel panel-heading">
					<span class="glyphicon glyphicon-edit">&nbsp;Edit TEST</span>
				</div>
				<div class="panel panel-body" style="height:400px;">
					<div class="col-md-1">
					</div>
					<div class="col-md-7">
						<form method="POST">
							<div class="form-group" >
								<label class="control-label" for="name" style="width:20%; float:left; font-size:20px; text-align: right;">Test Name: &nbsp;</label>
								<input type="text" name="name" id="name" placeholder="Test Name" pattern="[A-Za-z0-9 ]{1,}" title="Alphanumeric Value" class="form-control" required style="width:60%; float:left;" value='<?php echo $test; ?>' >
							</div>
							<br><br><br>
							<div class="form-group" >
								<label class="control-label" for="duration" style="width:20%; float:left; font-size:20px; text-align:right;">Duration: &nbsp;</label>
								<input type="text" name="duration" id="duration" placeholder="Duration" pattern="[0-9]{1,}" title="Numeric Value" class="form-control" required style="width:30%; float:left;" value='<?php echo $duration; ?>'>
								<label class="btn btn-default" style="width:30%; text-align: center;" id="minutes">Minutes</label>
							</div>
							<div class="form-group">
								<label class="control-label" for="duration" style="width:20%; float:left; font-size:20px; text-align:right;">Active: &nbsp;</label>
								 <?php
								 	if($status=="active")
								 		echo "<div class=\"checkbox\"><label><input type=\"checkbox\" value=\"active\" style=\"height: 25px;\" name=\"status\" checked></label></div>";
								 	else
								 		echo "<div class=\"checkbox\"><label><input type=\"checkbox\" value=\"active\" style=\"height: 25px;\" name=\"status\" ></label></div>";
								 ?>
							</div>
							<div class="form-group">
									<center><input type="submit" name="test_update" Value="Update" class="btn btn-primary"></center>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>