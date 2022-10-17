
function displayData(){
    $.ajax({
        url: 'student_json.php?data=get_student',
        type: 'GET',
        dataType: 'json',
        success: function (alldata){
            var columns = [
                {title: 'ID'},
                {title: 'STUDENT ID'},
                {title: 'STUDENT NAME'},
                {title: 'CLASS'},
                {title: 'PHONE'},
                {title: 'EMAIL'},
                {title: 'CREATE DATE'},
                {title: 'ACTION'}
            ];
            var data = [];
            var option = '';
            for(var i in alldata){
                option = "<i class='fa fa-pencil-square-o' data-toggle='modal' data-target='#myModal' onclick='editData(" +
                alldata[i][0] +
                ")'></i> | <i class='fa fa-trash' onclick='deleteData(" +
                alldata[i][0] + ")'></i> ";
                data.push([alldata[i][0], alldata[i][1], alldata[i][2], alldata[i][3], alldata[i][4], alldata[i][5], alldata[i][6], option]);
            }
            console.log(data);
            $('#table_id').DataTable({
                destroy: true,
                data: data,
                columns: columns
            });
        },
        error: function (e){
            console.log(e.responseText);
        }
    });
}

function setDataToSelect(myselect, myjson, caption){
    try{
        var sel = $(myselect);
        sel.empty();
        sel.append('<option value="">' + caption + '</option>');
        $.ajax({
            url: myjson,
            dataType: 'json',
            success: function (s){
                for(var i = 0; i < s.length; i++){
                    sel.append('<option value="' + s[i][0] + '">'+ s[i][1] + '</option>');
                }
                
            }, error: function (e){
                console.log(e.responseText);
            }
        });
    }catch(err){
        console.log(err.message);
    }
}

$(document).ready(function(){
    displayData();
    setDataToSelect('#ddlClass', 'class_json.php?data=get_class', "--Class--");
});

$('#btnAdd').click(function (){

    $("#txtStudentId").val("");
    $("#txtStudentName").val("");
    $("#ddlClass").val("");
    $("#txtPhone").val("");
    $("#txtEmail").val("");
    $("#btnSave").text("Insert");
    
});

var student_id;
function editData(id){
    $("#btnSave").text("Update");
    student_id = id;

    $.ajax({
        url: 'student_json.php?data=get_byid',
        data: '&id=' + id,
        type: 'GET',
        dataType: 'json',
        success: function (data){
            $("#txtStudentId").val(data[0][1]);
            $("#txtStudentName").val(data[0][2]);
            $("#ddlClass").val(data[0][3]);
            $("#txtPhone").val(data[0][4]);
            $("#txtEmail").val(data[0][5]);
        },
        error: function (ex){
            console.log(ex.responseText);
        }
    });
}

$("#btnSave").click(function (){
    var form_data = $("#form").serialize();
    if($("#btnSave").text() == "Insert"){
        //Insert
        $.ajax({
            type: 'POST',
            url: 'student_json.php?data=add_student',
            data: form_data,
            dataType: 'json',
            success: function (data){
                alert(data);
                displayData();
                $("#myModal").modal('hide');
            },
            error: function (ex){
                console.log(ex.responseText);
            }
        });
    }else{
        //Update
        $.ajax({
            type: 'POST',
            url: 'student_json.php?data=update_student&id=' + student_id,
            data: form_data,
            dataType: 'json',
            success: function (data){
                alert(data);
                displayData();
                $("#myModal").modal('hide');
            },
            error: function (ex){
                console.log(ex.responseText);
            }
        });
    }
});

function deleteData(id){
    if(confirm('Are you sure?')){
        $.ajax({
            type: 'GET',
            url: 'student_json.php?data=delete_student&id=' + id,
            dataType: 'json',
            success: function (data){
                alert(data);
                displayData();
            },
            error: function (ex){
                console.log(ex.responseText);
            }
        });
    }
}
  
    
$(document).ready(function(){  
    $('#upload_csv_form').on("submit", function(e){  
         e.preventDefault(); //form will not submitted  
         $.ajax({  
              url:"importData.php",  
              method:"POST",  
              data:new FormData(this),  
              contentType:false,          // The content type used when sending data to the server.  
              cache:false,                // To unable request pages to be cached  
              processData:false,          // To send DOMDocument or non processed data file it is set to false  
              success: function(data){  
                   if(data=='Error1')  
                   {  
                        alert("Invalid File");  
                   }  
                   else if(data == "Error2")  
                   {  
                        alert("Please Select File");  
                   }                           
                   else if(data == "Success")  
                   {  
                      alert("CSV file data has been imported");  
                      $('#upload_csv_form')[0].reset();
                      // alert(data);
                      displayData();
                      //  $('#table_id').html(data); 
                   }  
                   else  
                   {  
                       // $('#employee_table').html(data);  
                   }  
              }  
         })  
    });  
});  