<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .left-menu {
            position: fixed;

        }
    </style>
</head>

<body>
    <aside class="main-sidebar left-menu">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo (!empty($_SESSION["image"])) ? './upload/' . $_SESSION["image"] : './upload/user.png'; ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $_SESSION["username"] ?></p>
                    <a><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">REPORTS</li>
                <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li class="header">MANAGE</li>

                  <!-- Brand-->
                  <li class="treeview">
                    <a href="#">
                        <i class="fa fa-home"></i>
                        <span>Brand</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="brand.php"><i class="fa fa-circle-o"></i> Profile</a></li>
                    </ul>
                </li>

                <!-- User Management-->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>User Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="user.php"><i class="fa fa-circle-o"></i> User</a></li>

                        <li><a href="slide.php"><i class="fa fa-circle-o"></i> Slide</a></li>
                      
                    </ul>
                </li>

                <!-- transaction -->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-refresh"></i>
                        <span>Transaction</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="borrow.php"><i class="fa fa-circle-o"></i>Borrow</a></li>

                        <li><a href="supplier.php"><i class="fa fa-circle-o"></i>Supllier</a></li>

                        <li><a href="impSupplier.php"><i class="fa fa-circle-o"></i>Import</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Books</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="book.php"><i class="fa fa-circle-o"></i> Book List</a></li>
                        <li><a href="category.php"><i class="fa fa-circle-o"></i> Category</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-graduation-cap"></i>
                        <span>Students</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="student.php"><i class="fa fa-circle-o"></i> Student List</a></li>
                        <li><a href="class.php"><i class="fa fa-circle-o"></i> Class</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file-text"></i>
                        <span>Notify</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <li><a href="news.php"><i class="fa fa-server"></i> News</a></li>
                    </ul>
                </li>
                <!-- Report -->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file-text"></i>
                        <span>Report</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="report.php"><i class="fa fa-server"></i> Report</a></li>
                    </ul>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
</body>

</html>