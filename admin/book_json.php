<?php
     require './config/db.php';
    //Available
    if($_GET["data"] == "get_available"){
        $sql = "SELECT * FROM vbooks";
        $result = $conn->prepare($sql);
        $result->execute();
        $book = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            if($row['status'] == 1){
                $book[] = array($row['id'], $row['bookTitle'], $row["description"], 
                $row['categoryName'],  $row['author'],$row['image'],
                $status = "<span style='color: white;' class='badge bg-purple'>Available</span>", $row['create_date']);
            }
           
        }
        echo json_encode($book);
    }
      //UnAvailable
      if($_GET["data"] == "get_unavailable"){
        $sql = "SELECT * FROM vbooks";
        $result = $conn->prepare($sql);
        $result->execute();
        $book = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            if($row['status'] == 0){
                $book[] = array($row['id'], $row['bookTitle'],  $row["description"],
                $row['categoryName'],  $row['author'],$row['image'],
                $status = "<span style='color: white;' class='badge bg-red'>Unavailable</span>",$row['create_date']);
            }
           
        }
        echo json_encode($book);
    }

	if($_GET['data'] == "get_category"){
        $sql = "SELECT * FROM Category";
        $result = $conn->prepare($sql);
        $result->execute();
        $cateogry = [];

        while( $row = $result->fetch(PDO::FETCH_ASSOC)){

                $cateogry[] = array($row['id'],
                    $row['categoryName'],$row['create_date']);
            
        }
        echo json_encode($cateogry);
    }
    
	//Add Book
	if($_GET["data"] == "add_book"){
		$bookTitle = $_POST["txtBookTitle"];
		$description = $_POST["txtDescription"];
        $cateogry = $_POST["ddlCategory"];
		$author = $_POST["txtAuthor"];
		$image = $_FILES['image']['name'];
			  
		$target_dir = "upload/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
	
	
		$sql = "INSERT INTO Book (bookTitle, description, image, categoryId, author) VALUES 
                                (:bookTitle, :description, :image, :categoryId, :author)";
		$insert = $conn->prepare($sql);
		$insert->bindParam(':bookTitle', $bookTitle);
		$insert->bindParam(':description', $description);
		$insert->bindParam(':categoryId', $cateogry);
		$insert->bindParam(':author', $author);
		$insert->bindParam(':image', $image);
	
		if($insert->execute()){
			echo json_encode("Insert Success");
		}else{
			echo json_encode("Insert Failed");
		}    
	}

    
		// 4 get_byid
		if($_GET['data'] == 'get_byid'){
			$result = $conn->prepare("SELECT * FROM Book WHERE id=:id");
			$result->bindParam(':id', $_GET['id']);
			$result->execute();
			if($row = $result->fetch(PDO::FETCH_ASSOC)){
				$book[] = array($row['id'], $row['bookTitle'], $row["description"],
                $row['categoryId'],  $row['author'],$row['image']);
			}
			echo json_encode($book);
		}

        //5 Update Book
	 if($_GET['data'] == 'update_book'){

		if(empty($_POST['txtBookTitle']) || empty($_POST['ddlCategory'])){
			echo json_encode("Please check the empty fields!");
		}else{
			$id = $_GET['id'];
			$bookTitle = $_POST["txtBookTitle"];
            $description = $_POST["txtDescription"];
            $cateogry = $_POST["ddlCategory"];
            $author = $_POST["txtAuthor"];
	
			// Check if a new image file was uploaded
			if(!empty($_FILES['image']['name'])) {
				// Get the image file and move it to the uploads directory
				$image = $_FILES['image']['name'];
				$target_dir = "upload/";
				$target_file = $target_dir . basename($_FILES["image"]["name"]);
				move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
			} else {
				// Get the old image file name from the database
				$stmt = $conn->prepare("SELECT image FROM Book WHERE id=:id");
				$stmt->bindParam(':id', $id);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$image = $row['image'];
			}
	
			// Update the image file and user data in the database
			$sql = "UPDATE Book SET bookTitle=:bookTitle, description=:description, categoryId=:categoryId, author=:author, image=:image where id=:id;";
			$update = $conn->prepare($sql);
			$update->bindParam(':image', $image);
			$update->bindParam(':bookTitle', $bookTitle);
            $update->bindParam(':description', $description);
            $update->bindParam(':categoryId', $cateogry);
            $update->bindParam(':author', $author);
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

    //Delete Book
    if ($_GET['data'] == 'delete_book') {
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT image FROM Book WHERE id=:id;");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $image = $result['image'];

        $delete = $conn->prepare("DELETE FROM Book WHERE id=:id;");
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

	
     //unavailable 
     if($_GET['data'] == 'is_unavailable') {
        
        $id = $_GET['id'];
        $status = 0;
        $sql = "UPDATE Book set status=:status where id=:id;";
        $update = $conn->prepare($sql);

        $update->bindParam(':status', $status);
        $update->bindParam(':id', $id);

        if($update->execute()){
            echo json_encode("Return Success");
        }else{
            echo json_encode("Return Faild");
        }
    }
    //available
    if($_GET['data'] == 'is_available'){
        
        $id = $_GET['id'];
        $status = 1;
        $sql = "UPDATE Book set status=:status where id=:id;";
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