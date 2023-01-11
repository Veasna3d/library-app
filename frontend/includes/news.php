<?php $conn = new mysqli("localhost","root","","libraryDB"); ?>    
    <!-- News -->
     <section id="courses">
         <div class="container">
             <div class="row">

                 <div class="col-md-12 col-sm-12">
                     <div class="section-title">
                         <h2>List News <small>Upgrade your skills with newest books</small></h2>
                     </div>
                     <div class="">
                         <p><a style="margin-left:1%;" class="btn btn-default" href="list_news.php"><i
                                     class="fa fa-arrow-right" aria-hidden="true"></i> See More</a></p>
                     </div>

                     <div class="owl-carousel owl-theme owl-courses">
                     <?php
                        $sql = "SELECT * FROM news";
                        $rs = $conn->query($sql);
                        if ($rs->num_rows > 0 ){
                                while ( $row = $rs->fetch_array()){
                                ?>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="item">
                                            <div class="courses-thumb">
                                                <div class="courses-top">
                                                    <div class="courses-image">
                                                    <img src="admin./upload/<?php echo $row[3]; ?>" alt="">
                                                    </div>
                                                    <div class="courses-date">
                                                        <span><i class="fa fa-calendar"></i> <?php echo $row[4] ?></span>
                                                        <!-- <span><i class="fa fa-clock-o"></i> 7 Hours</span> -->
                                                    </div>
                                                </div>

                                                <div class="courses-detail">
                                                    <h3><a href="#"><?php echo $row[1] ?></a></h3>
                                                    <p><?php echo $row[2] ?></p>
                                                </div>

                                                <div class="courses-info">
                                                    <div class="courses-author">
                                                        <img src="./assets/images/author-image1.jpg" class="img-responsive" alt="">
                                                        <span>Mark Wilson</span>
                                                    </div>
                                                    <div class="courses-price">
                                                        <a href="#"><span>USD 25</span></a>
                                                    </div>
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
         </div>
     </section>