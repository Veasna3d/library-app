<?php include'./frontend/includes/book_header.php'  ?>

<?php $conn = new mysqli("localhost", "root", "", "libraryDB"); ?>
<!-- Team Start -->
<div class="container-xxl py-5" id="book">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="section-title bg-white text-center text-primary px-3">Our Team</h6>
            <h1 class="display-6 mb-4">We Are A Creative Team For Your Dream Project</h1>
            <div class="search-form">
                <form>
                    <input type="text" class="form-control" name="search" placeholder="Search...">
                </form>

            </div>

        </div>
        <div class="row g-4 team-items">
            <div class="search-results"></div>
            <?php
            $sql = "SELECT * FROM news ORDER BY Id DESC";
            $rs = $conn->query($sql);
            if ($rs->num_rows > 0) {
                while ($row = $rs->fetch_array()) {
            ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item text-center p-4">
                    <img class="img-fluid border rounded w-80 p-2 mb-4" src="admin./upload/<?php echo $row[3]; ?>"
                        alt="">
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
            }
            ?>

        </div>
    </div>
</div>
<!-- Team End -->

<?php include'./frontend/includes/footer.php'  ?>

<script>
$(document).ready(function() {
    $('.search-form input[name="search"]').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();
        if (searchTerm.length > 0) {
            $('.team-items').find('.team-item').hide();
            $.ajax({
                url: 'search_news.php',
                type: 'GET',
                data: {
                    searchTerm: searchTerm
                },
                success: function(data) {
                    if (data.trim() == 'No results found.') {
                        $('.search-results').html('<li>New Item</li>');
                    } else {
                        $('.search-results').html(data);
                    }
                }
            });
        } else {
            $('.team-items').find('.team-item').show();
            $('.search-results').empty();
        }
    });
});

$('.search-results').on('click', 'li', function() {
    var searchItem = $(this).text().toLowerCase();
    $('.team-items').find('.team-item').each(function() {
        var subTitle = $(this).find('.team-title h5').text().toLowerCase();
        if (subTitle.indexOf(searchItem) != -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
});
</script>