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
                    Footer
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Footer</li>
                    <li class="active">Class</li>
                </ol>
            </section>

            <div class="col-md-12">
                <div class="content-panel" style="padding-top: 10px;">
                    <div class="box">
                        <div class="box-header with-border">
                            <button type="button" id="btnAdd" class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> New</button>
                        </div>
                        <div class="card-body">
                            <table data-ordering="false" id="table_id" class="table table-hover d-flex justify-content-between">

                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Footer Info</h4>
                                                <button type="button" class="close" data-dismiss="modal"><i class="fas fa-closes"></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="post" id="form">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="form-label">Name</label>
                                                            <input type="text" name="txtname" id="txtname" class="form-control" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label">Address</label>
                                                            <input type="text" name="txtadd" id="txtadd" class="form-control" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label">Link Facebook</label>
                                                            <input type="" name="txtfac" id="txtfac" class="form-control" />
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="form-label">Link Twitter</label>
                                                            <input type="" name="txttwi" id="txttwi" class="form-control" />
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="form-label">Link IG</label>
                                                            <input type="" name="txtig" id="txtig" class="form-control" />
                                                        </div>

                                                        
                                                        <div class="form-group">
                                                            <label class="form-label">Link Youtube</label>
                                                            <input type="" name="txtyou" id="txtyou" class="form-control" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label">Description</label>
                                                            <input type="" name="txtdes" id="txtdes" class="form-control" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label">Phone</label>
                                                            <input type="" name="txtphone" id="txtphone" class="form-control" />
                                                        </div>

                                            
                                                        <div class="form-group">
                                                            <label class="form-label">Email</label>
                                                            <input type="Email" name="txtemail" id="txtemail" class="form-control" />
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" id="btnSave">Save</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
        <script type="text/javascript" src="js\footer.js"></script>
</body>