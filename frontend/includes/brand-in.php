  <!-- Brand & Contact Start -->
  <div id="home" class="container-fluid py-4 px-5 wow fadeIn" data-wow-delay="0.1s">
      <div class="d-flex justify-content-between">
          <div class="col-lg-4 col-md-6 text-center text-lg-start">
              <a href="#" class="navbar-brand m-0 p-0">
                  <?php
                    $sql = "SELECT * FROM brand";
                    $rs = $conn->query($sql);
                    while ($row = $rs->fetch_array()) {
                    ?>
                  <h1 class="fw-bold text-primary m-0 p-0">
                      <img class="bg-info rounded-circle" style="width: 10%;" src="../admin./upload/<?php echo $row[2]; ?>"
                          alt="">
                      <?php echo $row[1] ?>
                  </h1>
                 
                  <?php
                    }
                    ?>
              </a>
          </div>

          <div class="d-flex col-md-6 justify-content-around">
              <div class="d-flex align-items-center justify-content-start">
                  <div class="flex-shrink-0 btn-lg-square border rounded-circle">
                      <i class="bi bi-phone"></i>
                  </div>
                  <?php
                                $sql = "SELECT * FROM brand";
                                $rs = $conn->query($sql);
                                while ($row = $rs->fetch_array()) {
                                ?>
                  <div class="ps-3">
                      <p class="mb-2">Call Us</p>
                      <h6 class="mb-0"><?php echo $row[4] ?></h6>
                  </div>
                  <?php
                                }
                                ?>
              </div>



              <div class="d-flex align-items-center justify-content-start">
                  <div class="flex-shrink-0 btn-lg-square border rounded-circle">
                      <i class="far fa-envelope text-primary"></i>
                  </div>
                  <?php
                            $sql = "SELECT * FROM brand";
                            $rs = $conn->query($sql);
                            while ($row = $rs->fetch_array()) {
                            ?>
                  <div class="ps-3">
                      <p class="mb-2">Email Us</p>
                      <h6 class="mb-0"><?php echo $row[5] ?></h6>
                  </div>
                  <?php
                            }
                            ?>
              </div>
          </div>
      </div>
  </div>


  <!-- Brand & Contact End -->