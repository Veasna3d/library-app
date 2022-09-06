
function displayData(){
    $.ajax({
        url: 'borrow_json.php?data=get_borrow',
        type: 'GET',
        dataType: 'json',
        success: function (alldata){
            var columns = [
                {title: 'Id'},
                {title: 'Book Title'},
                {title: 'Student Name'},
                {title: 'Borrow Date'},
                {title: 'Return Date'},
                {title: 'Status'},
                {title: 'Remark'},
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
                data.push([alldata[i][0], alldata[i][1], alldata[i][2], alldata[i][3], alldata[i][4], "<span class='badge bg-waring text-dark'>" +alldata[i][5]+"</span>", alldata[i][6], alldata[i][7], option]);
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
    setDataToSelect('#txtBookId', 'borrow_json.php?data=get_book', "--Book--");
    setDataToSelect('#txtStudentId', 'borrow_json.php?data=get_student', "--Student--");
});

$('#btnAdd').click(function (){

    $("#txtBookId").val("");
    $("#txtStudentId").val("");
    $("#txtBorrow").val("");
    $("#txtReturn").val("");
    $("#txtStatus").val("");
    $("#txtRemark").val("");
    $("#btnSave").text("Insert");
    
});

var borrow_id;
function editData(id){
    $("#btnSave").text("Update");
    borrow_id = id;

    $.ajax({
        url: 'borrow_json.php?data=get_byid',
        data: '&id=' + id,
        type: 'GET',
        dataType: 'json',
        success: function (data){
            $("#txtBookId").val(data[0][1]);
            $("#txtStudentId").val(data[0][2]);
            $("#txtBorrow").val(data[0][3]);
            $("#txtReturn").val(data[0][4]);
            $("#txtStatus").val(data[0][5]);
            $("#txtRemark").val(data[0][6]);
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
            url: 'borrow_json.php?data=add_borrow',
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
            url: 'borrow_json.php?data=update_borrow&id=' + borrow_id,
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
            url: 'borrow_json.php?data=delete_borrow&id=' + id,
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


