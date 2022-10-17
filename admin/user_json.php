<?php    
	 include("config/db.php");
	//  $db = new Db;
 
	//1get_user 
	if ($_GET["data"] == "get_user") {
		$sql = "SELECT * FROM tbl_user";
		$result = $conn->prepare($sql);
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$user[]  = array($row["id"],$row["username"],$row["password"],$row["email"],$row["user_type"],$row["verify_password"]);
		}
		echo json_encode($user);
	}

	//add_user
	if ($_GET["data"]=="add_user") {
		$username = $_POST['txtname'];

		$password = trim($_POST['txtpass']);
		//abc
		// $password = md5($password);
		//bbc
		// $password = password_hash($password,PASSWORD_DEFAULT);

		$email = $_POST['txtemail'];

		//1- upload picture  
		// $picture = $_FILES['myfile']['name'];
		// move_uploaded_file($_FILES['myfile']['tmp_name'],"image/$picture");
		// $image = $_POST['txtimg'];

		$user_type = $_POST['txtutype'];
		$verify_password = $_POST['txtverify'];

		$sql="insert into tbl_user(username,password,email,user_type,verify_password) values(:username,:password,:email,:user_type,:verify_password);";
		$insert = $conn->prepare($sql);
		$insert->bindParam(':username',$username);
		$insert->bindParam(':password',$password);
		$insert->bindParam(':email',$email);
		$insert->bindParam(':user_type',$user_type);
		$insert->bindParam(':verify_password',$verify_password);
		
		if($insert->execute()){
			echo json_encode("Insert Success!");
		}else{
			echo json_encode("Insert Faild");
		}
	
	}

		// 4 get_byid
	if ($_GET["data"]=="get_byid") {
		$result = $conn->prepare("SELECT * FROM tbl_user WHERE id=:id");
		$result->bindParam(':id',$_GET["id"]);
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$user[]  = array($row["id"],$row["username"],$row["password"],$row["email"],$row["user_type"],$row["verify_password"]);
		}
		echo json_encode($user);
		}

 	//5 update_user
	if ($_GET["data"]=="update_user") {
		$id = $_GET["id"];
		$username = $_POST['txtname'];
		
		$password = trim($_POST['txtpass']);
		//abc
		// $password = md5($password);
		//bbc
		// $password = password_hash($password,PASSWORD_DEFAULT);

		$email = $_POST['txtemail'];
		$user_type = $_POST['txtutype'];
		$verify_password = $_POST['txtverify'];

		$sql="update tbl_user set username=:username, password=:password, email=:email, user_type=:user_type,verify_password=:verify_password where id=:id";
		$update = $conn->prepare($sql);
		$update->bindParam(':username',$username);
		$update->bindParam(':password',$password);
		$update->bindParam(':email',$email);
		$update->bindParam(':user_type',$user_type);
		$update->bindParam(':verify_password',$verify_password);
		$update->bindParam(':id',$id);
		if ($update->execute()) { echo json_encode("");}
		else{ echo json_encode("Update failed");}
		
	}

	if ($_GET["data"]=="delete_user") {
		$id = $_GET["id"];
		$sql = "DELETE FROM tbl_user WHERE id=:id";
		$delete = $conn->prepare($sql);
		$delete->bindParam(':id',$id);
		if ($delete->execute()) { echo json_encode("Delete Success");}
		else{ echo json_encode("Delete failed");}
	}
?>