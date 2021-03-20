<?php
    include_once('db_connect.php');

    $sql_query="SELECT count(*) AS num FROM information_schema.columns WHERE table_name = 'questions_ans' ";

    $result=mysqli_query($db_conn,$sql_query);
    $row=mysqli_fetch_assoc($result);
    print_r($row);
?>