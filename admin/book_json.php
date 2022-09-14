<?php
     require './config/db.php';
    if($_GET["data"] == "get_book"){
        $sql = "SELECT * FROM tbl_book";
        $result = $conn->prepare($sql);
        $result->execute();
        $book = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $book[] = array($row['id'], $row['book_title'], 
            $row['categoryId'],  $row['authorId'], $row['status'], $row['create_date']);
        }
        echo json_encode($book);
    }

    //get category
    if($_GET['data'] == "get_category"){
        $sql = "SELECT * FROM tbl_category";
        $result = $conn->prepare($sql);
        $result->execute();

        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
            $category[] = array($row['id'], $row['category_name'],['create_date']);
        }
        echo json_encode($category);
    }

    // get author
    if($_GET['data'] == "get_author"){
        $sql = "SELECT * FROM tbl_author";
        $result = $conn->prepare($sql);
        $result->execute();

        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
            $author[] = array($row['id'], $row['author_name'],['create_date']);
        }
        echo json_encode($author);
    }
    // get status
    if($_GET['data'] == "get_status"){
        $sql = "SELECT * FROM tbl_status";
        $result = $conn->prepare($sql);
        $result->execute();

        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
            $status[] = array($row['id'], $row['status_name'],['create_date']);
        }
        echo json_encode($status);
    }

    //get bycatid
    if($_GET['data'] == "get_catid"){
        $catid = $_GET['id'];
        $result = $conn->prepare("Select * from tbl_category where id=:id");
        $result->bindParam(':id', $catid);
        $result->execute();

        if($row=$result->fetch(PDO::FETCH_ASSOC)){
            $category[] = array($row['id'], $row['category_name'],['create_date']);
        }
        echo json_encode($category);
    }

    //add book
    if($_GET['data'] == 'add_book'){

            $book_title = $_POST['txtTitle'];
            $catid = $_POST['txtCategoryId'];
            $author = $_POST['txtAuthor'];
            $status = $_POST['txtStatus'];
            

            $sql = "Insert into tbl_book (book_title, categoryId, authorId, status) values (:book_title, :categoryId, :authorId, :status);";
            $insert = $conn->prepare($sql);
            $insert->bindParam(':book_title', $book_title);
            $insert->bindParam(':categoryId', $catid);
            $insert->bindParam(':authorId', $author);
            $insert->bindParam(':status', $status);

            if($insert->execute()){
                echo json_encode("Insert Success");
            }else{
                echo json_encode("Insert Faild");
            }
        }

    //get_byid
    if($_GET['data'] == 'get_byid'){
        $result = $conn->prepare("SELECT * FROM tbl_book WHERE id=:id");
        $result->bindParam(':id', $_GET['id']);
        $result->execute();
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            $book[] = array($row['id'], $row['book_title'], 
            $row['categoryId'],  $row['authorId'], $row['status'],$row['create_date']);
        }
        echo json_encode($book);
    }

    //update
    if($_GET['data'] == 'update_book'){

        if(empty($_POST['txtTitle']) || empty($_POST['txtCategoryId']) || empty($_POST['txtAuthor'])|| 
            empty($_POST['txtStatus'])){

            echo json_encode("Please check the empty field!");
        }else{
            $id = $_GET['id'];
            $name = $_POST['txtName'];
            $book_title = $_POST['txtTitle'];
            $catid = $_POST['txtCategoryId'];
            $author = $_POST['txtAuthor'];
            $status = $_POST['txtStatus'];

            $sql = "UPDATE tbl_book set book_title=:book_title, categoryId=:categoryId, authorId=:authorId, 
                    status=:status, where id=:id;";
            $update = $conn->prepare($sql);

            $update->bindParam(':book_title', $book_title);
            $update->bindParam(':categoryId', $catid);
            $update->bindParam(':authorId', $author);
            $update->bindParam(':status', $status);
            $update->bindParam(':id', $id);

            if($update->execute()){
                echo json_encode("Update Success");
            }else{
                echo json_encode("Update Faild");
            }
        }
        
    } 

    //delete
    if($_GET['data'] == 'delete_book'){
        $bookId = $_GET['id'];
        $delete = $conn->prepare("DELETE FROM tbl_book where id=:id;");
        $delete->bindParam(':id', $bookId);
        if($delete->execute()){
            echo json_encode("Delete Success");
        }else{
            echo json_encode("Delete Faild");
        }
    }
?>