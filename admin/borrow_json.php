<?php
    require 'dbconnection.php';
    if($_GET["data"] == "get_product"){
        $sql = "SELECT * FROM vproduct";
        $result = $conn->prepare($sql);
        $result->execute();
        $product = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $product[] = array($row['pcode'], $row['pname'], 
            $row['cname'],  $row['quantity'],$row['cost'], 
            $row['price'], $row['name'], $row['create_date']);
        }
        echo json_encode($product);
    }

    //get category
    if($_GET['data'] == "get_category"){
        $sql = "SELECT * FROM tbl_category";
        $result = $conn->prepare($sql);
        $result->execute();

        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
            $category[] = array($row['catid'], $row['cname'], $row['create_date']);
        }
        echo json_encode($category);
    }

    //get status
    if($_GET['data'] == "get_status"){
        $sql = "SELECT * FROM tbl_status";
        $result = $conn->prepare($sql);
        $result->execute();

        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
            $status[] = array($row['id'], $row['name'], $row['create_date']);
        }
        echo json_encode($status);
    }

    //get bycatid
    if($_GET['data'] == "get_catid"){
        $catid = $_GET['catid'];
        $result = $conn->prepare("Select * from tbl_category where catid=:catid");
        $result->bindParam(':catid', $catid);
        $result->execute();

        if($row=$result->fetch(PDO::FETCH_ASSOC)){
            $category[] = array($row['catid'], $row['cname'], $row['create_date']);
        }
        echo json_encode($category);
    }

    //add product
    if($_GET['data'] == 'add_product'){

        if(empty($_POST['txtName']) || empty($_POST['txtCategoryId']) || empty($_POST['txtQty']) || 
            empty($_POST['txtCost']) || empty($_POST['txtPrice']) || empty($_POST['txtStatusId'])){

            echo json_encode("Please check the empty field!");
        }else{
            $name = $_POST['txtName'];
            $catid = $_POST['txtCategoryId'];
            $qty = $_POST['txtQty'];
            $cost = $_POST['txtCost'];
            $price = $_POST['txtPrice'];
            $staid = $_POST['txtStatusId'];

            $sql = "Insert into tbl_product (pname, categoryid, quantity, cost, price, statusid) values (:pname, 
                    :categoryid, :quantity, :cost, :price, :statusid);";
            $insert = $conn->prepare($sql);
            $insert->bindParam(':pname', $name);
            $insert->bindParam(':categoryid', $catid);
            $insert->bindParam(':quantity', $qty);
            $insert->bindParam(':cost', $cost);
            $insert->bindParam(':price', $price);
            $insert->bindParam(':statusid', $staid);

            if($insert->execute()){
                echo json_encode("Insert Success");
            }else{
                echo json_encode("Insert Faild");
            }
        }
        
    }

    //get_byid
    if($_GET['data'] == 'get_byid'){
        $result = $conn->prepare("SELECT * FROM tbl_product WHERE pcode=:pcode");
        $result->bindParam(':pcode', $_GET['pcode']);
        $result->execute();
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            $product[] = array($row['pcode'], $row['pname'], $row['categoryid'],$row['quantity'],
             $row['cost'], $row['price'], $row['statusid'], $row['create_date']);
        }
        echo json_encode($product);
    }

    //update
    if($_GET['data'] == 'update_product'){

        if(empty($_POST['txtName']) || empty($_POST['txtCategoryId']) || empty($_POST['txtQty']) || 
            empty($_POST['txtCost']) || empty($_POST['txtPrice']) || empty($_POST['txtStatusId'])){

            echo json_encode("Please check the empty field!");
        }else{
            $id = $_GET['pcode'];
            $name = $_POST['txtName'];
            $catid = $_POST['txtCategoryId'];
            $qty = $_POST['txtQty'];
            $cost = $_POST['txtCost'];
            $price = $_POST['txtPrice'];
            $staid = $_POST['txtStatusId'];

            $sql = "UPDATE tbl_product set pname=:pname, categoryid=:categoryid, quantity=:quantity, cost=:cost, 
                    price=:price, statusid=:statusid where pcode=:pcode;";
            $update = $conn->prepare($sql);

            $update->bindParam(':pname', $name);
            $update->bindParam(':categoryid', $catid);
            $update->bindParam(':quantity', $qty);
            $update->bindParam(':cost', $cost);
            $update->bindParam(':price', $price);
            $update->bindParam(':statusid', $staid);
            $update->bindParam(':pcode', $id);

            if($update->execute()){
                echo json_encode("Update Success");
            }else{
                echo json_encode("Update Faild");
            }
        }
        
    }

    //delete
    if($_GET['data'] == 'delete_product'){
        $productid = $_GET['pcode'];
        $delete = $conn->prepare("DELETE FROM tbl_product where pcode=:pcode;");
        $delete->bindParam(':pcode', $productid);
        if($delete->execute()){
            echo json_encode("Delete Success");
        }else{
            echo json_encode("Delete Faild");
        }
    }
?>