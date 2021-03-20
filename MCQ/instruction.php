<?php
	session_start();
	if(isset($_SESSION['uname']))
	{
		$uname=$_SESSION['uname'];
	}
	else
	{
		header("location:index.php?msg=TRY REGISTRATION/LOGIN FIRST");
	}
?>
<?php
	if(isset($_GET['uid']))
	{
		$uid=$_GET['uid'];
		include_once('db_connect.php');

		$sql_query="SELECT name,duration_minutes,active_flag FROM tests WHERE uid='$uid' LIMIT 1";
		$result=mysqli_query($db_conn,$sql_query);
		$tcheck=mysqli_num_rows($result);
		if($tcheck==0)
		{
			header("location:home.php?msg=TEST DOESN'T EXIST");
		}
		else
		{
			$row=mysqli_fetch_assoc($result);
			$test=$row['name'];
			$duration=$row['duration_minutes'];
			$status=$row['active_flag'];
			if($status!="active")
				header("location:home.php?msg=this test is not active");

			$test_ans=$test."_ans";
			$sql_query="SELECT * FROM $test_ans where uname='$uname' LIMIT 1 ";
			$result=mysqli_query($db_conn,$sql_query);
			$ucheck=mysqli_num_rows($result);
			if($ucheck==0)
			{
				$sql_query="INSERT INTO $test_ans (uname) VALUES ('$uname') ";
				mysqli_query($sql_query);
			}
			else
			{
				$sql_query="SELECT attempted FROM $test_ans WHERE uname='$uname' LIMIT 1";
				$result=mysqli_query($db_conn,$sql_query);
				$row=mysqli_fetch_assoc($result);
				$attempted=$row['attempted'];
				if($attempted=="yes")
				header("location:home.php?msg=you have already attempted this test");
			}

			$sql_query="SELECT uid FROM $test";
			$result=mysqli_query($db_conn,$sql_query);
			$qcheck=mysqli_num_rows($result);
			if($qcheck==0)
			{
				header("location:home.php?msg=questions are not added for this test");
			}
		}
		
	}
	else
	{
		header("location:home.php?msg=Select Test");
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
			height: 450px;
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
						<a class="nav-link dropdown-toggle active" href="#" id="navbardrop" data-toggle="dropdown">
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
									echo "<a class=\"dropdown-item active\" href=\"instruction.php?uid=$uid\">".$name."</a>";
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
			<h1>INSTRUCTIONS</h1>
			<hr>
		</div>
		<br>
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-body box">
					<div class="col-md-4">
					</div>
					<div class="col-md-8">
						<br><br><br>
						<ul>
							<li>Don't refresh or go back while taking the test</li>
							<li>You will get only one chance to take the test. refreshing the page or going back will make you loose that chance.</li>
							<li>Once you choose any of the four provided options for a particular question, consider your response saved.</li>
							<li>You can leave the test anytime you want keeping in mind that you can't take the test again.</li>
							<br><br><br>
							<h3>Test Name: <?php echo $test; ?> </h3>
							<h4>Duration: <?php echo $duration." Minutes"; ?> </h4>
							<?php echo "<a class=\"btn btn-primary\" href=\"test.php?uid=$uid\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OK, TAKE ME TO THE TEST &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>"
							?> 
						</ul>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>