<?php
	if(isset($_POST['uid']))
	{
		include_once('db_connect.php');

		$uid=$_POST['uid'];
		$sql_query="SELECT active_flag FROM tests where uid='$uid' LIMIT 1";
		$result=mysqli_query($db_conn,$sql_query);
		$row=mysqli_fetch_assoc($result);
		$active_flag=$row['active_flag'];
		if($active_flag=="active")
		{
			$sql_query="UPDATE tests SET active_flag='inactive' where uid='$uid' ";
		}
		else
		{
			$sql_query="UPDATE tests SET active_flag='active' WHERE uid='$uid' ";
		}
		if(mysqli_query($db_conn,$sql_query))
			echo "done";
	}
?>