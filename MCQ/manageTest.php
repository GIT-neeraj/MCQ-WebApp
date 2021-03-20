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
		echo "<script>window.location=\"manageTest.php\";</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Manage Test</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			hr
			{
				box-shadow: 3px 3px 3px;
				size: 10px;
				border-color: #0099ff;
			}
		</style>
		<script>
			function change_status(uid)
			{
				var ajx=new XMLHttpRequest();
				ajx.onreadystatechange = function()
				{
					if(this.readyState==4 && this.status==200)
					{
						if(this.responseText=="done")
							window.location="manageTest.php";
					}
				}
				ajx.open( "POST", "changeStatus.php", true );
				ajx.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
				ajx.send( "uid=" +uid );
			}
		</script>
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
			<h1 style="font-family: monospace;">Manage Test</h1>
			<hr>
			<div class="panel panel-default">
				<div class="panel panel-heading">
					<span class="glyphicon glyphicon-tasks">&nbsp;Test Listing</span>
				</div>
				<div class="panel panel-body" style="height:400px;">
					<table class="table table-hover table-bordered">
						<thead>
							<tr class="active">
								<th style="text-align: center;">Test Name</th>
								<th style="text-align: center;">Duration</th>
								<th style="text-align: center;">Status</th>
								<th style="text-align: center;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								include_once('db_connect.php');

								$tr="";
								$sql_query="SELECT * FROM tests";
								$result=mysqli_query($db_conn,$sql_query);
								while($row=mysqli_fetch_assoc($result))
								{
									$uid=$row['uid'];
									$test=$row['name'];
									$duration=$row['duration_minutes']." Minutes";
									$status=$row['active_flag'];

									if($status=="active")
									{
										$tr .= "<tr>
												<td><center> $test </center></td>
												<td><center> $duration </center></td>
												<td><center> <button class=\"btn btn-success\" onclick=\"change_status($uid);\"> $status </button> </center></td>
												<td><center> <a class=\"btn btn-info\" href=\"manageQuestions.php?uid=$uid\"><i class=\"fa fa-gear fa-spin\" style=\"font-size:18px\"></i>&nbsp;Manage Questions</a> <a class=\"btn btn-warning\" href=\"editTest.php?uid=$uid\"><i class=\"fa fa-edit\"></i>&nbsp;Edit</a> <button class=\"btn btn-danger\" onclick=\"delete_test($uid);\"><i class=\"fa fa-trash\"></i>&nbsp;Delete</button> </center></td>
											</tr>";
									}
									else
									{
										$tr .= "<tr>
												<td><center> $test </center></td>
												<td><center> $duration </center></td>
												<td><center> <button class=\"btn btn-danger\" onclick=\"change_status($uid);\"> $status </button> </center></td>
												<td><center> <a class=\"btn btn-info\" href=\"manageQuestions.php?uid=$uid\"><i class=\"fa fa-gear fa-spin\" style=\"font-size:18px\"></i>&nbsp;Manage Questions</a> <a class=\"btn btn-warning\" href=\"editTest.php?uid=$uid\"><i class=\"fa fa-edit\"></i>&nbsp;Edit</a> <button class=\"btn btn-danger\" onclick=\"delete_test($uid);\"><i class=\"fa fa-trash\"></i>&nbsp;Delete</button> </center></td>
											</tr>";
									}
								}
								echo $tr;
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>