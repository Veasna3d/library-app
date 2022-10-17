<?php

$servername='localhost';
$username='root';
$password='';
$dbname = "library_db";
$conn=mysqli_connect($servername,$username,$password,"$dbname");

// Load the database configuration file
// include('./config/db.php');
 
if(!empty($_FILES["file"]["name"]))
{
 
    // Allowed mime types
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
 
    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
 
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
 
            // Skip the first line
            fgetcsv($csvFile);
 
            // Parse data from CSV file line by line
            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
            {
                // Get row data
                $stuid = $getData[0];
                $stuname = $getData[1];
                $clid = $getData[2];
                $phone = $getData[3];
                $email = $getData[4];
 
                // If user already exists in the database with the same email
                $query = "SELECT id FROM tbl_student WHERE studentId = '" . $getData[0] . "'";
 
                $check = mysqli_query($conn, $query);
 
                if ($check->num_rows > 0)
                {
                    mysqli_query($conn, "UPDATE tbl_student SET studentName = '" . $stuname . "', class_id = '" . $clid . "', phone = '" . $phone . "', email = '" . $email . "', create_date = NOW() WHERE studentId = '" . $stuid . "'");
                }
                else
                {
                     mysqli_query($conn, "INSERT INTO tbl_student (studentId,studentName,class_id, phone,email, create_date) VALUES ('" . $stuid . "', '" . $stuname . "', '" . $clid. "','" . $phone. "', '" . $email. "', NOW() )");
 
                }
            }
 
            // Close opened CSV file
            fclose($csvFile);
 
            echo "Success";
         
    }
    else
    {
        echo "Error1";
    }
}else{
  echo "Error2";  
}
?>