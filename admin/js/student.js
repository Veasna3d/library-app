
function displayData(){
    $.ajax({
        url: 'student_json.php?data=get_student',
        type: 'GET',
        dataType: 'json',
        success: function (alldata){
            var columns = [
                {title: 'Id'},
                {title: 'Student ID'},
                {title: 'First Name'},
                {title: 'Last Name'},
                {title: 'Image'},
                {title: 'Class'},
                {title: 'Phone'},
                {title: 'Email'},
                {title: 'Create Date'},
                {title: 'Action'}
            ];
            var data = [];
            var option = '';
            for(var i in alldata){
                option = "<i class='fa fa-pencil-square-o' data-toggle='modal' data-target='#Mymodal' onclick='editData(" +
                alldata[i][0] +
                ")'></i> | <i class='fa fa-trash' onclick='deleteData(" +
                alldata[i][0] + ")'></i> ";
                data.push([alldata[i][0], alldata[i][1], alldata[i][2], alldata[i][3], alldata[i][4], alldata[i][5], alldata[i][6], alldata[i][7],alldata[i][8], option]);
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
    $("#txtFirstName").val("");
    $("#txtLastName").val("");
    $("#stuImage").val("");
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
        url: 'class_json.php?data=get_byid',
        data: '&id=' + id,
        type: 'GET',
        dataType: 'json',
        success: function (data){
            $("#txtStudentId").val(data[0][1]);
            $("#txtFirstName").val(data[0][2]);
            $("#txtLastName").val(data[0][3]);
            $("#stuImage").val(data[0][4]);
            $("#ddlClass").val(data[0][5]);
            $("#txtPhone").val(data[0][6]);
            $("#txtEmail").val(data[0][7]);
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
                $("#Mymodal").modal('hide');
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
                $("#Mymodal").modal('hide');
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


