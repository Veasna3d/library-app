<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@100;300;400;700&display=swap');

* {
    font-family: 'Noto Sans Khmer', sans-serif;
}
</style>
<?php include './frontend/includes/book_header.php'  ?>

<?php $conn = new mysqli("localhost", "root", "", "libraryDB"); ?>
<!-- About Start -->
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
                            <img class="img-fluid" src="admin./upload/<?php echo $row[3]; ?>" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="h-100">
                            <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                            <h1 class="display-6 mb-4"><?php echo $row[1]  ?></h1>
                            <?php echo $row[2]?>

                            <div class="d-flex align-items-center mb-4 pb-2">
                                <div class="ps-4">
                                    <h6>Author</h6>
                                    <small><?php echo $row[5]  ?></small>
                                </div>
                            </div>
                            <a class="btn btn-warning rounded-pill py-3 px-5" href="login.php">Borrow</a>
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="book_list.php">See More</a>
                        </div>
                    </div>
                </div>

        <?php
            }
        }
        ?>
    </div>
</div>
<!-- About End -->
<?php include './frontend/includes/footer.php'  ?>