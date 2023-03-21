<?php include './includes/user_header.php'  ?>
<?php    
 require './config/db.php';
 
 $studentName =  $_SESSION['studentName'];
 $sql = "SELECT booKTitle, borrowDate, returnDate, status FROM vborrow WHERE studentName = '$studentName'";
 $result = $conn->prepare($sql);
 $result->execute();

 ?>


<div id="contact" class="container-xxl py-5">
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h6>Your Record</h6>
                <a class="btn btn-outline-warning" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
                    Logout</a>
            </div>
            <ul class="list-group list-group-flush">
                <!-- Table -->
                <?php
                    if ($result->rowCount() > 0) {
                        // display table
                    ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Book</th>
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
                <?php
} else {
    // display "not found" message
?>
                <p class="text-center pt-5">No records found.</p>
                <?php
}
?>
            </ul>
        </div>
    </div>
</div>
<?php include './includes/footer.php'  ?>