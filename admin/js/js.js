
    	//displayData Function
      function displayData(){
          $.ajax({
              url: '../json/user_json.php?data=get_user',
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
		

