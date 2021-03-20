<?php
	session_start();
	if(isset($_SESSION['admin']) && isset($_GET['uid']))
	{
		include_once('db_connect.php');
		$uid=$_GET['uid'];

		$sql_query="SELECT name FROM tests WHERE uid='$uid' LIMIT 1";
		$result=mysqli_query($db_conn,$sql_query);
		$row=mysqli_fetch_assoc($result);
		$test=$row['name'];
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
	if(isset($_POST['add']))
	{
		include_once('db_connect.php');

		$question=$_POST['question'];
		$a=$_POST['a'];
		$b=$_POST['b'];
		$c=$_POST['c'];
		$d=$_POST['d'];
		$correct_option=$_POST['correct_option'];

		$sql_query="INSERT INTO $test (question, a, b, c, d, correct_option) VALUES ('$question', '$a', '$b', '$c', '$d', '$correct_option')";
		if(!mysqli_query($db_conn,$sql_query))
			echo mysqli_error($db_conn);

		$test_ans=$test."_ans";

		$sql_query="SELECT count(*) AS num FROM information_schema.columns WHERE table_name = '$test_ans' ";
		$result=mysqli_query($db_conn,$sql_query);
		$row=mysqli_fetch_assoc($result);
		$num=$row['num']-1;
		$column="_".$num;

		$sql_query="ALTER TABLE $test_ans ADD $column VARCHAR(5) NOT NULL";
		if(!mysqli_query($db_conn,$sql_query))
			echo "<script> alert(\"uh oh\") </script>";
		else
			echo "<script> alert(\"new question added successfully\") </script>";
	}
?>
<?php
	if(isset($_POST['update']))
	{
		include_once('db_connect.php');
		$uid=$_POST['hidden_name'];

		$question_name="question".$uid;
		$a_name="a".$uid;
		$b_name="b".$uid;
		$c_name="c".$uid;
		$d_name="d".$uid;
		$correct_option_name="c_o".$uid;

		$question=$_POST[$question_name];
		$a=$_POST[$a_name];
		$b=$_POST[$b_name];
		$c=$_POST[$c_name];
		$d=$_POST[$d_name];
		$correct_option=$_POST[$correct_option_name];

		$sql_query="UPDATE $test SET question='$question' , a='$a' , b='$b' , c='$c' , d='$d' , correct_option='$correct_option' WHERE uid='$uid' LIMIT 1";
		if(mysqli_query($db_conn,$sql_query))
			echo "<script> alert(\"updated successfully\") </script>";
		else
			echo "<script> alert(\"uh oh\") </script>";
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Manage Questions</title>
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
			<h1 style="font-family: monospace;">Manage Questions</h1>
			<hr>
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<center><a data-toggle="collapse" href="#addquestion"><span style="color:white;"><i class="fa fa-plus"></i> &nbsp; ADD QUESTION </span></a></center>
					</div>
					<div id="addquestion" class="panel-collapse collapse">
						<form method="POST">
							<div class="panel-body" style="height: 500px;">
								<div class="form-group" >
									<label class="control-label" for="question" style="width:20%; float:left; font-size:20px; text-align: right;">QUESTION: &nbsp;</label>
									<textarea name="question" id="question"  pattern="[]{1,}" class="form-control" required style="width:70%; float:left;"></textarea>
								</div>
								<br><br><br>
								<div class="form-group">
									<label class="control-label" for="a" style="width:20%; float:left; font-size:20px; text-align: right;">OPTION A: &nbsp;</label>
									<textarea name="a" id="a"  pattern="[]{1,}" class="form-control" required style="width:70%; float:left;"></textarea>
								</div>
								<br><br><br>
								<div class="form-group">
									<label class="control-label" for="b" style="width:20%; float:left; font-size:20px; text-align: right;">OPTION B: &nbsp;</label>
									<textarea name="b" id="b"  pattern="[]{1,}" class="form-control" required style="width:70%; float:left;"></textarea>
								</div>
								<br><br><br>
								<div class="form-group">
									<label class="control-label" for="c" style="width:20%; float:left; font-size:20px; text-align: right;">OPTION C: &nbsp;</label>
									<textarea name="c" id="c"  pattern="[]{1,}" class="form-control" required style="width:70%; float:left;"></textarea>
								</div>
								<br><br><br>
								<div class="form-group">
									<label class="control-label" for="d" style="width:20%; float:left; font-size:20px; text-align: right;">OPTION D: &nbsp;</label>
									<textarea name="d" id="d"  pattern="[]{1,}" class="form-control" required style="width:70%; float:left;"></textarea>
								</div>
								<br><br><br>
								<div class="form-group">
									<label class="control-label" for="correct_option" style="width:20%; float:left; font-size:20px; text-align: right;">CORRECT OPTION: &nbsp;</label>
									<select class="form-control" id="correct_option" name="correct_option" style="width: 70%; float: left;">
        								<option value="a" selected>A</option>
        								<option value="b">B</option>
        								<option value="c">C</option>
        								<option value="d">D</option>
      								</select>
								</div>
							</div>
							<div class="panel-footer">
								<center>
									<input type="submit" value="ADD" name="add" class="btn btn-primary">
								</center>
							</div>
						</form>
					</div>
				</div>
				<?php
					include_once('db_connect.php');

					$sql_query="SELECT * FROM $test ";
					$result=mysqli_query($db_conn,$sql_query);
					while($row=mysqli_fetch_assoc($result))
					{
						$uid=$row['uid'];
						$question=$row['question'];
						$a=$row['a'];
						$b=$row['b'];
						$c=$row['c'];
						$d=$row['d'];
						$correct_option=$row['correct_option'];

						$question_name="question".$uid;
						$a_name="a".$uid;
						$b_name="b".$uid;
						$c_name="c".$uid;
						$d_name="d".$uid;
						$correct_option_name="c_o".$uid;

						$top="<div class=\"panel panel-info\">
									<div class=\"panel-heading\">
										<center><a data-toggle=\"collapse\" href=\"#$uid\"><span><i class=\"fa fa-question\"></i> &nbsp;QUESTION $uid</span></a></center>
									</div>
									<div id=\"$uid\" class=\"panel-collapse collapse\">
										<form method=\"POST\">
											<div class=\"panel-body\" style=\"height: 500px;\">
												<div class=\"form-group\">
													<label class=\"control-label\" for=\"$question_name\" style=\"width:20%; float:left; font-size:20px; text-align: right;\">QUESTION: &nbsp;</label>
													<textarea name=\"$question_name\" id=\"$question_name\"  pattern=\"[]{1,}\" class=\"form-control\" required style=\"width:70%; float:left;\">$question</textarea>
												</div>
												<br><br><br>
												<div class=\"form-group\">
													<label class=\"control-label\" for=\"$a_name\" style=\"width:20%; float:left; font-size:20px; text-align: right;\">OPTION A: &nbsp;</label>
													<textarea name=\"$a_name\" id=\"$a_name\"  pattern=\"[]{1,}\" class=\"form-control\" required style=\"width:70%; float:left;\">$a</textarea>
												</div>
												<br><br><br>
												<div class=\"form-group\">
													<label class=\"control-label\" for=\"$b_name\" style=\"width:20%; float:left; font-size:20px; text-align: right;\">OPTION B: &nbsp;</label>
													<textarea name=\"$b_name\" id=\"$b_name\"  pattern=\"[]{1,}\" class=\"form-control\" required style=\"width:70%; float:left;\">$b</textarea>
												</div>
												<br><br><br>
												<div class=\"form-group\">
													<label class=\"control-label\" for=\"$c_name\" style=\"width:20%; float:left; font-size:20px; text-align: right;\">OPTION C: &nbsp;</label>
													<textarea name=\"$c_name\" id=\"$c_name\"  pattern=\"[]{1,}\" class=\"form-control\" required style=\"width:70%; float:left;\">$c</textarea>
												</div>
												<br><br><br>
												<div class=\"form-group\">
													<label class=\"control-label\" for=\"$d_name\" style=\"width:20%; float:left; font-size:20px; text-align: right;\">OPTION D: &nbsp;</label>
													<textarea name=\"$d_name\" id=\"$d_name\"  pattern=\"[]{1,}\" class=\"form-control\" required style=\"width:70%; float:left;\">$d</textarea>
												</div>
												<br><br><br>
												<div class=\"form-group\">
													<label class=\"control-label\" for=\"$correct_option_name\" style=\"width:20%; float:left; font-size:20px; text-align: right;\">CORRECT OPTION: &nbsp;</label>
													<select class=\"form-control\" id=\"$correct_option_name\" name=\"$correct_option_name\" style=\"width: 70%; float: left;\">";

						if($correct_option=="a")
							$middle="<option value=\"a\" selected>A</option>
        							<option value=\"b\">B</option>
        							<option value=\"c\">C</option>
        							<option value=\"d\">D</option>";
        				else if($correct_option=="b")
        					$middle="<option value=\"a\">A</option>
        							<option value=\"b\" selected>B</option>
        							<option value=\"c\">C</option>
        							<option value=\"d\">D</option>";
        				else if($correct_option=="c")
        					$middle="<option value=\"a\">A</option>
        							<option value=\"b\">B</option>
        							<option value=\"c\" selected>C</option>
        							<option value=\"d\">D</option>";
        				else if($correct_option=="d")
        					$middle="<option value=\"a\">A</option>
        							<option value=\"b\">B</option>
        							<option value=\"c\">C</option>
        							<option value=\"d\" selected>D</option>";

						$bottom="</select>
                                                </div>
                                                <input type=\"hidden\" name=\"hidden_name\" value=\"$uid\">
                                            </div>
                                            <div class=\"panel-footer\">
                                                <center>
                                                    <input type=\"submit\" value=\"Update\" name=\"update\" class=\"btn btn-primary\">
                                                </center>
                                            </div>
                                        </form>
                                    </div>
                                </div>";
                        $display=$top.$middle.$bottom;
                        echo $display;
					}

				?>
			</div>
		</div>
	</body>
</html>