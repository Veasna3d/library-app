<?php include'./includes/bookHeaderAfterLogin.php'  ?>

<?php $conn = new mysqli("localhost", "root", "", "libraryDB"); ?>
<!-- Team Start -->
<div class="container-xxl py-5" id="book">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="section-title bg-white text-center text-primary px-3">Our Team</h6>
            <h1 class="display-6 mb-4">We Are A Creative Team For Your Dream Project</h1>
        </div>
        <div class="row g-4">
            <?php
            $sql = "SELECT * FROM book WHERE status = 0 ORDER BY Id DESC";
            $rs = $conn->query($sql);
            if ($rs->num_rows > 0) {
                while ($row = $rs->fetch_array()) {
            ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item text-center p-4">
                            <img class="img-fluid border rounded w-80 p-2 mb-4" src="../admin./upload/<?php echo $row[3]; ?>" alt="">
                            <div class="team-text">
                                <div class="team-title">
                                    <h5><?php echo $row[1] ?></h5>
                                    <span><?php echo $row[5] ?></span>
                                </div>
                                <div class="team-social">
                                    <a class="btn btn-square btn-primary rounded-circle" href="book_detail.php?id=<?php echo $row['id'] ?>"><i class="fa fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        
        </div>
    </div>
</div>
<!-- Team End -->

<?php include'./includes/footer.php'  ?>