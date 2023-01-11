<?php include'./frontend/includes/book_header.php'  ?>


<?php $conn = new mysqli("localhost", "root", "", "libraryDB"); ?>

<!-- Book -->
<section id="team">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <div class="section-title">
                    <h2>Popular Book<small>Train your mind show your action</small></h2>
                </div>

                <?php
                $sql = "SELECT * FROM book WHERE status = 0 LIMIT 16";
                $rs = $conn->query($sql);
                if ($rs->num_rows > 0) {
                    while ($row = $rs->fetch_array()) {
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
                                <?php
                                if (isset($_SESSION['studentName'])) {
                                ?>
                                <ul class="social-icon">
                                    <li><a href="modal_book.php" data-toggle="modal" data-target="#exampleModal" class="fa fa-facebook-square" attr="facebook icon"></a></li>

                                </ul>
                                <?php
                                } else {
                                    echo' <ul class="social-icon">
                                    <li> <a href="./login.php">Detile</a></li> </ul>';
                                }
                                ?>
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
<?php include'./frontend/includes/default_footer.php'  ?>