<?php

$con = mysqli_connect("localhost","root","","libraryDB");

if(!$con){
    die('Connection Failed'. mysqli_connect_error());
}


if(isset($_POST['save_student']))
{
    $studentId = mysqli_real_escape_string($con, $_POST['studentId']);
    $studentName = mysqli_real_escape_string($con, $_POST['studentName']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if ($studentId == NULL || $studentName == NULL || $password == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are required!'
        ];
        echo json_encode($res);
        return;
    } elseif (strlen($password) > 4) {
        $res = [
            'status' => 420,
            'message' => 'Password must be less than 5 characters long'
        ];
        echo json_encode($res);
        return;
    }
    
    $hashed_password = md5($password);
     
    if (strlen($hashed_password) > 32) {
        $res = [
            'status' => 420,
            'message' => 'Password must be less than 5 characters long'
        ];
        echo json_encode($res);
        return;
    }


    $query = "INSERT INTO Student (studentId, studentName, password) VALUES ('$studentId', '$studentName', '$hashed_password')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Your Account Created'
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