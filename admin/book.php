<?php
session_start();
include('config/db.php');

if (!isset($_SESSION["username"])) {
    header('Location: ./index.php');
}
?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-top: 50px;">
            <!-- Content Header (Page header) -->

            <section class="content-header">
                <h1>
                    Book List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

                    <li class="active">Book</li>
                </ol>
            </section>

            <div class="col-md-12">
                <div class="content-panel" style="padding-top: 10px;">
                    <div class="box">
                        <div class="box-header with-border">

                            <button type="button" id="btnAdd" class="btn btn-primary btn-sm btn-flat"
                                data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> New</button>

                            <button type="button" id="btnAvailable" class="btn btn-info btn-sm btn-flat">
                                Available</button>

                            <button type="button" id="btnUnAvailable" class="btn btn-warning btn-sm btn-flat">
                                UnAvailable</button>
                        </div>
                        <div class="card-body">
                            <table style="width: 100%;" data-ordering="false" id="table_id"
                                class="table table-hover d-flex justify-content-between">

                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Book Info</h4>
                                                <button type="button" class="close" data-dismiss="modal"><i
                                                        class="fas fa-closes"></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="post" id="form" enctype="multipart/form-data">

                                                    <div class="form-group">
                                                        <label for="name">Book Title</label>
                                                        <input type="text" name="txtBookTitle" id="txtBookTitle"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="txtDescription">Description</label>
                                                        <textarea class="form-control" id="txtDescription"
                                                            name="txtDescription" rows="5"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Author</label>
                                                        <input type="text" name="txtAuthor" id="txtAuthor"
                                                            class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="book" class="form-label">Category</label>
                                                        <select class="form-control" name="ddlCategory" id="ddlCategory"
                                                            required>
                                                            <option>--Choose---</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="image">Image</label>
                                                        <input type="file" name="image" id="image"
                                                            class="form-control-file">
                                                    </div>


                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success"
                                                            id="btnSave">Save</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </table>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

    <script type="text/javascript" src="js\jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js\dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="js\book.js"></script>




</body>