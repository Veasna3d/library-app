<?php include './includes/user_header.php'; ?>
<?php    
 require './config/db.php';
 
 $studentName =  $_SESSION['studentName'];
 $sql = "SELECT booKTitle, borrowDate, returnDate, status FROM vborrow WHERE studentName = '$studentName'";
 $result = $conn->prepare($sql);
 $result->execute();

 ?>

<!-- User Infor -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">Your Record</div>
                <div class="panel-body">
                    <!-- Table -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Book Title</th>
                                <th scope="col">Borrow Date</th>
                                <th scope="col">Return Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                if($row["status"] == 1){
                                    $status = "<span style='color: white; background: purple;' class='badge bg-purple'>Returned</span>";
                                }else{
                                    $status = "<span style='color: white; background: red;' class='badge bg-red'>Pending</span>";
                                }
                            ?>
                            <tr>
                                <td><?php echo $row["bookTitle"]; ?></td>
                                <td><?php echo $row["borrowDate"]; ?></td>
                                <td><?php echo $row["returnDate"]; ?></td>
                                <td><?php echo $status; ?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
</section>


<?php include './includes/user_footer.php'; ?>