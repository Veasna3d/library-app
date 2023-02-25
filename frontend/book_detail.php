<!--CDN-->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@100;300;400;700&display=swap');

    * {
        font-family: 'Noto Sans Khmer', sans-serif;
    }
</style>
<?php include './includes/bookHeaderAfterLogin.php' ?>

<?php $conn = new mysqli("localhost", "root", "", "libraryDB"); ?>
<!-- book detail Start -->
<div class="container-xxl py-5">
    <div class="container">
        <?php
        $bookId = $_GET['id'];
        $sql = "SELECT * FROM book WHERE id = '$bookId'";
        $rs = $conn->query($sql);
        if ($rs->num_rows > 0) {
            while ($row = $rs->fetch_array()) {
        ?>
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="img-border">
                            <img class="img-fluid" src="../admin./upload/<?php echo $row[3]; ?>" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="h-100">
                            <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                            <h1 class="display-6 mb-4"><?php echo $row[1] ?></h1>
                            <?php echo $row[2] ?>

                            <div class="d-flex align-items-center mb-4 pb-2">
                                <div class="ps-4">
                                    <h6>Author</h6>
                                    <small><?php echo $row[5] ?></small>
                                </div>
                            </div>
                            <a class="btn btn-warning rounded-pill py-3 px-5" data-bs-toggle="modal" data-bs-target="#studentAddModal">Borrow</a>
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="book_list.php">See More</a>
                        </div>
                    </div>
                </div>


    </div>
</div>
<!-- book detail End -->

<!-- Add Student -->
<div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Borrow Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="saveStudent">
                <div class="modal-body">

                    <div id="errorMessage" class="alert alert-warning d-none"></div>

                    <div class="visually-hidden">
                        <label for="">Book</label>
                        <input type="text" value="<?php echo $row[0] ?>" name="bookId" id="bookId" class="form-control" readonly />
                    </div>
            <?php
            }
        }
            ?>
            <?php
            //  session_start();
            $studentName = $_SESSION['studentName'];
            $sql = "SELECT * FROM Student WHERE studentName = '$studentName'";
            $rs = $conn->query($sql);
            if ($rs->num_rows > 0) {
                while ($row = $rs->fetch_array()) {

            ?>
                    <div class="visually-hidden">
                        <label for="">Student</label>
                        <input type="text" value="<?php echo $row[0]; ?>" name="studentId" id="studentId" class="form-control" readonly />
                    </div>

            <?php
                }
            }
            ?>
            <div class="mb-3">
                <label for="">Borrow Date</label>
                <input type="date" name="borrowDate" id="borrowDate" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="">Return Date</label>
                <input type="date" name="returnDate" id="returnDate" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="">Remark</label>
                <input type="text" name="remark" id="remark" class="form-control" />
            </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include './includes/footer.php' ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
    $(function() {
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10) month = "0" + month.toString();
        if (day < 10) day = "0" + day.toString();
        var maxDate = year + "-" + month + "-" + day;

        // alert(maxDate);
        $("#borrowDate").attr("min", maxDate);
        $("#returnDate").attr("min", maxDate);
        $("#borrowDate").attr("max", maxDate);
    });

    $(document).on('submit', '#saveStudent', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_student", true);

        $.ajax({
            type: "POST",
            url: "borrow.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    $('#errorMessage').removeClass('d-none');
                    $('#errorMessage').text(res.message);

                } else if (res.status == 200) {

                    $('#errorMessage').addClass('d-none');
                    $('#studentAddModal').modal('hide');
                    $('#saveStudent')[0].reset();

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                } else if (res.status == 500) {
                    alert(res.message);
                }
            }
        });

    });
</script>