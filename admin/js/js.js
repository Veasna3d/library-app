
    	//displayData Function
      function displayData(){
        $.ajax({
            url: 'user_json.php?data=get_user',
            type:'GET',
            dataType : 'json',
            success:function(alldata){   
              var columns = [{ title: "Id"},{ title: "Username"},{ title: "Password"}, { title: "Email"},{ title: "Image"},  { title: "User_type" }, { title: "User_ip" }, { title: "Verify_password" }, { title: "option"}];
              var data = [];
              var option= '';
              for ( var i in alldata ) {
                option = "<i class='fa fa-pencil-square-o' data-toggle='modal' data-target='#myModal' onclick='editData(" +
                alldata[i][0] +
                ")'></i> | <i class='fa fa-trash' onclick='deleteData(" +
                alldata[i][0] + ")'></i> ";
                data.push([alldata[i][0], alldata[i][1],alldata[i][2],alldata[i][3],alldata[i][4], alldata[i][5], alldata[i][6], alldata[i][7],  option]);
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
          alert("yes");
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
          $('#txtimg').val("");	
          $('#txtutype').val("");	
          $('#txtuip').val("");	
          $('#txtverify').val("");	
          $('#btnSave').text("Insert");	
        });

        var user_id;
        function editData(Id){
          $('#btnSave').text("update")
          user_id = Id;
          $.ajax({
            url: 'user_json.php?data=get_byid',
            data: '&Id=' + Id,
            type:'GET',
            dataType : 'json',
            success:function(data){   
              $('#txtname').val(data[0][1]);
              $('#txtpass').val(data[0][2]);
              $('#txtemail').val(data[0][3]);
              $('#tximg').val(data[0][4]);
              $('#txtutype').val(data[0][5]);
              $('#txtuip').val(data[0][6]);
              $('#txtverify').val(data[0][7]);
            },
            error: function (ex){
              console.log(ex.responseText);
            }
          });//ajax
        }

        function deleteData(Id){
          //confirm delate
          if (confirm('Are you sure?')) {
            $.ajax({
            type:'GET',
            url: 'user_json.php?data=delete_user&Id=' + Id,	
            dataType : 'json',
            success:function(data){   
              alert(data);
              displayData();
            },
            error: function (ex){
              console.log(ex.responseText);
          }
        });//ajax
          }
      }



       

