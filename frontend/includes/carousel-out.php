<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <?php
    $conn = mysqli_connect("localhost", "root", "", "libraryDB");
    $query = "SELECT * FROM slide ORDER BY id ASC";
    $result = mysqli_query($conn, $query);
    $count = 0;
    while($row = mysqli_fetch_array($result)){
      $active = '';
      if($count == 0){
        $active = 'active';
      }
      echo '<div class="carousel-item'.$active.'">';
      echo "<img src='./admin./upload/" . $row['image'] . "' width='100%'";
      echo '</div>';
      $count++;
    }
    ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>

</body>
</html>
 