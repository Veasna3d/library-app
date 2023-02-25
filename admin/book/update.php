<?php
    require '../config/db.php';
    include('function.php');
    if(isset($_POST["user_id"]))
    {
        $output = array();
        $statement = $conn->prepare(
            "SELECT * FROM Book 
            WHERE id = '".$_POST["user_id"]."' 
            LIMIT 1"
        );
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row)
        {
            $output["bookTitle"] = $row["bookTitle"];
            $output["description"] = $row["description"];
            $output["author"] = $row["author"];
            $output["categoryId"] = $row["categoryId"];
            if($row["image"] != '')
            {
                $output['user_image'] = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
            }
            else
            {
                $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
            }
        }
        echo json_encode($output);
    }
?>