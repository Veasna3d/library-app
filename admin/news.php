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
                    News List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    
                    <li class="active">News</li>
                </ol>
            </section>

            <div class="col-md-12">
                <div class="content-panel" style="padding-top: 10px;">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal"
                                class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                Add
                                New</button>
                        </div>
                        <div id="image_data">
                            <div class="card-body">
                                <table id="user_data" class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th width="10%">ID</th>
                                            <th width="20%">SUB TITLE</th>
                                            <th width="20%">DESCRIPTION</th>
                                            <th width="20%">IMAGE</th>
                                            <th width="10%">EDIT</th>
                                            <th width="10%">DELETE</th>
                                        </tr>
                                    </thead>
                                </table>

                                <div id="userModal" class="modal fade">
                                    <div class="modal-dialog">
                                        <form method="post" id="user_form" enctype="multipart/form-data">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add News</h4>
                                                    <!-- <button type="button" class="btn-close" data-dismiss="modal"
                                                        aria-label="Close"></button> -->
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="form-label">Sub Title</label>
                                                        <input type="text" name="first_name" id="first_name"
                                                            class="form-control" />
                                                    </div>
                                            
                                                    <div class="form-group">
                                                        <label class="form-label">Description</label>
                                                        <input type="text" name="last_name" id="last_name"
                                                            class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label">Image</label>
                                                        <input type="file" name="user_image" id="user_image"
                                                            class="form-control">
                                                        <span id="user_uploaded_image"></span>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="user_id" id="user_id" />
                                                    <input type="hidden" name="operation" id="operation" />
                                                    <input type="submit" name="action" id="action"
                                                        class="btn btn-success" value="Add" />
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <?php include 'includes/scripts.php'; ?>


            <script type="text/javascript" src="js\jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="js\dataTables.bootstrap4.min.js"></script>
            <!-- <script type="text/javascript" src="js\class.js"></script> -->
</body>

<script type="text/javascript" language="javascript">
$(document).ready(function() {
    $('#add_button').click(function() {
        $('#user_form')[0].reset();
        $('.modal-title').text("Add News");
        $('#action').val("Add");
        $('#operation').val("Add");
        $('#user_uploaded_image').html('');
    });

    var dataTable = $('#user_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "fetch.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 3, 4],
            "orderable": false,
        }, ],
    });
    $(document).on('submit', '#user_form', function(event) {
        event.preventDefault();
        var firstName = $('#first_name').val();
        var lastName = $('#last_name').val();
        var extension = $('#user_image').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
                $('#user_image').val('');
                return false;
            }
        }
        if (firstName != '' && lastName != '') {
            $.ajax({
                url: "insert.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    alert(data);
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        } else {
            alert("Both Fields are Required");
        }
    });

    $(document).on('click', '.update', function() {
        var user_id = $(this).attr("id");
        $.ajax({
            url: "fetch_single.php",
            method: "POST",
            data: {
                user_id: user_id
            },
            dataType: "json",
            success: function(data) {
                $('#userModal').modal('show');
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('.modal-title').text("Edit User");
                $('#user_id').val(user_id);
                $('#user_uploaded_image').html(data.user_image);
                $('#action').val("Edit");
                $('#operation').val("Edit");
            }
        })
    });

    $(document).on('click', '.delete', function() {
        var user_id = $(this).attr("id");
        if (confirm("Are you sure you want to delete this?")) {
            $.ajax({
                url: "delete.php",
                method: "POST",
                data: {
                    user_id: user_id
                },
                success: function(data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        } else {
            return false;
        }
    });
});
</script>