<?php
	if(isset($_POST['uname']) && isset($_POST['uid']) && isset($_POST['o']))
	{
		include_once('db_connect.php');

		$uname=$_POST['uname'];
		$uid_="_".$_POST['uid'];
		$o=$_POST['o'];

		$query="UPDATE questions_ans SET ".$uid_."='$o' WHERE uname='$uname' ";
		if($db_conn->query($query)==TRUE)
			echo "done";
		else
			echo "nooo";
	}
?>