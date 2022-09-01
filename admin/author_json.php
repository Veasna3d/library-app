<?php

    require './config/db.php';
    if($_GET["data"] == "get_author"){
        $sql = "select * from tbl_author";
        $result = $conn->prepare($sql);
		$result->execute();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $author[] = array($row['id'], $row['author_name'],$row['create_date']);
        }
        echo json_encode($author);
    }
    //1-add
    if($_GET['data'] == 'add_author'){
            $name = $_POST['txtName'];

            $sql = "Insert into tbl_author (author_name) values (:author_name);";
            $insert = $conn->prepare($sql);
            $insert->bindParam(':author_name', $name);

            if($insert->execute()){
                echo json_encode("Insert Success");
            }else{
                echo json_encode("Insert Faild");
            }
    }

    //2- get_byid
    if($_GET['data'] == 'get_byid'){
        $result = $conn->prepare("select * from tbl_author where id=:id");
        $result->bindParam(':id', $_GET['id']);
        $result->execute();
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            $category[] = array($row['id'], $row['author_name'],$row['create_date']);
        }
        echo json_encode($author);
    }

    //3-Update
    if($_GET['data'] == 'update_author'){

        if(empty($_POST['txtName'])){
            echo json_encode("Please cheack the empty field!");
        }else{

            $id = $_GET['id'];
            $name = $_POST['txtName'];

            $sql = "Update tbl_author set author_name=:author_name where id=:id;";
            $update = $conn->prepare($sql);

            $update->bindParam(':author_name', $name);
            $update->bindParam(':id', $id);
            if($update->execute()){
                echo json_encode("Update Success");
            }else{
                echo json_encode("Update Faild");
            }
        }    
    }

    //4- Delete
    if($_GET['data'] == 'delete_author'){
        $id = $_GET['id'];
        $delete = $conn->prepare("DELETE FROM tbl_author WHERE id=:id;");
        $delete->bindParam(':id', $id);
        if($delete->execute()){
            echo json_encode("Delete Success");
        }else{
            echo json_encode("Delete Faild");
        }
    }
?>