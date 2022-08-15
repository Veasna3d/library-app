
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
<script>
    	//displayData Function
      function displayData(){
          $.ajax({
              url: 'user_json.php?data=get_user',
              type:'GET',
              dataType : 'json',
              success:function(alldata){   
                var columns = [{ title: "Id"},{ title: "Username"}, { title : "Password"}, { title: "Email"}, { title: "User_type" }, { title: "User_ip" }, { title: "Verify_password" }, { title: "Timelogin" }, { title: "option"}];
                var data = [];
                var option= '';
                for ( var i in alldata ) {
                  option = "<input type='button' class='btn btn-info' value='Edit' data-toggle='modal' data-target='#myModal' onclick='editData("+ alldata[i][0] + ")'> | <input type='button' class='btn btn-danger' value='Delete' onclick='deleteData("+ alldata[i][0] + ")'>";
                  data.push([alldata[i][0], alldata[i][1], alldata[i][2], alldata[i][3],alldata[i][4], alldata[i][5], alldata[i][6],alldata[i][7], option]);
                }
                console.log(data);
                $('#table_id').DataTable({
                  destroy : true,
                  data : data,
                  columns: columns
                });
              },
              error: function (ex){
                console.log(ex.responseText);
              }
            });//ajax
		}
  //Query load
	$(document).ready(function(){
		displayData();
	});
      	/* save button */
	$('#btnSave').click(function(){
        var form_data = $('#form').serialize();
        if($('#btnSave').text()=="Insert"){
            //Insert
            $.ajax({
                type: 'POST',
                url: 'user_json.php?data=add_user',
                data: form_data,
                dataType: 'json',
                success: function (data){
                    alert(data);
                    displayData();
                    $('#myModal').modal('hide');
                },
                error: function (ex){
                    console.log(ex.responseText);
                }
            });
        }else{
            //Update
            $.ajax({
                type: 'POST',
                url: 'user_json.php?data=update_user&Id='+ user_id,
                data: form_data,
                dataType: 'json',
                success: function (data){
                    alert(data);
                    displayData();
                    $('#myModal').modal('hide');
                },
                error: function (ex){
                    console.log(ex.responseText);
                }
            });
        }
    });

        	//Add botton 
          $('#btnadd').click(function(){
            $('#txtname').val("");
            $('#txtpass').val("");	
            $('#txtemail').val("");	
            $('#txtutype').val("");	
            $('#btnSave').text("Insert");	
          });

		var user_id;
		
</script>
