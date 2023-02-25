<?php
      require '../config/db.php';
    include('function.php');
    if(isset($_POST["operation"]))
    {
        if($_POST["operation"] == "Add")
        {
            $image = '';
            if($_FILES["user_image"]["name"] != '')
            {
                $image = upload_image();
            }
            $statement = $conn->prepare("
                INSERT INTO Book (bookTitle, description, author, categoryId, image) 
                VALUES (:bookTitle, :description, :author, :categoryId, :image)
            ");
            $result = $statement->execute(
                array(
                    ':bookTitle'   =>  $_POST["txtBookTitle"],
                    ':description'   =>  $_POST["txtDescription"],
                    ':author'    =>  $_POST["txtAuthor"],
                    ':categoryId'    =>  $_POST["txtCategoryId"],
                    ':image'        =>  $image
                )
            );
            if(!empty($result))
            {
                echo 'Data Inserted';
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
                "UPDATE Book 
                SET bookTitle = :bookTitle, description = :description , author = :author, categoryId = :categoryId, image = :image  
                WHERE id = :id
                "
            );
            $result = $statement->execute(
                array(
                    ':bookTitle'   =>  $_POST["txtBookTitle"],
                    ':description'   =>  $_POST["txtDescription"],
                    ':author'    =>  $_POST["txtAuthor"],
                    ':categoryId'    =>  $_POST["txtCategoryId"],
                    ':image'        =>  $image,
                    ':id'           =>  $_POST["user_id"]
                )
            );
            if(!empty($result))
            {
                echo 'Data Updated';
            }
        }
    }
?>