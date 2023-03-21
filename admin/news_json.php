<?php
     require './config/db.php';
    //Get News
    if($_GET["data"] == "get_news"){
        $sql = "SELECT * FROM news";
        $result = $conn->prepare($sql);
        $result->execute();
        $news = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $news[] = array($row['id'], $row['subTitle'], $row["detail"], 
            $row['image'], $row['create_date']);
        }
        echo json_encode($news);
    }

    
	//Add News
	if($_GET["data"] == "add_news"){
		$subTitle = $_POST["txtSubTitle"];
		$detail = $_POST["txtDetail"];
		$image = $_FILES['image']['name'];
			  
		$target_dir = "upload/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
	
	
		$sql = "INSERT INTO News ( subTitle, detail, image) VALUES 
                                ( :subTitle, :detail, :image)";
		$insert = $conn->prepare($sql);
		$insert->bindParam(':subTitle', $subTitle);
		$insert->bindParam(':detail', $detail);
		$insert->bindParam(':image', $image);
	
		if($insert->execute()){
			echo json_encode("Insert Success");
		}else{
			echo json_encode("Insert Failed");
		}    
	}

    
		// 4 get_byid
		if($_GET['data'] == 'get_byid'){
			$result = $conn->prepare("SELECT * FROM News WHERE id=:id");
			$result->bindParam(':id', $_GET['id']);
			$result->execute();
			if($row = $result->fetch(PDO::FETCH_ASSOC)){
				$news[] = array($row['id'], $row['subTitle'], $row["detail"],$row['image']);
			}
			echo json_encode($news);
		}

        //5 Update News
	 if($_GET['data'] == 'update_news'){

		if(empty($_POST['txtSubTitle']) || empty($_POST['txtDetail'])){
			echo json_encode("Please check the empty fields!");
		}else{
			$id = $_GET['id'];

			$subTitle = $_POST["txtSubTitle"];
		    $detail = $_POST["txtDetail"];

	
			// Check if a new image file was uploaded
			if(!empty($_FILES['image']['name'])) {
				// Get the image file and move it to the uploads directory
				$image = $_FILES['image']['name'];
				$target_dir = "upload/";
				$target_file = $target_dir . basename($_FILES["image"]["name"]);
				move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
			} else {
				// Get the old image file name from the database
				$stmt = $conn->prepare("SELECT image FROM News WHERE id=:id");
				$stmt->bindParam(':id', $id);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$image = $row['image'];
			}
	
			// Update the image file and user data in the database
			$sql = "UPDATE News SET subTitle=:subTitle, detail=:detail, image=:image where id=:id;";
			$update = $conn->prepare($sql);
			$update->bindParam(':image', $image);
            $update->bindParam(':subTitle', $subTitle);
            $update->bindParam(':detail', $detail);
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

    //Delete News
    if ($_GET['data'] == 'delete_news') {
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT image FROM News WHERE id=:id;");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $image = $result['image'];

        $delete = $conn->prepare("DELETE FROM News WHERE id=:id;");
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