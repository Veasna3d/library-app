
function displayData() {
    $.ajax({
        url: 'class_json.php?data=get_class',
        type: 'GET',
        dataType: 'json',
        success: function(alldata) {
            var columns = [{
                title: "ID"
            }, {
                title: "CLASS NAME"
            },{
                title: "CREATE DATE"
            }, {
                title: "ACTION"
            }];
            var data = [];
            var option = '';
            for (var i in alldata) {
                option = "<button class='btn btn-success btn-sm edit btn-flat' data-toggle='modal' data-target='#myModal' onclick='editData(" +
                alldata[i][0] +
                ")'><i class='fa fa-edit'></i> </button> | <button class='btn btn-danger btn-sm delete btn-flat' onclick='deleteData(" +
                alldata[i][0] + ")'><i class='fa fa-trash'></i> </button> ";
                data.push([alldata[i][0],alldata[i][1],alldata[i][2], option]);
            }
            console.log(data);
            $('#table_id').DataTable({
                destroy: true,
                data: data,
                columns: columns
            });
        },
        error: function(e) {
            console.log(e.responseText);
        }
    });
}

//Load
$(document).ready(function() {
    displayData();
})

//btnSave
$('#btnSave').click(function() {
    var author = $('#txtName');
    if(author.val() == ""){
        author.focus();
        return  toastr.warning("Field Require!").css("margin-top", "2rem");
    }
    var form_data = $('#form').serialize();
    if ($('#btnSave').text() == "Insert") {
        //Insert
        $.ajax({
            type: 'POST',
            url: 'class_json.php?data=add_class',
            data: form_data,
            dataType: 'json',
            success: function(data) {

                toastr.success("Action completed").css("margin-top", "2rem");
                // alert(data);
                displayData();
                $('#myModal').modal('hide');
            },
            error: function(ex) {
                toastr.error("Action incomplete").css("margin-top", "2rem");
                console.log(ex.responseText);
            }
        });
    } else {
        //Update
        $.ajax({
            type: 'POST',
            url: 'class_json.php?data=update_class&id=' + class_id,
            data: form_data,
            dataType: 'json',
            success: function(data) {
                toastr.success("Action completed").css("margin-top", "2rem");
                // alert(data);
                displayData();
                $('#myModal').modal('hide');
            },
            error: function(ex) {
                toastr.error("Action incomplete").css("margin-top", "2rem");
                console.log(ex.responseText);
            }
        });
    }
});

$('#btnAdd').click(function() {
    $('#txtName').val("");
    $('#btnSave').text("Insert");
});

var class_id;

function editData(id) {
    $('#btnSave').text("Update");
    class_id = id;
    $.ajax({
        url: 'class_json.php?data=get_byid',
        data: '&id=' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#txtName').val(data[0][1]);
        },
        error: function(ex) {
            console.log(ex.responseText);
        }
    });
}

function deleteData(id) {
    if (confirm('Are you sure')) {
        $.ajax({
            type: 'GET',
            url: 'class_json.php?data=delete_class&id=' + id,
            dataType: 'json',
            success: function(data) {
                toastr.success("Action completed").css("margin-top", "2rem");
                // alert(data);
                displayData();
            },
            error: function(ex) {
                toastr.error("Action incomplete").css("margin-top", "2rem");
                console.log(ex.responseText);
            }
        });
    }
}