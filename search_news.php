<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "libraryDB");

// Get the search term from the AJAX request
$searchTerm = $_GET['searchTerm'];

// Construct the SQL query
$sql = "SELECT * FROM news WHERE subTitle LIKE '%$searchTerm%'";

// Execute the query
$result = $conn->query($sql);

// Display the search results
if ($result->num_rows > 0) {
  while ($row = $result->fetch_array()) {
?>

<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
    <div class="team-item text-center p-4">
        <img class="img-fluid border rounded w-80 p-2 mb-4" src="admin./upload/<?php echo $row[3]; ?>" alt="">
        <div class="team-text">
            <div class="team-title">
                <h5><?php echo $row[1] ?></h5>
                <span><?php echo $row[2] ?></span>
            </div>
            <div class="team-social">
                <a class="btn btn-square btn-primary rounded-circle"
                    href="news_detail.php?id=<?php echo $row['id'] ?>"><i class="fa fa-eye"></i></a>
            </div>
        </div>
    </div>
</div>

<?php
  }
} else {
  echo '<div class="text-center">No results found.</ដ>';
}
?>