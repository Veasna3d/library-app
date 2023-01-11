<?php    
   include("config/db.php");
  //  $db = new Db;
 
  //1get_user 
  if ($_GET["data"] == "get_sup") {
    $sql = "SELECT * FROM supplier";
    $result = $conn->prepare($sql);
    $result->execute();
    $sup = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $sup[]  = array($row["id"],$row["supName"],$row["supContact"],$row["supAddress"],$row["create_date"]);
    }
    echo json_encode($sup);
  }

  //add_user
  if ($_GET["data"]=="add_sup") {
    $name = $_POST['txtname'];
    $contact = $_POST['txtcon'];
    $address = $_POST['txtadd'];

    $sql="insert into supplier(supName,supContact,supAddress) values(:supName,:supContact,:supAddress);";
    $insert = $conn->prepare($sql);
    $insert->bindParam(':supName',$name);
    $insert->bindParam(':supContact',$contact);
    $insert->bindParam(':supAddress',$address);
    
    if($insert->execute()){
      echo json_encode("Insert Success!");
    }else{
      echo json_encode("Insert Faild");
    }
  
  }

    // 4 get_byid
  if ($_GET["data"]=="get_byid") {
    $result = $conn->prepare("SELECT * FROM supplier WHERE id=:id");
    $result->bindParam(':id',$_GET["id"]);
    $result->execute();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $sup[]  = array($row["id"],$row["supName"],$row["supContact"],$row["supAddress"]);
    }
    echo json_encode($sup);
  }
   //5 update_user
  if ($_GET["data"]=="update_sup") {
    $id = $_GET["id"];
    $name = $_POST['txtname'];
    $contact = $_POST['txtcon'];
    $address = $_POST['txtadd'];

    $sql="update supplier set supName=:supName, supContact=:supContact, supAddress=:supAddress where id=:id";
    $update = $conn->prepare($sql);
    $update->bindParam(':supName',$name);
    $update->bindParam(':supContact',$contact);
    $update->bindParam(':supAddress',$address);
    $update->bindParam(':id',$id);
    if ($update->execute()) { echo json_encode("");}
    else{ echo json_encode("Update failed");}
    
  }

  if ($_GET["data"]=="delete_sup") {
    $id = $_GET["id"];
    $sql = "DELETE FROM supplier WHERE id=:id";
    $delete = $conn->prepare($sql);
    $delete->bindParam(':id',$id);
    if ($delete->execute()) { echo json_encode("Delete Success");}
    else{ echo json_encode("Delete failed");}
  }
?>