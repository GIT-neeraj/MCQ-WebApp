<?php
	if(isset($_POST['emailcheck']))
	{
		include_once('db_connect.php');
		$email=$_POST['emailcheck'];
		$sql="SELECT * FROM participation WHERE email='$email' LIMIT 1";
		$query=mysqli_query($db_conn,$sql);
		$echeck=mysqli_num_rows($query);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			echo "invalid";
			exit();
		}
		if($echeck==1)
		{
			echo "taken";
			exit();
		}
		else
		{
			echo "ok";
			exit();
		}
	}
?>