<?php
     require './config/db.php';

    //get Student List
    if($_GET["data"] == "get_student"){
        $sql = "SELECT * FROM vstudents";
        $result = $conn->prepare($sql);
        $result->execute();
        $student = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            
            $student[] = array($row['id'], $row['studentId'], $row["studentName"], 
            $row['password'],  $row['image'],$row['className'],
            $row["phone"], $row["email"], $row['create_date']);
           
        }
        echo json_encode($student);
    }

	if($_GET['data'] == "get_class"){
        $sql = "SELECT * FROM Class";
        $result = $conn->prepare($sql);
        $result->execute();
        $class = [];

        while( $row = $result->fetch(PDO::FETCH_ASSOC)){

                $class[] = array($row['id'],
                    $row['className'],$row['create_date']);
            
        }
        echo json_encode($class);
    }
    
	//Add Student
	if($_GET["data"] == "add_student"){
		$studentId = $_POST["txtStudentId"];
		$studentName = $_POST["txtStudentName"];
        $password = $_POST["txtPassword"];
        $class = $_POST["ddlClass"];
		$phone = $_POST["txtPhone"];
        $email = $_POST["txtEmail"];
		$image = $_FILES['image']['name'];
			  
		$target_dir = "upload/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
	
		if (strlen($password) > 5) {
			echo json_encode("Password must be less than 5 characters long");
			return;
		}
	
		$encrypted_password = md5($password);
	
		$sql = "INSERT INTO Student (studentId, studentName, password, classId, phone, email, image) VALUES 
                                    (:studentId, :studentName, :password, :classId, :phone, :email, :image)";
		$insert = $conn->prepare($sql);
		$insert->bindParam(':studentId', $studentId);
        $insert->bindParam(':studentName', $studentName);
		$insert->bindParam(':password', $encrypted_password);
		$insert->bindParam(':classId', $class);
        $insert->bindParam(':phone', $phone);
		$insert->bindParam(':email', $email);
		$insert->bindParam(':image', $image);
	
		if($insert->execute()){
			echo json_encode("Insert Success");
		}else{
			echo json_encode("Insert Failed");
		}    
	}

    
		// 4 get_byid
		if($_GET['data'] == 'get_byid'){
			$result = $conn->prepare("SELECT * FROM Student WHERE id=:id");
			$result->bindParam(':id', $_GET['id']);
			$result->execute();
			if($row = $result->fetch(PDO::FETCH_ASSOC)){
                $student[] = array($row['id'], $row['studentId'], $row["studentName"], 
                $row['password'], $row['classId'], 
                $row["phone"], $row["email"], $row['image'],$row['create_date']);
			}
			echo json_encode($student);
		}

        //5 Update Book
	 if($_GET['data'] == 'update_student'){

		if(empty($_POST['txtStudentId']) || empty($_POST['txtStudentName'])){
			echo json_encode("Please check the empty fields!");
		}else{
			$id = $_GET['id'];
			$studentId = $_POST["txtStudentId"];
            $studentName = $_POST["txtStudentName"];
            $password = $_POST["txtPassword"];
            $class = $_POST["ddlClass"];
            $phone = $_POST["txtPhone"];
            $email = $_POST["txtEmail"];
	
			// Check if a new image file was uploaded
			if(!empty($_FILES['image']['name'])) {
				// Get the image file and move it to the uploads directory
				$image = $_FILES['image']['name'];
				$target_dir = "upload/";
				$target_file = $target_dir . basename($_FILES["image"]["name"]);
				move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
			} else {
				// Get the old image file name from the database
				$stmt = $conn->prepare("SELECT image FROM Student WHERE id=:id");
				$stmt->bindParam(':id', $id);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$image = $row['image'];
			}
	
			// Update the image file and user data in the database
			$sql = "UPDATE Student SET studentId=:studentId, studentName=:studentName, password=:password, classId=:classId, phone=:phone, email=:email, image=:image where id=:id;";
			$update = $conn->prepare($sql);
			$update->bindParam(':image', $image);
            $update->bindParam(':studentId', $studentId);
            $update->bindParam(':studentName', $studentName);
            $update->bindParam(':password', $encrypted_password);
            $update->bindParam(':classId', $class);
            $update->bindParam(':phone', $phone);
            $update->bindParam(':email', $email);
			$update->bindParam(':id', $id);
	
			if($update->execute()){
				// If the update was successful, delete the old image file if it exists
				if(!empty($_FILES['image']['name'])) {
					if(isset($_POST['oldImage']) && !empty($_POST['oldImage'])) {
						$old_image = $_POST['oldImage'];
						if(file_exists('upload/' . $old_image)) {
							unlink('upload/' . $old_image);
						}
					}
				}
				echo json_encode("Update Success");
			}else{
				echo json_encode("Update Failed");
			}
		}
	}

    //Delete Student
    if ($_GET['data'] == 'delete_student') {
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT image FROM Student WHERE id=:id;");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $image = $result['image'];

        $delete = $conn->prepare("DELETE FROM Student WHERE id=:id;");
        $delete->bindParam(':id', $id);

        if ($delete->execute()) {
            // delete image from folder
            $target_file = "upload/" . $image;
            if (file_exists($target_file)) {
                unlink($target_file);
            }

            echo json_encode("Delete Success");
        } else {
            echo json_encode("Delete Failed");
        }
    }

	


?>