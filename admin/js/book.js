
function displayData(){
    $.ajax({
        url: 'book_json.php?data=get_book',
        type: 'GET',
        dataType: 'json',
        success: function (alldata){
            var columns = [
                {title: 'Id'},
                {title: 'Book Title'},
                {title: 'CategoryId'},
                {title: 'AuthorId'},
                {title: 'Status'},
                {title: 'Create_date'},
                {title: 'Action'}
            ];
            var data = [];
            var option = '';
            for(var i in alldata){
                option = "<i class='fa fa-pencil-square-o' data-toggle='modal' data-target='#Mymodal' onclick='editData(" +
                alldata[i][0] +
                ")'></i> | <i class='fa fa-trash' onclick='deleteData(" +
                alldata[i][0] + ")'></i> ";
                data.push([alldata[i][0], alldata[i][1], alldata[i][2], alldata[i][3], alldata[i][4],alldata[i][5], option]);
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
    setDataToSelect('#txtCategoryId', 'book_json.php?data=get_category', "--Category--");
});

$(document).ready(function(){
    displayData();
    setDataToSelect('#txtAuthor', 'book_json.php?data=get_author', "--Choose author--");
});

$(document).ready(function(){
    displayData();
    setDataToSelect('#txtStatus', 'book_json.php?data=get_status', "--Choose status--");
});



$('#btnAdd').click(function (){

    $("#txtTitle").val("");
    $("#txtCategoryId").val("");
    $("#txtAuthor").val("");
    $("#txtStatus").val("");
    $("#btnSave").text("Insert");
    
});

var book_id;
function editData(id){
    $("#btnSave").text("Update");
    book_id = id;

    $.ajax({
        url: 'book_json.php?data=get_byid',
        data: '&id=' + id,
        type: 'GET',
        dataType: 'json',
        success: function (data){
            $("#txtTitle").val(data[0][1]);
            $("#txtCategoryId").val(data[0][2]);
            $("#txtAuthor").val(data[0][3]);
            $("#txtStatus").val(data[0][4]);
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
            url: 'book_json.php?data=add_book',
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
            url: 'book_json.php?data=update_book&id=' + book_id,
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
            url: 'book_json.php?data=delete_book&id=' + id,
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


