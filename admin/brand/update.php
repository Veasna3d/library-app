<?php
    require '../config/db.php';
    include('function.php');
    if(isset($_POST["user_id"]))
    {
        $output = array();
        $statement = $conn->prepare(
            "SELECT * FROM Brand 
            WHERE id = '".$_POST["user_id"]."' 
            LIMIT 1"
        );
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row)
        {
            $output["brandName"] = $row["brandName"];
            $output["address"] = $row["address"];
            $output["phone"] = $row["phone"];
            $output["email"] = $row["email"];
            $output["description"] = $row["description"];
            $output["facebook"] = $row["facebook"];
            $output["telegram"] = $row["telegram"];
            $output["instagram"] = $row["instagram"];
            $output["twitter"] = $row["twitter"];
            $output["youtube"] = $row["youtube"];
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