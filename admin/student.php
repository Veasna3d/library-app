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
                    Student List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

                    <li class="active">Student</li>
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
                                                <h4 class="modal-title">Student Information</h4>
                                                <button type="button" class="close" data-dismiss="modal"><i
                                                        class="fas fa-closes"></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="post" id="form" enctype="multipart/form-data">

                                                <div class="form-group">
                                                        <label for="name">Student ID</label>
                                                        <input type="text" name="txtStudentId" id="txtStudentId"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Student Name</label>
                                                        <input type="text" name="txtStudentName" id="txtStudentName"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Password</label>
                                                        <input type="password" name="txtPassword" id="txtPassword"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="book" class="form-label">Class</label>
                                                        <select class="form-control" name="ddlClass" id="ddlClass"
                                                            required>
                                                            <option>--Choose---</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Phone</label>
                                                        <input type="text" name="txtPhone" id="txtPhone"
                                                            class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Email</label>
                                                        <input type="text" name="txtEmail" id="txtEmail"
                                                            class="form-control">
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
</body>
<?php include 'includes/scripts.php'; ?>


<script type="text/javascript" src="js\jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js\dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="js\student.js"></script>