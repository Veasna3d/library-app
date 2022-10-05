<?php
    error_reporting(0);
    require './config/db.php';
    if($_GET["data"] == "get_borrow"){
        $sql = "SELECT * FROM vborrow";
        $result = $conn->prepare($sql);
        $result->execute();
        $borrow = [];
        $status;

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            if($row['status'] == 0){
                $status = "<span style='color: white;' class='badge bg-red'>Not Return</span>";
            }else{
                $status = "<span style='color: white;' class='badge bg-purple'>Returned</span>";
            }

            $date = $row['return_date'];  
            $newDate = date("m-d-Y", strtotime($date));  

            $borrow[] = array($row['id'], $row['book_title'], 
            $row['studentName'],  $row['borrow_date'],$newDate, 
            $status, $row['remark'], $row['create_date']);
        }
        echo json_encode($borrow);
    }

    //get book
    if($_GET['data'] == "get_book"){
        $sql = "SELECT * FROM tbl_book";
        $result = $conn->prepare($sql);
        $result->execute();
        $book = [];

        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
            if($row['status'] == 0){
                $status = $row['status'];
                $book[] = array($row['id'], $row['book_title'],
                    $row['book_title'],$row['categoryId'], $row['authorId'],
                    $status, $row['create_date']);
            }
            
        }
        echo json_encode($book);
    }

    //get student
    if($_GET['data'] == "get_student"){
        $sql = "SELECT * FROM tbl_student";
        $result = $conn->prepare($sql);
        $result->execute();
        $status = [];

        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
            $status[] = array($row['id'], $row['studentId'], 
            $row['studentName'], $row['photo'],
            $row['email'], $row['create_date']);
        }
        echo json_encode($status);
    }
//--------------------------------------------------------------------------//
    //get by_book_id
    if($_GET['data'] == "get_bookid"){
        $bookid = $_GET['id'];
        $result = $conn->prepare("Select * from tbl_book where id=:id");
        $result->bindParam(':id', $bookid);
        $result->execute();

        if($row=$result->fetch(PDO::FETCH_ASSOC)){

            if($row['status'] == 0){
                $status = $row['status'];
                $book[] = array($row['id'], $row['book_title'],
                $row['book_title'],$row['categoryId'], $row['authorId'],
                $row['status'], $row['create_date']);
            }

            
        }
        echo json_encode($book);
    }

//--------------------------------------------------------------------------//
//get date

// date_default_timezone_set("Asia/Phnom_Penh");
// $date =  date("h:i:sa");
// echo "The time is " .$date;
    //add borrow
    if($_GET['data'] == 'add_borrow'){
        
            $bookId = $_POST['txtBookId'];
            $studentId = $_POST['txtStudentId'];
            $borrowDate = $_POST['txtBorrow'];
            $returnDate = $_POST['txtReturn'];
            $remark = $_POST['txtRemark'];

            $sql = "INSERT INTO tbl_borrow (book_id, student_id, borrow_date, return_date, remark)
             values (:book_id, :student_id, :borrow_date, :return_date, :remark);";
            $insert = $conn->prepare($sql);
            $insert->bindParam(':book_id', $bookId);
            $insert->bindParam(':student_id', $studentId);
            $insert->bindParam(':borrow_date', $borrowDate);
            $insert->bindParam(':return_date', $returnDate);
            $insert->bindParam(':remark', $remark);

            if($insert->execute()){
                echo json_encode("Insert Success");
            }else{
                echo json_encode("Insert Faild");
            }
        }

    //get_byid
    if($_GET['data'] == 'get_byid'){
        $result = $conn->prepare("SELECT * FROM tbl_borrow WHERE id=:id");
        $result->bindParam(':id', $_GET['id']);
        $result->execute();

        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            $borrow[] = array($row['id'], $row['book_id'], 
            $row['student_id'],  $row['borrow_date'],$row['return_date'], 
            $row['remark']);
        }
        echo json_encode($borrow);
    }

    //update
    if($_GET['data'] == 'update_borrow'){
        
            $id = $_GET['id'];
            $bookId = $_POST['txtBookId'];
            $studentId = $_POST['txtStudentId'];
            $borrowDate = $_POST['txtBorrow'];
            $returnDate = $_POST['txtReturn'];
            $remark = $_POST['txtRemark'];

            $sql = "UPDATE tbl_borrow set book_title=:book_title, student_id=:student_id, borrow_date=:borrow_date, return_date=:return_date, 
                    remark=:remark where id=:id;";
            $update = $conn->prepare($sql);

            $update->bindParam(':book_id', $bookId);
            $update->bindParam(':student_id', $studentId);
            $update->bindParam(':borrow_date', $borrowDate);
            $update->bindParam(':return_date', $returnDate);
            $update->bindParam(':remark', $remark);
            $update->bindParam(':id', $id);

            if($update->execute()){
                echo json_encode("Update Success");
            }else{
                echo json_encode("Update Faild");
            }
        }

    //delete
    if($_GET['data'] == 'delete_borrow'){
        $borrowid = $_GET['id'];
        $delete = $conn->prepare("DELETE FROM tbl_borrow where id=:id;");
        $delete->bindParam(':id', $borrowid);
        if($delete->execute()){
            echo json_encode("Delete Success");
        }else{
            echo json_encode("Delete Faild");
        }
    }

    //return 
    if($_GET['data'] == 'return_borrow'){
        
        $id = $_GET['id'];
        $status = 1;
        $sql = "UPDATE tbl_borrow set status=:status where id=:id;";
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