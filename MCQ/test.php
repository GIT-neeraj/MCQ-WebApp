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
				else
				{
					$sql_query="UPDATE $test_ans SET attempted='yes' WHERE uname='$uname' ";
					mysqli_query($db_conn,$sql_query);
				}
			}

			$sql_query="SELECT uid FROM $test";
			$result=mysqli_query($db_conn,$sql_query);
			$qcheck=mysqli_num_rows($result);
			if($qcheck==0)
			{
				header("location:home.php?msg=questions are not added for this test");
			}
		}
		$_SESSION['test']=$test;
		
	}
	else
	{
		header("location:home.php?msg=Select Test");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>TEST</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			function display_question(test,uid,max) {
				uid=parseInt(uid);
				max=parseInt(max);
				if(uid<=max && uid>=1)
				{
					var e = document.getElementsByClassName( "btn-block" );
					for ( var i = 0; i < e.length; i++ ) {
						if ( e[ i ].style.backgroundColor == "orange" )
							e[ i ].style.backgroundColor = "blue";
					}
					document.getElementById( uid ).style.backgroundColor = "orange";
					var myElement = document.getElementById(uid);
					var topPos = (myElement.offsetTop)/2;
					document.getElementById('question_buttons').scrollTop = topPos;
					var ajx=new XMLHttpRequest();
					ajx.onreadystatechange=function()
					{
						if ( this.readyState == 4 && this.status == 200 )
						{
							document.getElementById('testarea').innerHTML=this.responseText;
							//alert(this.responseText);
						}
					}
					ajx.open( "POST", "postQuestion.php", true );
					ajx.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
					ajx.send("test=" +test+ "&uid=" + uid + "&max=" +max);
				}
			}
			function store_option(uname,uid,o)
			{
				var ajx=new XMLHttpRequest();
				ajx.open( "POST", "storeOption.php", true );
				ajx.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
				ajx.send( "uname="+uname+"&uid="+uid+"&o="+o);
			}
		</script>
		<script type="text/javascript">
			var ajx=new XMLHttpRequest();
			ajx.onreadystatechange=function()
			{
				if ( this.readyState == 4 && this.status == 200 )
				{
					var distance=parseInt(this.responseText);
					distance = distance*60*1000;
					var x = setInterval(function() {
					var days = Math.floor(distance / (1000 * 60 * 60 * 24));
					var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
					var seconds = Math.floor((distance % (1000 * 60)) / 1000);
					document.getElementById("timer").innerHTML ="<h3>TIME LEFT:</h3>"+ hours + " Hours " + minutes + " Minutes " + seconds + " Seconds ";
					distance=distance-1000;
					if (distance < 0)
					{
					clearInterval(x);
					document.getElementById("timer").innerHTML = "EXPIRED";
					window.location="home.php?msg=TEST OVER";
					}
					}, 1000);
				}
			}
			ajx.open( "POST", "checkMinutes.php", true );
			ajx.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
			ajx.send();
		</script>
		<style>
			/* The container */
			
			.container {
				display: block;
				position: relative;
				padding-left: 35px;
				margin-bottom: 12px;
				cursor: pointer;
				font-size: 22px;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}
			/* Hide the browser's default radio button */
			
			.container input {
				position: absolute;
				opacity: 0;
				cursor: pointer;
			}
			/* Create a custom radio button */
			
			.checkmark {
				position: absolute;
				top: 0;
				left: 0;
				height: 25px;
				width: 25px;
				background-color: #eee;
				border-radius: 50%;
			}
			/* On mouse-over, add a grey background color */
			
			.container:hover input~ .checkmark {
				background-color: #ccc;
			}
			/* When the radio button is checked, add a blue background */
			
			.container input:checked~ .checkmark {
				background-color: #2196F3;
			}
			/* Create the indicator (the dot/circle - hidden when not checked) */
			
			.checkmark:after {
				content: "";
				position: absolute;
				display: none;
			}
			/* Show the indicator (dot/circle) when checked */
			
			.container input:checked~ .checkmark:after {
				display: block;
			}
			/* Style the indicator (dot/circle) */
			
			.container .checkmark:after {
				top: 9px;
				left: 9px;
				width: 8px;
				height: 8px;
				border-radius: 50%;
				background: white;
			}
		</style>
	</head>
	<body style="overflow: hidden;">
		<div class="row">
			<div class="col-md-3" style="overflow:auto; height:650px" id="question_buttons">
				<?php
				include_once( 'db_connect.php' );
				$sql = "select uid from $test";
				$result = mysqli_query( $db_conn, $sql );
				$max = mysqli_num_rows($result);
				while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
					$uid = $row[ 'uid' ];
					$q_no = "QUESTION " . $row[ 'uid' ];
					echo " <input type=\"button\" class=\"btn btn-block\" style=\"background-color:blue; \" value=\"$q_no\" id=\"$uid\" onclick=\"display_question('$test','$uid','$max');\"> ";
				}
				?>
			</div>
			<div class="col-md-9" style="overflow:auto; height:650px;">
				<center><div id="timer">
				</div></center>
				<div id="testarea">
				</div>
				<br><br>
				<center><a class="btn btn-success" href="home.php?msg=TEST COMPLETED/SUBMITTED">OK, I'AM DONE. TAKE ME OUT</a></center>
			</div>
		</div>
	</div>
</body>
</html>