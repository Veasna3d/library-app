<?php
error_reporting(0);

require './config/db.php';
if ($_GET["data"] == "get_imp") {
    $sql = "SELECT * FROM vimports";
    $result = $conn->prepare($sql);
    $result->execute();
    $imp = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        $imp[]  = array($row["id"], $row["impDate"], $row["bookTitle"], $row["categoryName"], $row["supName"], $row["authorName"], $row["qty"] . "​ ក្បាល", $row["create_date"]);
    }
    echo json_encode($imp);
}

//get book
if ($_GET['data'] == "get_book") {
    $sql = "SELECT * FROM Book";
    $result = $conn->prepare($sql);
    $result->execute();
    $book = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $book[] = array(
            $row['id'],
            $row['bookTitle'], $row['author'], $row['categoryId'],
            $row['image'], $row['status'], $row['create_date']
        );
    }
    echo json_encode($book);
}

//get category
if ($_GET['data'] == "get_category") {
    $sql = "SELECT * FROM Category";
    $result = $conn->prepare($sql);
    $result->execute();
    $category = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $category[] = array(
            $row['id'],
            $row['categoryName'], $row['create_date']
        );
    }
    echo json_encode($category);
}

//get student
if ($_GET['data'] == "get_suppname") {
    $sql = "SELECT * FROM supplier";
    $result = $conn->prepare($sql);
    $result->execute();
    $sup = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $sup[] = array(
            $row['id'], $row['supName'],
            $row['supContact'], $row['supAddress'], $row['image'], $row['create_date']
        );
    }
    echo json_encode($sup);
}


//add student
if ($_GET['data'] == 'add_imp') {

    $impDate = $_POST['txtDate'];
    $book = $_POST['txtBook'];
    $category = $_POST['txtCategory'];
    $supplier = $_POST['txtSuppname'];
    $author = $_POST['txtAuthor'];
    $qty = $_POST['txtQty'];

    $sql = "INSERT INTO import (impDate, supId, categoryId, bookId, authorName, qty)
         values (:impDate, :supId, :categoryId, :bookId, :authorName, :qty);";
    $insert = $conn->prepare($sql);
    $insert->bindParam(':impDate', $impDate);
    $insert->bindParam(':supId', $supplier);
    $insert->bindParam(':categoryId', $category);
    $insert->bindParam(':bookId', $book);
    $insert->bindParam(':authorName', $author);
    $insert->bindParam(':qty', $qty);
    
    if ($insert->execute()) {
        echo json_encode("Insert Success");
    } else {
        echo json_encode("Insert Faild");
    }
}


//get_byid
if ($_GET['data'] == 'get_byid') {
    $result = $conn->prepare("SELECT * FROM import WHERE id=:id");
    $result->bindParam(':id', $_GET['id']);
    $result->execute();

    if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $imp[]  = array($row["id"], $row["impDate"], $row["bookId"],$row["categoryId"], $row["supId"], $row["authorName"], $row["qty"]);
    }
    echo json_encode($imp);
}

//update
if ($_GET['data'] == 'update_imp') {
    $id = $_GET['id'];
    $impDate = $_POST['txtDate'];
    $book = $_POST['txtTitle'];
    $category = $_POST['txtCategory'];
    $supName = $_POST['txtSuppname'];
    $author = $_POST['txtAuthor'];
    $qty = $_POST['txtQty'];

    $sql = "UPDATE import set impDate=:impDate, bookId=:bookId, categoryId=:categoryId,
                    supId=:supId, authorName=:authorName, qty=:qty where id=:id;";
    $update = $conn->prepare($sql);
    $update->bindParam(':impDate', $impDate);
    $update->bindParam(':bookId', $book);
    $update->bindParam(':categoryId', $category);
    $update->bindParam(':supId', $supName);
    $update->bindParam(':authorName', $author);
    $update->bindParam(':qty', $qty);
    $update->bindParam(':id', $id);

    if ($update->execute()) {
        echo json_encode("Update Success");
    } else {
        echo json_encode("Update Faild");
    }
}

//delete
if ($_GET['data'] == 'delete_imp') {
    $borrow_id = $_GET['id'];
    $delete = $conn->prepare("DELETE FROM import where id=:id;");
    $delete->bindParam(':id', $borrow_id);
    if ($delete->execute()) {
        echo json_encode("Delete Success");
    } else {
        echo json_encode("Delete Faild");
    }
}