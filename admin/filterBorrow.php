<?php 
    if(isset($_GET['filter'])){
        $filter = trim($_GET['filter']);
        if(!empty($_GET['filter'])){
            $con = mysqli_connect('localhost','root','','library_db');
            if($filter == 'all'){
                $stmnt = $con->prepare('select * from vborrow');
            }else {
                $stmnt = $con->prepare('select * from vborrow where status=?');
                $stmnt->bind_param('s',$filter);
            };
            $stmnt->execute();
            $stmnt->store_result();
            $stmnt->bind_result($id,$book_title,$studentName,$borrow_date,$return_date,$status,$remark,$create_date);
            $final = array();
            while($stmnt->fetch()){
                $each = array(
                    'id'=>$id,
                    'book_title'=>$book_title,
                    'studentName'=>$studentName,
                    'borrow_date'=>$borrow_date,
                    'return_date'=>$return_date,
                    'status'=>$status,
                    'remark'=>$remark,
                    'create_date'=>$create_date
                );
                array_push($final,$each);
            };
            echo json_encode($final);
            $stmnt->close();
            $con->close();
        };
    };
?>