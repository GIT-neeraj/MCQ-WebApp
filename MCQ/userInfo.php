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
		<title>User Info</title>
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
		</style>
	</head>
	<body>
		<div class="container">
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li>	&nbsp;	&nbsp;	&nbsp;</li>
						<li><a class="navbar-brand glyphicon glyphicon-home" href="adminHome.php">  Home</a></li>
						<li class="active"><a href="userInfo.php">Users Info</a></li>
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
			<h1 style="font-family:monospace;">User Listing</h1>
			<hr>
			<div class="panel panel-default">
				<div class="panel panel-heading">
					<span class="glyphicon glyphicon-th-list">&nbsp;User Listing</span>
				</div>
				<div class="panel panel-body" style="overflow: auto; height:400px;">
					<table class="table table-hover">
						<thead class="table-dark text-dark">
							<tr>
								<th>Username</th>
								<th>Name</th>
								<th>Registration no.</th>
								<th>Department</th>
								<th>Year</th>
								<th>E-mail</th>
								<th>Gender</th>
								<th>Phone no.</th>
							</tr>
						</thead>
						<tbody>
							<?php
								include_once('db_connect.php');
								$sql_query="SELECT * FROM participation ";
								$result=mysqli_query($db_conn,$sql_query);
								$tr="";
								$i=1;
								while($row=mysqli_fetch_assoc($result))
								{
									$name=$row['name'];
									$regno=$row['regno'];
									$dept=$row['dept'];
									$year=$row['year'];
									$uname=$row['uname'];
									$email=$row['email'];
									$gender=$row['gender'];
									$phone=$row['phone'];
									if($i>4)
										$i=1;
									if($i==1)
										$tr .= "<tr class=\"info\">
												<td>".$uname."</td>
												<td>".$name."</td>
												<td>".$regno."</td>
												<td>".$dept."</td>
												<td>".$year."</td>
												<td>".$email."</td>
												<td>".$gender."</td>
												<td>".$phone."</td>
											</tr>";
									else if($i==2)
										$tr .= "<tr class=\"danger\">
												<td>".$uname."</td>
												<td>".$name."</td>
												<td>".$regno."</td>
												<td>".$dept."</td>
												<td>".$year."</td>
												<td>".$email."</td>
												<td>".$gender."</td>
												<td>".$phone."</td>
											</tr>";
									else if($i==3)
										$tr .= "<tr class=\"success\">
												<td>".$uname."</td>
												<td>".$name."</td>
												<td>".$regno."</td>
												<td>".$dept."</td>
												<td>".$year."</td>
												<td>".$email."</td>
												<td>".$gender."</td>
												<td>".$phone."</td>
											</tr>";
									else if($i==4)
										$tr .= "<tr class=\"warning\">
												<td>".$uname."</td>
												<td>".$name."</td>
												<td>".$regno."</td>
												<td>".$dept."</td>
												<td>".$year."</td>
												<td>".$email."</td>
												<td>".$gender."</td>
												<td>".$phone."</td>
											</tr>";
									$i++;
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