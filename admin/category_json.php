<?php

    require './config/db.php';
    if($_GET["data"] == "get_category"){
        $sql = "SELECT * FROM tbl_category";
        $result = $conn->prepare($sql);
		$result->execute();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $category[] = array($row['Id'], $row['Name']);
        }
        echo json_encode($category);
    }
    //add
    if($_GET['data'] == 'add_category'){
            $name = $_POST['txtName'];

            $sql = "Insert into tbl_category (Name) values (:Name);";
            $insert = $conn->prepare($sql);
            $insert->bindParam(':Name', $name);

            if($insert->execute()){
                echo json_encode("Insert Success");
            }else{
                echo json_encode("Insert Faild");
            }
    }

    //get_byID
    if($_GET['data'] == 'get_byid'){
        $result = $conn->prepare("SELECT * FROM tbl_category where Id=:Id");
        $result->bindParam(':Id', $_GET['Id']);
        $result->execute();
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            $category[] = array($row['Id'], $row['Name']);
        }
        echo json_encode($category);
    }

    //update
    if($_GET['data'] == 'update_category'){

            $id = $_GET['Id'];
            $name = $_POST['txtName'];

            $sql = "Update tbl_category set Name=:Name where Id=:Id;";
            $update = $conn->prepare($sql);

            $update->bindParam(':Name', $name);
            $update->bindParam(':Id', $id);
            if($update->execute()){
                echo json_encode("Update Success");
            }else{
                echo json_encode("Update Faild");
            }
    }

    //delete
    if($_GET['data'] == 'delete_category'){
        $id = $_GET['id'];
        $delete = $conn->prepare("DELETE FROM tbl_category WHERE Id=:Id;");
        $delete->bindParam(':Id', $id);
        if($delete->execute()){
            echo json_encode("Delete Success");
        }else{
            echo json_encode("Delete Faild");
        }
    }
?>