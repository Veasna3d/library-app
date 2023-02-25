<?php $conn = new mysqli("localhost", "root", "", "libraryDB"); ?>
 <!-- Project Start -->
  <div class="container-xxl py-5" id="news">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="section-title bg-white text-center text-primary px-3">Our Projects</h6>
                <h1 class="display-6 mb-4">Learn More About Our Complete Projects</h1>
            </div>
            <div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.1s">
            <?php
            $sql = "SELECT * FROM news";
            $rs = $conn->query($sql);
            if ($rs->num_rows > 0) {
                while ($row = $rs->fetch_array()) {
            ?>
            
                <div class="project-item border rounded h-10 p-4" data-dot="01">
                    <div class="position-relative mb-4">
                        <img class="img-fluid rounded" src="admin./upload/<?php echo $row[3]; ?>" alt="">
                        <a  href="news_detail.php?id=<?php echo $row['id'] ?>"><i class="fa fa-eye fa-2x"></i></a>
                    </div>
              
                    <h6 style="font-family: Battambang;"><?php echo $row[1] ?></h6>
                    <span style="font-family: Battambang;"><?php echo mb_substr( strip_tags($row[2]),0,50,'utf8') ?></span>
                </div>
          
                <?php
                }
            }
            ?>
                
            </div>
        </div>
    </div>
    <!-- Project End -->