<?php    
	require ('./config/db.php');
	//1get_user 
	if ($_GET["data"] == "get_user") {
		$sql = "SELECT * FROM tbl_user";
		$result = $conn->prepare($sql);
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$user[]  = array($row["Id"],$row["Username"],$row["Password"],$row["Email"],$row["Image"],$row["User_type"],$row["User_ip"],$row["Verify_password"]);
		}
		echo json_encode($user);
	}

	//add_user
	if ($_GET["data"]=="add_user") {
		$Username = $_POST['txtname'];
		$Password = $_POST['txtpass'];
		$Email = $_POST['txtemail'];
		$Image = $_POST['txtimg'];
		$User_type = $_POST['txtutype'];
		$User_ip = $_POST['txtuip'];
		$Verify_password = $_POST['txtverify'];

		$sql="insert into tbl_user(Username,Password,Email,Image,User_type,User_ip,Verify_password) values(:Username,:Password,:Email,:Image,:User_type,:User_ip,:Verify_password);";
		$insert = $conn->prepare($sql);
		$insert->bindParam(':Username',$Username);
		$insert->bindParam(':Password',$Password);
		$insert->bindParam(':Email',$Email);
		$insert->bindParam(':Image',$Image);
		$insert->bindParam(':User_type',$User_type);
		$insert->bindParam(':User_ip',$User_ip);
		$insert->bindParam(':Verify_password',$Verify_password);
		if ($insert->execute()) { echo json_encode("Insert Success");}
		else{ echo json_encode("insert failed");}
	}

		// 4 get_byid
	if ($_GET["data"]=="get_byid") {
		$result = $conn->prepare("SELECT * FROM tbl_user WHERE Id=:Id");
		$result->bindParam(':Id',$_GET["Id"]);
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$user[]  = array($row["Id"],$row["Username"],$row["Password"],$row["Email"],$row["Image"],$row["User_type"],$row["User_ip"],$row["Verify_password"]);
		}
		echo json_encode($user);
		}

 	//5 update_user
	if ($_GET["data"]=="update_user") {
		$Id = $_GET["Id"];
		$Username = $_POST['txtname'];
		$Password = $_POST['txtpass'];
		$Email = $_POST['txtemail'];
		$Image = $_POST['txtimg'];
		$User_type = $_POST['txtutype'];
		$User_ip = $_POST['txtuip'];
		$Verify_password = $_POST['txtverify'];

		$sql="update tbl_user set Username=:Username, Password=:Password, Email=:Email, Image=:Image,User_type=:User_type,User_ip=:User_ip,Verify_password=:Verify_password where Id=:Id";
		$update = $conn->prepare($sql);
		$update->bindParam(':Username',$Username);
		$update->bindParam(':Password',$Password);
		$update->bindParam(':Email',$Email);
		$update->bindParam(':Image',$Image);
		$update->bindParam(':User_type',$User_type);
		$update->bindParam(':User_ip',$User_ip);
		$update->bindParam(':Verify_password',$Verify_password);
		$update->bindParam(':Id',$Id);
		if ($update->execute()) { echo json_encode("Update Success");}
		else{ echo json_encode("Update failed");}
	}

	if ($_GET["data"]=="delete_user") {
		$Id = $_GET["Id"];
		$sql = "DELETE FROM tbl_user WHERE Id=:Id";
		$delete = $conn->prepare($sql);
		$delete->bindParam(':Id',$Id);
		if ($delete->execute()) { echo json_encode("Delete Success");}
		else{ echo json_encode("Delete failed");}
	}
?>