<?php include './includes/bookHeaderAfterLogin.php'  ?>
<?php $conn = new mysqli("localhost", "root", "", "libraryDB"); ?>
<!-- Team Start -->
<div id="book" class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="section-title bg-white text-center text-primary px-3">New Book</h6>
            <h1 class="display-6 mb-4">List New Books</h1>
        </div>
        <div class="row g-4">
            <?php
            $sql = "SELECT * FROM news";
            $rs = $conn->query($sql);
            if ($rs->num_rows > 0) {
                while ($row = $rs->fetch_array()) {
            ?>
            <div class="col-lg-6 col-md-6 d-flex wow fadeInUp shadow-sm bg-body-tertiary rounded" data-wow-delay="0.1s">
                <div class="col-6">
                    <img class="img-fluid border rounded" src="../admin./upload/<?php echo $row[3]; ?>" alt="">
                </div>
                <div class="col-6 team-text p-3 ">
                    <div class="team-title">
                        <h5 style="font-family: Battambang;"><?php echo $row[1] ?></h5>
                        <span
                            style="font-family: Battambang;"><?php echo mb_substr(strip_tags($row[2]), 0, 81, 'utf8') ?></span>
                    </div><br>
                    <div class="team-social">
                        <a href="news_detail.php?id=<?php echo $row['id'] ?>">
                            <button type="button" class="btn btn-primary">View</button>
                        </a>
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

<?php include './includes/footer.php'  ?>