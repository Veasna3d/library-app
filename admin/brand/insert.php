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
                INSERT INTO Brand (brandName, image, address,phone,email,description,facebook,telegram,instagram,twitter,youtube) 
                VALUES (:brandName, :image, :address, :phone, :email, :description, :facebook, :telegram, :instagram, :twitter, :youtube)
            ");
            $result = $statement->execute(
                array(
                    ':brandName'   =>  $_POST["brandName"],
                    ':image'        =>  $image,
                    ':address'    =>  $_POST["address"],
                    ':phone'    =>  $_POST["phone"],
                    ':email'    =>  $_POST["email"],
                    ':description'    =>  $_POST["description"],
                    ':facebook'    =>  $_POST["facebook"],
                    ':telegram'    =>  $_POST["telegram"],
                    ':instagram'    =>  $_POST["instagram"],
                    ':twitter'    =>  $_POST["twitter"],
                    ':youtube'    =>  $_POST["youtube"],
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
                "UPDATE Brand 
                SET brandName = :brandName, image = :image, address = :address, 
                phone = :phone ,email = :email ,description = :description ,facebook = :facebook ,
                telegram = :telegram ,instagram = :instagram ,twitter = :twitter ,youtube = :youtube   
                WHERE id = :id
                "
            );
            $result = $statement->execute(
                array(
                    ':brandName'   =>  $_POST["brandName"],
                    ':image'        =>  $image,
                    ':address'    =>  $_POST["address"],
                    ':phone'    =>  $_POST["phone"],
                    ':email'    =>  $_POST["email"],
                    ':description'    =>  $_POST["description"],
                    ':facebook'    =>  $_POST["facebook"],
                    ':telegram'    =>  $_POST["telegram"],
                    ':instagram'    =>  $_POST["instagram"],
                    ':twitter'    =>  $_POST["twitter"],
                    ':youtube'    =>  $_POST["youtube"],
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