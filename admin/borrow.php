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
                    Borrow & Return
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Transaction</li>
                    <li class="active">Borrow</li>
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
                            <table data-ordering="false" id="table_id" class="table table-hover d-flex justify-content-between">
                                <hr>
                                <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Borrow & Return Info</h4>
                                                <button type="button" class="close" data-dismiss="modal"><i
                                                        class="fas fa-closes"></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="post" id="form">
                                                    <div class="form-group">
                                                        <label for="book" class="form-label">Book</label>
                                                        <select class="form-control" name="txtBookId"
                                                            id="txtBookId">
                                                            <option>--Choose---</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="category" class="form-label">Student</label>
                                                        <select class="form-control" name="txtStudentId"
                                                            id="txtStudentId">
                                                            <option>--Choose---</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="form-label">Borrow Date</label>
                                                        <input type="date" name="txtBorrow" id="txtBorrow"
                                                            class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="form-label">Return Date</label>
                                                        <input type="date" name="txtReturn" id="txtReturn"
                                                            class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select class="form-control" name="txtStatus"
                                                            id="txtStatus">
                                                            <option>--Choose---</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="remark" class="form-label">Remark</label>
                                                        <textarea class="form-control" id="txtRemark" name="txtRemark"></textarea>   
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
        <script type="text/javascript" src="js\borrow.js"></script>
</body>