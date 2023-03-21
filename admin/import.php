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
                    Supplier
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Supplier</li>
                    <li class="active">Class</li>
                </ol>
            </section>

            <div class="col-md-12">
                <div class="content-panel" style="padding-top: 10px;">
                    <div class="box">
                        <div class="box-header with-border">
                            <button type="button" id="btnAdd" class="btn btn-primary btn-sm btn-flat"
                                data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> New</button>
                        </div>
                        <div class="card-body">
                            <table style="width: 100%;" data-ordering="false" id="table_id"
                                class="table table-hover d-flex justify-content-between">

                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Supplier Info</h4>
                                                <button type="button" class="close" data-dismiss="modal"><i
                                                        class="fas fa-closes"></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="post" id="form">
                                                    <div class="form-group">
                                                        <label for="name" class="form-label">Import Date</label>
                                                        <input type="date" name="txtDate" id="txtDate"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="suppliername">Book</label>
                                                        <select class="form-control" name="txtBook" id="txtBook">
                                                            <option>--Choose---</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="suppliername">Category</label>
                                                        <select class="form-control" name="txtCategory" id="txtCategory">
                                                            <option>--Choose---</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="suppliername">Supplier</label>
                                                        <select class="form-control" name="txtSuppname"
                                                            id="txtSuppname">
                                                            <option>--Choose---</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Author</label>
                                                        <input type="text" name="txtAuthor" id="txtAuthor"
                                                            class="form-control" placeholder="optional">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="quantity">Quantity</label>
                                                        <input type="text" name="txtQty" id="txtQty"
                                                            class="form-control" placeholder="">
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

        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/scripts.php'; ?>


        <script type="text/javascript" src="js\jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="js\dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript" src="js\import.js"></script>
</body>