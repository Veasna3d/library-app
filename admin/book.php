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
                    <li>Book</li>
                    <li class="active">Book</li>
                </ol>
            </section>

            <div class="col-md-12">
                <div class="content-panel" style="padding-top: 10px;">
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: start;">
                            <div>
                                <button type="button" id="btnAdd" class="btn btn-primary" data-toggle="modal"
                                    data-target="#Mymodal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                                    New</button>
                                <button type="button" id="btnAdd" class="btn btn-success">
                                    <i class="fa fa-download" aria-hidden="true"></i> Import
                                </button>
                                <button type="button" id="btnAdd" class="btn btn-info">
                                    <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export
                                </button>
                            </div>
                            <div>
                                <select id="filter" class="form-control" aria-label="Default select example">
                                    <option selected>Filter by status</option>
                                    <option value="1">Available</option>
                                    <option value="2">Unavailable</option>
                                </select>
                            </div>

                        </div>
                        <div class="card-body">
                            <table data-ordering="false" id="table_id"
                                class="table table-hover d-flex justify-content-between">
                                <div class="modal" id="Mymodal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Book Info</h4>
                                                <button type="button" class="close" data-dismiss="modal"><i
                                                        class="fas fa-closes"></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="post" id="form">
                                                    <div class="form-group">
                                                        <label for="name">Book Title</label>
                                                        <input type="text" name="txtTitle" id="txtTitle"
                                                            class="form-control" placeholder="book_title">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="category">Category</label>
                                                        <select class="form-control" name="txtCategoryId"
                                                            id="txtCategoryId">
                                                            <option>--Choose---</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="author">Author</label>
                                                        <select class="form-control" name="txtAuthor" id="txtAuthor">
                                                            <option> choose author </option>
                                                        </select>
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
        <script type="text/javascript" src="js\book.js"></script>

</body>