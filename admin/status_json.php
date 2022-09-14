<?php

    require './config/db.php';
    if($_GET["data"] == "get_status"){
        $sql = "select * from tbl_status";
        $result = $conn->prepare($sql);
		$result->execute();
        $status = [];
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $status[] = array($row['id'], $row['status_name'],$row['create_date']);
        }
        echo json_encode($status);
    }
    //1-add
    if($_GET['data'] == 'add_status'){
            $name = $_POST['txtName'];

            $sql = "Insert into tbl_status (status_name) values (:status_name);";
            $insert = $conn->prepare($sql);
            $insert->bindParam(':status_name', $name);

            if($insert->execute()){
                echo json_encode("Insert Success");
            }else{
                echo json_encode("Insert Faild");
            }
    }

    //2- get_byid
    if($_GET['data'] == 'get_byid'){
        $result = $conn->prepare("select * from tbl_status where id=:id");
        $result->bindParam(':id', $_GET['id']);
        $result->execute();
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            $status[] = array($row['id'], $row['status_name'],$row['create_date']);
        }
        echo json_encode($status);
    }

    //3-Update
    if($_GET['data'] == 'update_status'){

        if(empty($_POST['txtName'])){
            echo json_encode("Please cheack the empty field!");
        }else{

            $id = $_GET['id'];
            $name = $_POST['txtName'];

            $sql = "Update tbl_status set status_name=:status_name where id=:id;";
            $update = $conn->prepare($sql);

            $update->bindParam(':status_name', $name);
            $update->bindParam(':id', $id);
            if($update->execute()){
                echo json_encode("Update Success");
            }else{
                echo json_encode("Update Faild");
            }
        }    
    }

    //4- Delete
    if($_GET['data'] == 'delete_status'){
        $id = $_GET['id'];
        $delete = $conn->prepare("DELETE FROM tbl_status WHERE id=:id;");
        $delete->bindParam(':id', $id);
        if($delete->execute()){
            echo json_encode("Delete Success");
        }else{
            echo json_encode("Delete Faild");
        }
    }
?>