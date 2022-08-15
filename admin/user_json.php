<?php    
	require ('db.php');

	//1get_customer 
	if ($_GET["data"] == "get_user") {
		$sql = "SELECT * FROM tbl_user";
		$result = $conn->prepare($sql);
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$user[]  = array($row["Id"],$row["Username"],$row["Password"],$row["Email"],$row["Image"],$row["User_type"],$row["Verify_password"],$row["Timelogin"]);
		}
		echo json_encode($user);
	}

	//add_user
	if ($_GET["data"]=="add_user") {
		$Username = $_POST['txtname'];
		$Password = $_POST['txtpass'];
		$Email = $_POST['txtemail'];
		$User_type = $_POST['txtutype'];
		$User_ip = '000';
		$Verify_password = '123';

		$sql="insert into tbl_user(Username,Password,Email,User_type,User_ip,Verify_password) values(:Username,:Password,:Email,User_type,:User_ip,Verify_password);";
		$insert = $conn->prepare($sql);
		$insert->bindParam(':Username',$Username);
		$insert->bindParam(':Password',$Password);
		$insert->bindParam(':Email',$Email);
		$insert->bindParam(':User_type',$User_type);
		$insert->bindParam(':User_ip',$User_ip);
		$insert->bindParam(':verify_password',$Verify_password);
		if ($insert->execute()) { echo json_encode("Insert Success");}
		else{ echo json_encode("insert failed");}
	}

		//4 get_byid
	if ($_GET["data"]=="get_byid") {
		$result = $conn->prepare("SELECT * FROM tblcustomer WHERE custid=:custid");
		$result->bindParam(':custid',$_GET["custid"]);
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$customer[] = array($row["custid"],$row["name"],$row["phone"],$row["email"]);
		}
		echo json_encode($customer);
	}

	//5 update_product
	if ($_GET["data"]=="update_customer") {
		$custid = $_GET["custid"];
		$name = $_POST["txtname"];
		$phone = $_POST["txtphone"];
		$email = $_POST["txtemail"];

		$sql="update tblcustomer set name=:name, phone=:phone, email=:email where custid=:custid";
		$update = $conn->prepare($sql);
		$update->bindParam(':name',$name);
		$update->bindParam(':phone',$phone);
		$update->bindParam(':email',$email);
		$update->bindParam(':custid',$custid);
		if ($update->execute()) { echo json_encode("Update Success");}
		else{ echo json_encode("Update failed");}
	}

	if ($_GET["data"]=="delete_customer") {
		$custid = $_GET["custid"];
		$sql = "delete FROM tblcustomer where custid=:custid";
		$delete = $conn->prepare($sql);
		$delete->bindParam(':custid',$custid);
		if ($delete->execute()) { echo json_encode("Delete Success");}
		else{ echo json_encode("Delete failed");}
	}
?>