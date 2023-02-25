<?php    
   include("config/db.php");
  //  $db = new Db;
 
  //1get_user 
  if ($_GET["data"] == "get_brand") {
    $sql = "SELECT * FROM brand";
    $result = $conn->prepare($sql);
    $result->execute();
    $brand = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $brand[]  = array($row["id"],$row["name"],$row["facebook"],$row["instagram"],$row["twitter"],$row["youtube"],$row["description"],$row["phone"],$row["email"],$row["create_date"]);
    }
    echo json_encode($brand);
  }

  //add_user
  if ($_GET["data"]=="add_brand") {
    $name = $_POST['txtname'];
    $address = $_POST['txtadd'];
    $fac = $_POST['txtfac'];
    $twi= $_POST['txttwi'];
    $ig = $_POST['txtig'];
    $you = $_POST['txtyou'];
    $des = $_POST['txtdes'];
    $phone = $_POST['txtphone'];
    $email = $_POST['txtemail'];

    $sql="insert into brand(name,address,facebook,instagram,twitter,youtube,description,phone,email) values(:name,:address,:facebook,:instagram,:twitter,:youtube,:description,:phone,:email);";
    $insert = $conn->prepare($sql);
    $insert->bindParam(':name',$name);
    $insert->bindParam(':address',$address);
    $insert->bindParam(':facebook',$fac);
    $insert->bindParam(':instagram',$ig);
    $insert->bindParam(':twitter',$twi);
    $insert->bindParam(':youtube',$you);
    $insert->bindParam(':description',$des);
    $insert->bindParam(':phone',$phone);
    $insert->bindParam(':email',$email);

    if($insert->execute()){
      echo json_encode("Insert Success!");
    }else{
      echo json_encode("Insert Faild");
    }
  
  }

    // 4 get_byid
  if ($_GET["data"]=="get_byid") {
    $result = $conn->prepare("SELECT * FROM brand WHERE id=:id");
    $result->bindParam(':id',$_GET["id"]);
    $result->execute();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $brand[]  = array($row["id"],$row["name"],$row["address"],$row["facebook"],$row["instagram"],$row["twitter"],$row["youtube"],$row["description"],$row["phone"],$row["email"]);
    }
    echo json_encode($brand);
  }
   //5 update_user
  if ($_GET["data"]=="update_brand") {
    $id = $_GET["id"];
    $name = $_POST['txtname'];
    $address = $_POST['txtadd'];
    $fac = $_POST['txtfac'];
    $twi= $_POST['txttwi'];
    $ig = $_POST['txtig'];
    $you = $_POST['txtyou'];
    $des = $_POST['txtdes'];
    $phone = $_POST['txtphone'];
    $email = $_POST['txtemail'];

    $sql="update brand set name=:name, address=:address, facebook=:facebook,instagram=:instagram,twitter=:twitter,youtube=:youtube,description=:description,phone=:phone,email=:email where id=:id";
    $update = $conn->prepare($sql);
    $update->bindParam(':name',$name);
    $update->bindParam(':address',$address);
    $update->bindParam(':facebook',$fac);
    $update->bindParam(':instagram',$ig);
    $update->bindParam(':twitter',$twi);
    $update->bindParam(':youtube',$twi);
    $update->bindParam(':description',$des);
    $update->bindParam(':phone',$phone);
    $update->bindParam(':email',$email);
    $update->bindParam(':id',$id);
    if ($update->execute()) { echo json_encode("");}
    else{ echo json_encode("Update failed");}
    
  }

  if ($_GET["data"]=="delete_brand") {
    $id = $_GET["id"];
    $sql = "DELETE FROM brand WHERE id=:id";
    $delete = $conn->prepare($sql);
    $delete->bindParam(':id',$id);
    if ($delete->execute()) { echo json_encode("Delete Success");}
    else{ echo json_encode("Delete failed");}
  }
?>