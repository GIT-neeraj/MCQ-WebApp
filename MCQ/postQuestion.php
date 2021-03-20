<?php
	session_start();
	if(isset($_POST['uid']) && isset($_POST['test']) && isset($_SESSION['uname']))
	{
		include_once('db_connect.php');

		$uid=$_POST['uid'];
		$max=$_POST['max'];
		$test=$_POST['test'];
		$test_ans=$test."_ans";

		$uname=$_SESSION['uname'];
		$uid_n=$uid+1;
		$uid_p=$uid-1;

		$query="SELECT * FROM $test WHERE uid='$uid' LIMIT 1";
		$result=mysqli_query($db_conn,$query);
		$row=mysqli_fetch_assoc($result);
		$question=$row['question'];
		$a=$row['a'];
		$b=$row['b'];
		$c=$row['c'];
		$d=$row['d'];

		$query="SELECT * FROM $test_ans WHERE uname='$uname' ";
		$result=mysqli_query($db_conn,$query);
		$row=mysqli_fetch_assoc($result);
		$uid_="_".$uid;
		$ans=$row[$uid_];

		if($ans=="a")
		{
			$response="<br><br><br>
			<div class=\"container\" style=\"background-color:#E0E0E0;\">
				<p>".$question."</p>
			</div>
			<br><br><br>
			<div>
				<label class=\"container\">".$a."
  					<input type=\"radio\" name=\"radio\" checked=\"checked\" onclick=\"store_option('$uname','$uid','a');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$b."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','b');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$c."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','c');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$d."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','d');\">
  					<span class=\"checkmark\"></span>
				</label>
			</div>
			<br><br><br>
			<div class=\"row\">
				<div class=\"col-md-6\">
					<button class=\"btn\" style=\"float:right;\" onclick=\"display_question('$test',$uid_p','$max');\">Previous</button>
				</div>
				<div class=\"col-md-6\">
					<button class=\"btn\" style=\"float:left;\" onclick=\"display_question('$test','$uid_n','$max');\" >Next</button>
				</div>
			</div>";
		}
		else if($ans=="b")
		{
			$response="<br><br><br>
			<div class=\"container\" style=\"background-color:#E0E0E0;\">
				<p>".$question."</p>
			</div>
			<br><br><br>
			<div>
				<label class=\"container\">".$a."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','a');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$b."
  					<input type=\"radio\" name=\"radio\" checked=\"checked\" onclick=\"store_option('$uname','$uid','b');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$c."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','c');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$d."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','d');\">
  					<span class=\"checkmark\"></span>
				</label>
			</div>
			<br><br><br>
			<div class=\"row\">
				<div class=\"col-md-6\">
					<button class=\"btn\" style=\"float:right;\" onclick=\"display_question('$test','$uid_p','$max');\">Previous</button>
				</div>
				<div class=\"col-md-6\">
					<button class=\"btn\" style=\"float:left;\" onclick=\"display_question('$test','$uid_n','$max');\" >Next</button>
				</div>
			</div>";
		}
		else if($ans=="c")
		{
			$response="<br><br><br>
			<div class=\"container\" style=\"background-color:#E0E0E0;\">
				<p>".$question."</p>
			</div>
			<br><br><br>
			<div>
				<label class=\"container\">".$a."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','a');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$b."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','b');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$c."
  					<input type=\"radio\" name=\"radio\" checked=\"checked\" onclick=\"store_option('$uname','$uid','c');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$d."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','d');\">
  					<span class=\"checkmark\"></span>
				</label>
			</div>
			<br><br><br>
			<div class=\"row\">
				<div class=\"col-md-6\">
					<button class=\"btn\" style=\"float:right;\" onclick=\"display_question('$test','$uid_p','$max');\">Previous</button>
				</div>
				<div class=\"col-md-6\">
					<button class=\"btn\" style=\"float:left;\" onclick=\"display_question('$test','$uid_n','$max');\" >Next</button>
				</div>
			</div>";
		}
		else if($ans=="d")
		{
			$response="<br><br><br>
			<div class=\"container\" style=\"background-color:#E0E0E0;\">
				<p>".$question."</p>
			</div>
			<br><br><br>
			<div>
				<label class=\"container\">".$a."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','a');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$b."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','b');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$c."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','c');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$d."
  					<input type=\"radio\" name=\"radio\" checked=\"checked\" onclick=\"store_option('$uname','$uid','d');\">
  					<span class=\"checkmark\"></span>
				</label>
			</div>
			<br><br><br>
			<div class=\"row\">
				<div class=\"col-md-6\">
					<button class=\"btn\" style=\"float:right;\" onclick=\"display_question('$test','$uid_p','$max');\">Previous</button>
				</div>
				<div class=\"col-md-6\">
					<button class=\"btn\" style=\"float:left;\" onclick=\"display_question('$test','$uid_n','$max');\" >Next</button>
				</div>
			</div>";
		}
		else
		{
			$response="<br><br><br>
			<div class=\"container\" style=\"background-color:#E0E0E0;\">
				<p>".$question."</p>
			</div>
			<br><br><br>
			<div>
				<label class=\"container\">".$a."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','a');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$b."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','b');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$c."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','c');\">
  					<span class=\"checkmark\"></span>
				</label>
				<label class=\"container\">".$d."
  					<input type=\"radio\" name=\"radio\" onclick=\"store_option('$uname','$uid','d');\">
  					<span class=\"checkmark\"></span>
				</label>
			</div>
			<br><br><br>
			<div class=\"row\">
				<div class=\"col-md-6\">
					<button class=\"btn\" style=\"float:right;\" onclick=\"display_question('$test','$uid_p','$max');\">Previous</button>
				</div>
				<div class=\"col-md-6\">
					<button class=\"btn\" style=\"float:left;\" onclick=\"display_question('$test','$uid_n','$max');\" >Next</button>
				</div>
			</div>";
		}
		echo $response;
	}
?>
