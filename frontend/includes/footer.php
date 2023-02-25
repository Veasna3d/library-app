<?php $conn = new mysqli("localhost", "root", "", "libraryDB"); ?>
<!-- Footer Start -->
<div class="container-fluid bg-dark text-body footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">

            <div class="col-lg-4 col-md-4">
                <h5 class="text-light mb-4">About US</h5>
                <?php
                $sql = "SELECT * FROM brand";
                $rs = $conn->query($sql);
                while ($row = $rs->fetch_array()) {
                ?>
                <p><?php echo $row[6] ?></p>
                <div class="d-flex pt-2">
                    <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href="<?php echo $row[10] ?>"><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href="<?php echo $row[7] ?>"><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href="<?php echo $row[11] ?>"><i
                            class="fab fa-youtube"></i></a>
                    <a class="btn btn-square btn-outline-secondary rounded-circle me-0" href="<?php echo $row[8] ?>"><i
                            class="fab fa-telegram"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <h5 class="text-light mb-4">ADDRESS</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i><?php echo $row[3] ?></p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i><?php echo $row[4] ?></p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i><?php echo $row[5] ?></p>
            </div>
            <div class="col-lg-4 col-md-4">
                <h5 class="text-light mb-4">ADDRESS</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i><?php echo $row[2] ?></p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i><?php echo $row[8] ?></p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i><?php echo $row[9] ?></p>
            </div>
            <?php
                }
        ?>
        </div>
    </div>

</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="./asset/lib/wow/wow.min.js"></script>
<script src="./asset/lib/easing/easing.min.js"></script>
<script src="./asset/lib/waypoints/waypoints.min.js"></script>
<script src="./asset/lib/counterup/counterup.min.js"></script>
<script src="./asset/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="./asset/lib/lightbox/js/lightbox.min.js"></script>

<!-- Template Javascript -->
<script src="./asset/js/main.js"></script>
</body>

</html>