<?php $conn = new mysqli("localhost","root","","libraryDB"); ?>
<!-- Book -->
<section id="team">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h2>List Book<small>Train your show your action</small></h2>
                         </div>
                         <div class="">
                              <p><a style="margin-bottom:1%; float:none;" class="btn btn-default" href="list_book.php"><i class="fa fa-arrow-right" aria-hidden="true"></i> See More</a></p>
                         </div>

                         <!-- select data Book from database -->
                         <?php
                         $sql = "SELECT * FROM book WHERE status = 0 LIMIT 4";
                         $rs = $conn->query($sql);
                         if ($rs->num_rows > 0 ){
                                   while ( $row = $rs->fetch_array()){
                                   ?>
                                   <div class="col-md-3 col-sm-6">
                                        <div class="team-thumb">
                                        <div class="team-image">
                                             <img src="admin./upload/<?php echo $row[2]; ?>" alt="">
                                        </div>
                                        <div class="team-info">
                                             <h3><?php echo $row[1] ?></h3>
                                             <span><?php echo $row[4] ?></span>
                                        </div>
                                        <ul class="social-icon">
                                             <li><a href="#" data-toggle="modal" data-target="#exampleModal"
                                                       class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                        </ul>
                                        </div>
                                   </div>
                                   <?php
                                   }
                              }
                         ?>
                    </div>

               </div>
          </div>
     </section>