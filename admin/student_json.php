<?php
    require './config/db.php';
    if($_GET["data"] == "get_student"){
        $sql = "SELECT * FROM tbl_student";
        $result = $conn->prepare($sql);
        $result->execute();
        $student = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $student[] = array($row['id'], $row['studentId'], 
            $row['firtName'],  $row['lastName'],$row['photo'], 
            $row['class_id'], $row['phone'], $row['email'], $row['create_date']);
        }
        echo json_encode($student);
    }

    //get book
    if($_GET['data'] == "get_class"){
        $sql = "SELECT * FROM tbl_class";
        $result = $conn->prepare($sql);
        $result->execute();
        $class = [];

        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
            $class[] = array($row['id'], $row['class_name'],
                    $row['create_date']);
        }
        echo json_encode($class);
    }
 
//--------------------------------------------------------------------------//
    //get by_clas_id
    if($_GET['data'] == "get_classid"){
        $classid = $_GET['id'];
        $result = $conn->prepare("Select * from tbl_class where id=:id");
        $result->bindParam(':id', $classid);
        $result->execute();

        if($row=$result->fetch(PDO::FETCH_ASSOC)){
            $class[] = array($row['id'], $row['class_name'],
                    $row['create_date']);
        }
        echo json_encode($class);
    }

//--------------------------------------------------------------------------//

    //add borrow
    if($_GET['data'] == 'add_student'){

            $studentId = $_POST['txtStudentId'];
            $firstName = $_POST['txtFirstName'];
            $lastName = $_POST['txtLastName'];
            $stuImage = $_POST['stuImage'];
            $classId = $_POST['ddlClass'];
            $phone = $_POST['txtPhone'];
            $email = $_POST['txtEmail'];

            $sql = "INSERT INTO tbl_student (studentId, firstName, lastName, photo, class_id, phone, email)
             values (:studentId, :firstName, :lastName, :photo, :class_id, :phone, :email);";
            $insert = $conn->prepare($sql);
            $insert->bindParam(':studentId', $studentId);
            $insert->bindParam(':firstName', $firstName);
            $insert->bindParam(':lastName', $lastName);
            $insert->bindParam(':photo', $stuImage);
            $insert->bindParam(':class_id', $classId);
            $insert->bindParam(':phone', $phone);
            $insert->bindParam(':email', $email);

            if($insert->execute()){
                echo json_encode("Insert Success");
            }else{
                echo json_encode("Insert Faild");
            }
        }

    //get_byid
    if($_GET['data'] == 'get_byid'){
        $result = $conn->prepare("SELECT * FROM tbl_student WHERE id=:id");
        $result->bindParam(':id', $_GET['id']);
        $result->execute();
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            $student[] = array($row['id'], $row['studentId'], 
            $row['firtName'],  $row['lastName'],$row['photo'], 
            $row['class_id'], $row['phone'], $row['email'], $row['create_date']);
        }
        echo json_encode($student);
    }

    //update
    if($_GET['data'] == 'update_student'){
        
            $id = $_GET['id'];
            $studentId = $_POST['txtStudentId'];
            $firstName = $_POST['txtFirstName'];
            $lastName = $_POST['txtLastName'];
            $stuImage = $_POST['stuImage'];
            $classId = $_POST['ddlClass'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];

            $sql = "UPDATE tbl_student set studentId=:studentId, firstName=:firstName, lastName=:lastName, photo=:photo, 
                    class_id=:class_id, phone=:phone, email=:email where id=:id;";
            $update = $conn->prepare($sql);

            $update->bindParam(':studentId', $studentId);
            $update->bindParam(':firstName', $firstName);
            $update->bindParam(':lastName', $lastName);
            $update->bindParam(':photo', $stuImage);
            $update->bindParam(':class_id', $classId);
            $update->bindParam(':phone', $phone);
            $update->bindParam(':email', $email);
            $update->bindParam(':id', $id);

            if($update->execute()){
                echo json_encode("Update Success");
            }else{
                echo json_encode("Update Faild");
            }
        }

    //delete
    if($_GET['data'] == 'delete_student'){
        $student_id = $_GET['id'];
        $delete = $conn->prepare("DELETE FROM tbl_student where id=:id;");
        $delete->bindParam(':id', $student_id);
        if($delete->execute()){
            echo json_encode("Delete Success");
        }else{
            echo json_encode("Delete Faild");
        }
    }
?>