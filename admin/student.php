<?php include 'includes/header.php'; ?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>
        <?php include 'student_json.php'; ?>
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
                                <button type="button" data-toggle="modal" data-target="#myImport" id="btnAdd"
                                    class="btn btn-success">
                                    <i class="fa fa-download" aria-hidden="true"></i> Import
                                </button>
                                <a href="exportData.php" id="btnAdd" class="btn btn-primary"> <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</a>

                                
                        </div>
                        <div class="card-body">
                            <table data-ordering="false" id="table_id" class="table table-hover d-flex justify-content-between">
                                
                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Student Info</h4>
                                                <button type="button" class="close" data-dismiss="modal"><i
                                                        class="fas fa-closes"></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="post" id="form" enctype="multipart/form-data">

                                                    <div class="form-group">
                                                        <label for="studentid" class="form-label">Student ID</label>
                                                        <input type="text" name="txtStudentId" id="txtStudentId"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="fullname" class="form-label">Student Name</label>
                                                        <input type="text" name="txtStudentName" id="txtStudentName"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="chooseFile">Image</label>
                                                        <input type="file" name="fileUpload" class="form-control" id="chooseFile">
                                                        

                                                        <div class="user-image mb-3 text-center">
                                                            <div style="width: 100%; height: 200px; overflow: hidden; background: #cccccc;">
                                                                <img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="book" class="form-label">Class</label>
                                                        <select class="form-control" name="ddlClass" id="ddlClass" required>
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

                                <div class="modal" id="myImport">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Import</h4>
                                                <button type="button" class="close" data-dismiss="modal"><i
                                                        class="fas fa-closes"></i></button>
                                            </div>

                                            <div class="modal-body">

                                                <form method="POST" action="importBook.php"
                                                    enctype="multipart/form-data" id="upload_csv_form">
                                                    <div class="form-group">
                                                        <label class="form-label">Choose file</label>
                                                        <input type="file" name="file" class="form-control">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" name="submit"
                                                            class="btn btn-success">Upload</button>
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
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imgPlaceholder').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
            $("#chooseFile").change(function () {
                readURL(this);
            });
        </script>
</body>