
//displayData Function
function displayData(){
  $.ajax({
      url: 'user_json.php?data=get_user',
      type:'GET',
      dataType : 'json',
      success:function(alldata){   
        var columns = [{ title: "ID"},
        { title: "USERNAME"},
        { title: "PASSWROD"}, 
        { title: "IMAGE"}, 
        { title: "EMAIL" },  
        { title: "ACTION"}];
        var data = [];
        var option= '';
        for ( var i in alldata ) {
          option = "<i class='fa fa-pencil-square-o' data-toggle='modal' data-target='#myModal' onclick='editData(" +
          alldata[i][0] +
          ")'></i> | <i class='fa fa-trash' onclick='deleteData(" +
          alldata[i][0] + ")'></i> ";
          data.push([alldata[i][0], alldata[i][1],alldata[i][2],alldata[i][3],alldata[i][4], option]);
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
// var name = $('#txtname');
// var pass = $('#txtpass');
// var email = $('#txtemail');
// var type = $('#txtutype');
// var verify = $('#txtverify');
// if(name.val()==''){name.focus(); return;}
// if(pass.val()==''){pass.focus(); return;}
// if(email.val()==''){email.focus(); return;}
// if(type.val()==''){type.focus();return;}
// if(verify.val()==''){verify.focus();return;}
var form_data = $('#form').serialize();
if($('#btnSave').text()=="Insert"){
    //Insert
    $.ajax({
        type: 'POST',
        url: 'user_json.php?data=add_user',
        data: form_data,
        dataType: 'json',
        beforeSend:function(){

        },
        success: function (data){
            // alert(data);
            toastr.success("Success message!").css("margin-top", "94px");
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
        url: 'user_json.php?data=update_user&id='+ user_id,
        data: form_data,
        dataType: 'json',
        success: function (data){
            // alert(data);
            toastr.success("Update Success!").css("margin-top", "94px");
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
    $('#txtverify').val("");  
    $('#btnSave').text("Insert"); 
  });

  var user_id;
  function editData(id){
    $('#btnSave').text("update")
    user_id = id;
    $.ajax({
      url: 'user_json.php?data=get_byid',
      data: '&id=' + id,
      type:'GET',
      dataType : 'json',
      success:function(data){   
        $('#txtname').val(data[0][1]);
        $('#txtpass').val(data[0][2]);
        $('#txtemail').val(data[0][3]);
        $('#txtutype').val(data[0][4]);
        $('#txtverify').val(data[0][5]);
      },
      error: function (ex){
        console.log(ex.responseText);
      }
    });//ajax
  }

  function deleteData(id){
    //confirm delate
    if (confirm('Are you sure?')) {
      $.ajax({
      type:'GET',
      url: 'user_json.php?data=delete_user&id=' + id, 
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

