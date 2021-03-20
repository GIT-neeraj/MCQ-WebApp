<?php
	session_start();
	if(isset($_SESSION['uname']))
	{
		$uname=$_SESSION['uname'];

	}
	else {
		header("location:index.php?msg=TRY LOGIN/REGISTRATION FIRST");
	}

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
				header("loaction:home.php?YOU HAVE NOT TAKEN THIS TEST");
			}
			else
			{
				$sql_query="SELECT attempted FROM $test_ans WHERE uname='$uname' LIMIT 1";
				$result=mysqli_query($db_conn,$sql_query);
				$row=mysqli_fetch_assoc($result);
				$attempted=$row['attempted'];
				if($attempted=="no")
				header("location:home.php?msg=YOU HAVE NOT ATTEMPTED THIS TEST");
			}
		}
		
	}
	else
	{
		header("location:home.php?msg=Select Test");
	}

	require('mc_table.php');
	$pdf=new PDF_MC_Table();
	$pdf->AddPage('P');
	$pdf->Image('sca_logo.png',10,6,30);
	$pdf->SetFont('Times','BU',24);
	$pdf->Cell(200,20,'ONLINE   TEST   SYSTEM',0,1,'C',0);
	$pdf->SetFont('Times','U',18);
	$pdf->Ln(5);
	$result_test="RESULT: ".$test;
	$pdf->Cell(200,5,$result_test,0,1,'C',0);
	$pdf->Ln(5);
	$pdf->SetFont('Times','U',12);
	$pdf->Ln(5);
	$username="USERNAME: ".$uname;
	$pdf->Cell(100,12,$username,0,0,'C',0);
	$pdf->Line(5,65,205,65);
	$pdf->Ln(20);
	$pdf->SetFillColor(128,128,128);
	$pdf->SetFont('Times','B',10);
	$pdf->SetX(5);
	$pdf->Cell(50,6,'Question no.',1,0,'C',1);
	$pdf->SetX(55);
	$pdf->Cell(50,6,'Correct Option',1,0,'C',1);
	$pdf->SetX(105);
	$pdf->Cell(50,6,'Your Option',1,0,'C',1);
	$pdf->SetX(155);
	$pdf->Cell(50,6,'Right / Wrong',1,0,'C',1);
	$pdf->SetX(55);
	$pdf->Ln();
	$pdf->SetX(10);
	$pdf->SetFont('Times','','8');
	$pdf->SetWidths(array(50,50,50,50));
	$i=1;
	$r=0;
	$w=0;
	$test_ans=$test."_ans";
	$sql_query="SELECT * FROM ".$test_ans." WHERE uname='$uname' LIMIT 1 ";
	$result = mysqli_query($db_conn,$sql_query);
	$row_2 = mysqli_fetch_assoc($result);
	$sql_query="SELECT correct_option FROM ".$test;
	$result = mysqli_query($db_conn,$sql_query);
	while($row = mysqli_fetch_assoc($result))
	{
		$ans="_".$i;
		$pdf->SetX(5);
		if($row_2[$ans]==$row['correct_option'])
		{
			$pdf->Row_green(array($i,$row['correct_option'],$row_2[$ans],"Right"));
			$r++;
		}
		else
		{
			$pdf->Row_red(array($i,$row['correct_option'],$row_2[$ans],"Wrong"));
			$w++;
		}
    	$i++;
	}
	$pdf->SetXY(150,45);
	$right="RIGHT: ".$r;
	$wrong="WRONG: ".$w;
	$pdf->SetFont('Times','B',12);
	$pdf->SetFillColor(128,255,128);
	$pdf->Cell(50,6,$right,0,0,'C',1);
	$pdf->SetXY(150,51);
	$pdf->SetFillColor(255,128,128);
	$pdf->Cell(50,6,$wrong,0,0,'C',1);
	$pdf->Output("",$uname);
?>