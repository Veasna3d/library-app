<?php

    require './config/db.php';
    if($_GET["data"] == "get_category"){
        $sql = "select * from tbl_category";
        $result = $conn->prepare($sql);
		$result->execute();
        $category = [];
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $category[] = array($row['id'], $row['category_name'],$row['create_date']);
        }
        echo json_encode($category);
    }
    //add
    if($_GET['data'] == 'add_category'){
            $name = $_POST['txtName'];

            $sql = "Insert into tbl_category (category_name) values (:category_name);";
            $insert = $conn->prepare($sql);
            $insert->bindParam(':category_name', $name);

            if($insert->execute()){
                echo json_encode("Insert Success");
            }else{
                echo json_encode("Insert Faild");
            }
    }

    //get_byID
    if($_GET['data'] == 'get_byid'){
        $result = $conn->prepare("select * from tbl_category where id=:id");
        $result->bindParam(':id', $_GET['id']);
        $result->execute();
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            $category[] = array($row['id'], $row['category_name'],$row['create_date']);
        }
        echo json_encode($category);
    }

    //update
    if($_GET['data'] == 'update_category'){

        if(empty($_POST['txtName'])){
            echo json_encode("Please cheack the empty field!");
        }else{

            $id = $_GET['id'];
            $name = $_POST['txtName'];

            $sql = "Update tbl_category set category_name=:category_name where id=:id;";
            $update = $conn->prepare($sql);

            $update->bindParam(':category_name', $name);
            $update->bindParam(':id', $id);
            if($update->execute()){
                echo json_encode("Update Success");
            }else{
                echo json_encode("Update Faild");
            }
        }    
    }

    //delete
    if($_GET['data'] == 'delete_category'){
        $id = $_GET['id'];
        $delete = $conn->prepare("DELETE FROM tbl_category WHERE id=:id;");
        $delete->bindParam(':id', $id);
        if($delete->execute()){
            echo json_encode("Delete Success");
        }else{
            echo json_encode("Delete Faild");
        }
    }
?>