function displayData(){
    $.ajax({
        url: 'supplier_json.php?data=get_sup',
        type: 'GET',
        dataType: 'json',
        success: function (alldata){
            var columns = [
                {title: 'ID'},
                {title: 'STUDENT ID'},
                {title: 'STUDENT NAME'},
                {title: 'CLASS'},
                {title: 'CREATE DATE'},
                {title: 'ACTION'}
            ];
            var data = [];
            var option = '';
            for(var i in alldata){
                option = "<button class='btn btn-success btn-sm edit btn-flat' data-toggle='modal' data-target='#myModal' onclick='editData(" +
                alldata[i][0] +
                ")'><i class='fa fa-edit'></i> </button> | <button class='btn btn-danger btn-sm delete btn-flat' onclick='deleteData(" +
                alldata[i][0] + ")'><i class='fa fa-trash'></i> </button> ";
                data.push([alldata[i][0], alldata[i][1], alldata[i][2], alldata[i][3], alldata[i][4], option]);
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

// function setDataToSelect(myselect, myjson, caption){
//     try{
//         var sel = $(myselect);
//         sel.empty();
//         sel.append('<option value="">' + caption + '</option>');
//         $.ajax({
//             url: myjson,
//             dataType: 'json',
//             success: function (s){
//                 for(var i = 0; i < s.length; i++){
//                     sel.append('<option value="' + s[i][0] + '">'+ s[i][1] + '</option>');
//                 }
                
//             }, error: function (e){
//                 console.log(e.responseText);
//             }
//         });
//     }catch(err){
//         console.log(err.message);
//     }
// }

$(document).ready(function(){
    displayData();
    // setDataToSelect('#ddlClass', 'class_json.php?data=get_class', "--Class--");
});

$('#btnAdd').click(function (){
    $("#txtname").val("");
    $("#txtcon").val("");
    $("#txtadd").val("");
    $("#btnSave").text("Insert");
    
});

var student_id;
function editData(id){
    $("#btnSave").text("Update");
    student_id = id;

    $.ajax({
        url: 'supplier_json.php?data=get_byid',
        data: '&id=' + id,
        type: 'GET',
        dataType: 'json',
        success: function (data){
            $("#txtname").val(data[0][1]);
            $("#txtcon").val(data[0][2]);
            $("#txtadd").val(data[0][3]);
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
            url: 'supplier_json.php?data=add_sup',
            data: form_data,
            dataType: 'json',
            success: function (data){
                toastr.success("Action completed").css("margin-top", "2rem");
                // alert(data);
                displayData();
                clear();
                // $("#myModal").modal('hide');
            },
            error: function (ex){
                toastr.error("Action incomplete").css("margin-top", "2rem");
                console.log(ex.responseText);
            }
        });
    }else{
        //Update
        $.ajax({
            type: 'POST',
            url: 'supplier_json.php?data=update_sup&id=' + student_id,
            data: form_data,
            dataType: 'json',
            success: function (data){
                // alert(data);
                toastr.success("Action completed").css("margin-top", "2rem");
                displayData();
                $("#myModal").modal('hide');
            },
            error: function (ex){
                toastr.error("Action incomplete").css("margin-top", "2rem");
                console.log(ex.responseText);
            }
        });
    }
});

function deleteData(id){
    if(confirm('Are you sure?')){
        $.ajax({
            type: 'GET',
            url: 'supplier_json.php?data=delete_sup&id=' + id,
            dataType: 'json',
            success: function (data){
                // alert(data);
                toastr.success("Action completed").css("margin-top", "2rem");
                displayData();
            },
            error: function (ex){
                toastr.error("Action incomplete").css("margin-top", "2rem");
                console.log(ex.responseText);
            }
        });
    }
}
  
function clear(){
    $("#txtname").val("");
    $("#txtcon").val("");
    $("#txtadd").val("");
}