<?php
     require './config/db.php';
    if($_GET["data"] == "get_book"){
        $sql = "SELECT * FROM vbooks";
        $result = $conn->prepare($sql);
        $result->execute();
        $book = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            if($row['status'] == 0){
                $status = "<span style='color: white;' class='badge bg-purple'>Available</span>";
            }else{
                $status = "<span style='color: white;' class='badge bg-red'>Unavailable</span>";
            }
            $book[] = array($row['id'], $row['book_title'], 
            $row['category_name'],  $row['author_name'],
             $status, $row['create_date']);
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

            $sql = "Insert into tbl_book (book_title, categoryId, authorId) values (:book_title, :categoryId, :authorId);";
            $insert = $conn->prepare($sql);
            $insert->bindParam(':book_title', $book_title);
            $insert->bindParam(':categoryId', $catid);
            $insert->bindParam(':authorId', $author);

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

            $id = $_GET['id'];
            $book_title = $_POST['txtTitle'];
            $catid = $_POST['txtCategoryId'];
            $author = $_POST['txtAuthor'];

            $sql = "UPDATE tbl_book set book_title=:book_title, 
            categoryId=:categoryId, authorId=:authorId where id=:id;";
            $update = $conn->prepare($sql);

            $update->bindParam(':book_title', $book_title);
            $update->bindParam(':categoryId', $catid);
            $update->bindParam(':authorId', $author);
            $update->bindParam(':id', $id);

            if($update->execute()){
                echo json_encode("Update Success");
            }else{
                echo json_encode("Update Faild");
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

     //unavailable 
     if($_GET['data'] == 'get_status'){
        
        $id = $_GET['id'];
        $status = 1;
        $sql = "UPDATE tbl_book set status=:status where id=:id;";
        $update = $conn->prepare($sql);

        $update->bindParam(':status', $status);
        $update->bindParam(':id', $id);

        if($update->execute()){
            echo json_encode("Return Success");
        }else{
            echo json_encode("Return Faild");
        }
    }
    //available
    if($_GET['data'] == 'refuse_status'){
        
        $id = $_GET['id'];
        $status = 0;
        $sql = "UPDATE tbl_book set status=:status where id=:id;";
        $update = $conn->prepare($sql);

        $update->bindParam(':status', $status);
        $update->bindParam(':id', $id);

        if($update->execute()){
            echo json_encode("Return Success");
        }else{
            echo json_encode("Return Faild");
        }
    }
?>