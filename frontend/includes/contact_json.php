<?php

$servername = "localhost";
$database = "libraryDB";
$username = "root";
$password = "";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$database",$username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo "Conncetion successfully!";
}
catch(PDOException $e)
{
    echo "Connection failed" . $e->getMessage();
}

    //1-add_contact
    if($_GET["data"] == "add_contact"){
        $fullName = $_POST["txtFullName"];
        $email = $_POST["txtEmail"];
        $description = $_POST["txtDescription"];

        $sql = "INSERT INTO Contact (fullName,email,description) VALUES (:fullName,:email,:description);";
        $insert = $conn->prepare($sql);
        $insert->bindParam(':fullName', $fullName);
        $insert->bindParam(':email', $email);
        $insert->bindParam(':description', $description);

        if($insert->execute()){
            echo json_encode("Insert Success");}
        else{ 
            echo json_encode("Insert Faild");}    
    }

?>