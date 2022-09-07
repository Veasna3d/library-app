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
                    <li>Student</li>
                    <li class="active">Student List</li>
                </ol>
            </section>

            <div class="col-md-12">
                <div class="content-panel" style="padding-top: 10px;">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" id="btnAdd" class="btn btn-primary" data-toggle="modal"
                                data-target="#myModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                                New</button>
                        </div>
                        <div class="card-body">
                            <table id="table_id" class="table table-hover d-flex justify-content-between">
                                <hr>
                                <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Student Info</h4>
                                                <button type="button" class="close" data-dismiss="modal"><i
                                                        class="fas fa-closes"></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="post" id="form">

                                                    <div class="form-group">
                                                        <label for="studentid" class="form-label">Student ID</label>
                                                        <input type="text" name="txtStudentId" id="txtStudentId"
                                                            class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="firstname" class="form-label">First Name</label>
                                                        <input type="text" name="txtFirstName" id="txtFirstName"
                                                            class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="lastname" class="form-label">Last Name</label>
                                                        <input type="text" name="txtLastName" id="txtLastName"
                                                            class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="image" class="form-label">Image</label>
                                                        <input type="file" name="stuImage" id="stuImage"
                                                            class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="book" class="form-label">Class</label>
                                                        <select class="form-control" name="ddlClass"
                                                            id="ddlClass">
                                                            <option>--Choose---</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="phone" class="form-label">Phone</label>
                                                        <input type="text" name="txtPhone" id="txtPhone"
                                                            class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" name="txtEmail" id="txtEmail"
                                                            class="form-control">
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
        <script type="text/javascript" src="js\student.js"></script>
</body>