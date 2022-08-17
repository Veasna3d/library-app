
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
 
    <section class="content-header">
      <h1>
        User
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Transaction</li>
        <li class="active">User</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<h2>Bootstrap Modal Example06</h2>
		<table id="table_id" class="table table-striped"></table>
		<button type="button" id="btnadd" class="btn btn-success" data-toggle="modal" data-target="#myModal">
			AddNew
		</button>

		<!------Modal ---->
		<div class="modal" id="myModal">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<!---Modal Header----->
					<div class="modal-header">
						<h4 class="modal-title">User Management</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				

					<!----Modal body------>
					<div class="modal-body">
						<!---name------>
						<form method="post" id="form">
							<div class="from-group">
								<label for="txtname">Name:</label>
								<input type="text" class="form-control" id="txtname"  placeholder="Enter" name="txtname">
							</div>

							<!---phone------>
							<div class="from-group">
								<label for="txtpass">Password:</label>
								<input type="text" class="form-control" id="txtpass"  placeholder="Enter" name="txtpass">
							</div>

							<!---email------>
							<div class="from-group">
								<label for="txtemail">Email:</label>
								<input type="text" class="form-control" id="txtemail"  placeholder="Enter" name="txtemail">
							</div>
        
              	<!-- -User type----
							<div class="from-group">
								<label for="txtutype">User Type:</label>
								<select class="form-control" id="txtutype" name="txtutype"> 
                  <option>--choose--</option> 
                  <option value="1">Admin</option>
                  <option value="2">Editor</option>
                </select>
							</div> -->

              	<!---email------>
							<div class="from-group">
								<label for="txtutype">Email:</label>
								<input type="text" class="form-control" id="txtutype"  placeholder="Enter" name="txtutype">
							</div>

					<!---Modal footer----->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" id="btnSave">Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<form method="post" id="form">
					</div>

				</div>
			</div>
		</div>
    </section>   
  </div>
  </div>
    
  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
<script type="text/javascript" src="js\jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js\dataTables.bootstrap4.min.js"></script>
<script src="./js/js.js"></script>

