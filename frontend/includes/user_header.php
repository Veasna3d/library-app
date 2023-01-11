<?php  
 //login_success.php  
 session_start();   
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Welcome to library</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../assets/css/templatemo-style.css">

</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

    <!-- PRE LOADER -->
    <section class="preloader">
        <div class="spinner">

            <span class="spinner-rotate"></span>

        </div>
    </section>

    <!-- MENU -->
    <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>

                <!-- lOGO TEXT HERE -->
                <a href="welcome.php" class="navbar-brand">Library</a>
            </div>

            <!-- MENU LINKS -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-nav-first">
                    <li><a href="welcome.php" class="smoothScroll">Home</a></li>
                    <li><a href="welcome.php" class="smoothScroll">News</a></li>
                    <li><a href="welcome.php" class="smoothScroll">Book</a></li>
                    <li><a href="welcome.php" class="smoothScroll">Contact</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#about" class="smoothScroll"><i class="fa fa-user"></i><?php echo $_SESSION["studentName"] ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>