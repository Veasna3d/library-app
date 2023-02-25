<?php
      require '../config/db.php';
    include('function.php');
    if(isset($_POST["operation"]))
    {
        if($_POST["operation"] == "Add")
        {
            if(strlen($_POST["password"]) >= 5) {
                // the password meets the minimum length requirement
                $password = md5($_POST["password"]); // using MD5 is not recommended
                $image = '';
                if($_FILES["user_image"]["name"] != '')
                {
                    $image = upload_image();
                }
                $statement = $conn->prepare("
                    INSERT INTO User (username, password, image, role, email) 
                    VALUES (:username, :password, :image, :role, :email)
                ");
                $result = $statement->execute(
                    array(
                        ':username'   =>  $_POST["username"],
                        ':password'    =>  $password,
                        ':image'        =>  $image,
                        ':role' => $_POST["role"],
                        ':email'    =>  $_POST["email"],
                    )
                );
                if(!empty($result))
                {
                    echo 'Data Inserted';
                }
            } else {
                // the password does not meet the minimum length requirement
                echo 'Password must be at least 5 characters long.';
            }
        }
        if($_POST["operation"] == "Edit")
        {
            $image = '';
            if($_FILES["user_image"]["name"] != '')
            {
                $image = upload_image();
            }
            else
            {
                $image = $_POST["hidden_user_image"];
            }
            $statement = $conn->prepare(
                "UPDATE User SET usermane = :usermane, password = :password, image = :image, role = :role, email = :email WHERE id = :id
                "
            );
            $result = $statement->execute(
                array(
                    ':username'   =>  $_POST["username"],
                    ':password'    =>  $_POST["password"],
                    ':image'        =>  $image,
                    ':role' => $_POST["role"],
                    ':email'    =>  $_POST["email"],
                    ':id'       =>  $_POST["user_id"]
                )
            );
            if(!empty($result))
            {
                echo 'Data Updated';
            }
        }
    }
?>
