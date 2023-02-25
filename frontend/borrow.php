<?php
session_start();   
error_reporting(1);

$con = mysqli_connect("localhost","root","","libraryDB");

if(!$con){
    die('Connection Failed'. mysqli_connect_error());
}



if(isset($_POST['save_student']))
{
       
    $bookId = mysqli_real_escape_string($con, $_POST['bookId']);
    $studentId = mysqli_real_escape_string($con, $_POST['studentId']);
    $borrowDate = mysqli_real_escape_string($con, $_POST['borrowDate']);
    $returnDate = mysqli_real_escape_string($con, $_POST['returnDate']);
    $remark = mysqli_real_escape_string($con, $_POST['remark']);

    if($borrowDate == NULL || $returnDate == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required !'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO Borrow (bookId,studentId,borrowDate,returnDate,remark) VALUES ('$bookId','$studentId','$borrowDate','$returnDate','$remark')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Action Completed'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


?>