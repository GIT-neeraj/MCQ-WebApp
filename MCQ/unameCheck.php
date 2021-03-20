<?php
	if(isset($_POST['unamecheck']))
	{
		include_once('db_connect.php');
		$uname=$_POST['unamecheck'];
		$sql="SELECT * from participation WHERE uname='$uname' LIMIT 1";
		$query=mysqli_query($db_conn,$sql);
		$ucheck=mysqli_num_rows($query);
		if(strlen($uname)<3 || strlen($uname)>16)
		{
			echo "length of username should be between 3 to 16";
			exit();
		}
		if(preg_match('#[^A-Za-z0-9]#',$uname))
		{
			echo "not alphanumeric";
			exit();
		}
		if($ucheck==1)
		{
			echo "username taken";
			exit();
		}
		else
		{
			echo "ok";
			exit();
		}
	}
?>