function displayData(){
    $.ajax({
        url: 'footer_json.php?data=get_brand',
        type: 'GET',
        dataType: 'json',
        success: function (alldata){
            var columns = [
                {title: 'ID'},
                {title: 'NAME'},
                {title: 'FACEBOOK'},
                {title: 'INSTAGRAM'},
                {title: 'TWITTER'},
                {title: 'YOUYUBE'},
                {title: 'DESCRIPTION'},
                {title: 'PHONE'},
                {title: 'EMAIL'},
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
                data.push([alldata[i][0], alldata[i][1], alldata[i][2], alldata[i][3], alldata[i][4],alldata[i][5],alldata[i][6],alldata[i][7],alldata[i][8],alldata[i][9], option]);
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
    $("#txtadd").val("");
    $("#txtfac").val("");
    $("#txtig").val("");
    $("#txttwi").val("");
    $("#txtyou").val("");
    $("#txtdes").val("");
    $("#txtphone").val("");
    $("#txtemail").val("");
    $("#btnSave").text("Insert");
    
});

var student_id;
function editData(id){
    $("#btnSave").text("Update");
    student_id = id;
    $.ajax({
        url: 'footer_json.php?data=get_byid',
        data: '&id=' + id,
        type: 'GET',
        dataType: 'json',
        success: function (data){
            $("#txtname").val(data[0][1]);
            $("#txtadd").val(data[0][2]);
            $("#txtfac").val(data[0][3]);
            $("#txtig").val(data[0][4]);
            $("#txttwi").val(data[0][5]);
            $("#txtyou").val(data[0][6]);
            $("#txtdes").val(data[0][7]);
            $("#txtphone").val(data[0][8]);
            $("#txtemail").val(data[0][9]);
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
            url: 'footer_json.php?data=add_brand',
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
            url: 'footer_json.php?data=update_brand&id=' + student_id,
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
            url: 'footer_json.php?data=delete_brand&id=' + id,
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
    $("#txtadd").val("");
    $("#txtfac").val("");
    $("#txtig").val("");
    $("#txttwi").val("");
    $("#txtyou").val("");
    $("#txtdes").val("");
    $("#txtphone").val("");
    $("#txtemail").val("");
}