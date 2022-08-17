<?php
     require './config/db.php';
    if($_GET["data"] == "get_book"){
        $sql = "SELECT * FROM tbl_book";
        $result = $conn->prepare($sql);
        $result->execute();
        $book = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $book[] = array($row['Id'], $row['Title'], 
            $row['Category_Id'],  $row['Author'],$row['Publisher'], 
            $row['Publisher_date'], $row['User_Id'], $row['Status']);
        }
        echo json_encode($book);
    }

    //get category
    if($_GET['data'] == "get_category"){
        $sql = "SELECT * FROM tbl_category";
        $result = $conn->prepare($sql);
        $result->execute();

        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
            $category[] = array($row['Id'], $row['Name']);
        }
        echo json_encode($category);
    }


    //get bycatid
    if($_GET['data'] == "get_catid"){
        $catid = $_GET['Id'];
        $result = $conn->prepare("Select * from tbl_category where Id=:Id");
        $result->bindParam(':Id', $catid);
        $result->execute();

        if($row=$result->fetch(PDO::FETCH_ASSOC)){
            $category[] = array($row['Id'], $row['Name']);
        }
        echo json_encode($category);
    }

    //add book
    if($_GET['data'] == 'add_book'){

            $title = $_POST['txtTitle'];
            $catid = $_POST['txtCategoryId'];
            $author = $_POST['txtAuthor'];
            $publisher = $_POST['txtPublisher'];
            $publisher_date = $_POST['txtPublisherDate'];
            $user_id = $_POST['txtUserId'];
            $status = $_POST['txtStatus'];

            $sql = "Insert into tbl_book (Title, Category_Id, Author, Publisher, Publisher_date, User_Id, Status) values (:Title, 
                    :Category_Id, :Author, :Publisher, :Publisher_date, :User_Id, :Status);";
            $insert = $conn->prepare($sql);
            $insert->bindParam(':Title', $title);
            $insert->bindParam(':Category_Id', $catid);
            $insert->bindParam(':Author', $author);
            $insert->bindParam(':Publisher', $publisher);
            $insert->bindParam(':Publisher_date', $publisher_date);
            $insert->bindParam(':User_Id', $user_id);
            $insert->bindParam(':Status', $status);

            if($insert->execute()){
                echo json_encode("Insert Success");
            }else{
                echo json_encode("Insert Faild");
            }
        }

    //get_byid
    if($_GET['data'] == 'get_byid'){
        $result = $conn->prepare("SELECT * FROM tbl_book WHERE Id=:Id");
        $result->bindParam(':Id', $_GET['Id']);
        $result->execute();
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            $book[] = array($row['Id'], $row['Title'], 
            $row['Category_Id'],  $row['Author'],$row['Publisher'], 
            $row['Publiser_Date'], $row['User_Id'], $row['Status']);
        }
        echo json_encode($book);
    }

    //update
    if($_GET['data'] == 'update_book'){

            $id = $_GET['Id'];
            $title = $_POST['txtTitle'];
            $catid = $_POST['txtCategoryId'];
            $author = $_POST['txtAuthor'];
            $publisher = $_POST['txtPublisher'];
            $publisher_date = $_POST['txtPhubliserDate'];
            $user_id = $_POST['txtUserId'];
            $status = $_POST['txtStatus'];

            $sql = "UPDATE tbl_book set Title=:Title, Category_Id=:Category_Id, Author=:Author, Publisher=:Publisher, 
                    Publisher=:Publisher, Publisher_Date=:Publisher_Date, User_Id=:User_Id, Status=:Status where Id=:Id;";
            $update = $conn->prepare($sql);

            $update->bindParam(':Title', $title);
            $update->bindParam(':Category_Id', $catid);
            $update->bindParam(':Author', $author);
            $update->bindParam(':Publisher', $publisher);
            $update->bindParam(':Publiser_Date', $publisher_date);
            $update->bindParam(':User_Id', $user_id);
            $update->bindParam(':Status', $status);
            $update->bindParam(':Id', $id);

            if($update->execute()){
                echo json_encode("Update Success");
            }else{
                echo json_encode("Update Faild");
            }
        }
        


    //delete
    if($_GET['data'] == 'delete_book'){
        $bookId = $_GET['Id'];
        $delete = $conn->prepare("DELETE FROM tbl_book where Id=:Id;");
        $delete->bindParam(':Id', $bookId);
        if($delete->execute()){
            echo json_encode("Delete Success");
        }else{
            echo json_encode("Delete Faild");
        }
    }
?>