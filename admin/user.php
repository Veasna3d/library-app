<?php  
  session_start();
  include('config/db.php');
 
  if( !isset($_SESSION["username"])){
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
                    User Management
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>User</li>
                    <li class="active">User</li>
                </ol>
            </section>

            <div class="col-md-12">
                <div class="content-panel" style="padding-top: 10px;">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" id="btnadd" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> AddNew
                            </button>
                        </div>
                        <div class="card-body">
                            <table data-ordering="false" id="table_id" class="table table-hover d-flex justify-content-between">
                                                                  
                                <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Author Info</h4>
                                                <button type="button" class="close" data-dismiss="modal"><i
                                                        class="fas fa-closes"></i></button>
                                            </div>

                                                <!----Modal body------>
                                            <div class="modal-body">
                                                <!---name------>
                                                <form method="post" id="form"  enctype="multipart/form-data">
                                                    <div class="from-group">
                                                        <label for="txtname">Name:</label>
                                                        <input type="text" class="form-control" id="txtname" placeholder="Enter" name="txtname" required>
                                                    </div>

                                                    <!---phone------>
                                                    <div class="from-group">
                                                        <label for="txtpass">Password:</label>
                                                        <input type="text" class="form-control" id="txtpass"  placeholder="Enter" name="txtpass"  required>
                                                    </div>

                                                    <!---email------>
                                                    <div class="from-group">
                                                        <label for="txtemail">Email:</label>
                                                        <input type="text" class="form-control" id="txtemail"  placeholder="Enter" name="txtemail" required>
                                                    </div>
                                
                                                    <!---img------>
                                                    <!-- <div class="from-group">
                                                        <label for="txtimg">Image:</label>
                                                        <input type="text" class="form-control" id="txtimg"  placeholder="Enter" name="txtimg" required>
                                                    </div> -->

                                                    <!-- <div class="from-group">
                                                        <label for="picture">Picture</label>
                                                        <img scr="" id="picture" name="picture" width="80px" height="80px">
                                                        <input type="file" id="myfile" name="myfile" onchange="showimg()">  
                                                    </div>  -->

                                                    <!-- -User type---- -->
                                                    <div class="from-group">
                                                        <label for="txtutype">User Type:</label>
                                                            <select class="form-control" id="txtutype" name="txtutype" required> 
                                                                <option>--choose--</option> 
                                                                <option value="Admin">Admin</option>
                                                                <option value="Editor">Editor</option>
                                                            </select>
                                                    </div>

                                                    <!-- -User type----
                                                    <div class="from-group">
                                                        <label for="txtutype">User type:</label>
                                                        <input type="text" class="form-control" id="txtutype"  placeholder="Enter" name="txtutype" required>
                                                    </div> -->
                                                    
                                                        <!---Verify password------>
                                                    <div class="from-group">
                                                        <label for="txtverify">verify Password:</label>
                                                        <input type="text" class="form-control" id="txtverify"  placeholder="Enter" name="txtverify" required>
                                                    </div>
                                                    

                                            <!---Modal footer----->
                                            <div class="modal-footer"> 
                                            <button type="button" class="btn btn-secondary" id="btnSave" >Save</button>
                                                <button type="button" class="btn btn-danger" id="btnclose" data-dismiss="modal">Close</button>
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
        <script type="text/javascript" src="js\user.js"></script>
        <script src="js/toastr.min.js"></script>
</body>