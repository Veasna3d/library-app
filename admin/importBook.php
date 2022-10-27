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
                $book_title = $getData[0];
                $categoryId = $getData[1];
                $authorId = $getData[2];
                $status = $getData[3];
 
                // If user already exists in the database with the same email
                $query = "SELECT id FROM tbl_book WHERE book_title = '" . $getData[0] . "'";
 
                $check = mysqli_query($conn, $query);
 
                if ($check->num_rows > 0)
                {
                    mysqli_query($conn, "UPDATE tbl_book SET categoryId = '" . $categoryId . "', authorId = '" . $authorId . "', status = '" . $status . "', create_date = NOW() WHERE book_title = '" . $book_title . "'");
                }
                else
                {
                     mysqli_query($conn, "INSERT INTO tbl_book (book_title,categoryId,authorId, status, create_date) VALUES ('" . $book_title . "', '" . $categoryId . "', '" . $authorId. "','" . $status. "', NOW() )");
 
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