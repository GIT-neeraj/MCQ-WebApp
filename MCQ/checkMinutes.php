<?php
	session_start();
	if(isset($_SESSION['uname']) && isset($_SESSION['test']))
	{
		$test=$_SESSION['test'];
		include_once('db_connect.php');
		$query="SELECT duration_minutes FROM tests WHERE name='$test' LIMIT 1";
		$result=mysqli_query($db_conn,$query);
		if($row=mysqli_fetch_assoc($result))
		{
			$minutes=$row['duration_minutes'];
			echo $minutes;	
		}
	}
?>