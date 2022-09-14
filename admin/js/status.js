
function displayData() {
    $.ajax({
        url: 'status_json.php?data=get_status',
        type: 'GET',
        dataType: 'json',
        success: function(alldata) {
            var columns = [{
                title: "Id"
            }, {
                title: "Status"
            },{
                title: "Create_date"
            }, {
                title: "Action"
            }];
            var data = [];
            var option = '';
            for (var i in alldata) {
                option =
                    "<i class='fa fa-pencil-square-o' data-toggle='modal' data-target='#myModal' onclick='editData(" +
                    alldata[i][0] +
                    ")'></i> | <i class='fa fa-trash' onclick='deleteData(" +
                    alldata[i][0] + ")'></i> ";
                data.push([alldata[i][0], alldata[i][1],alldata[i][2], option]);
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

// Load
$(document).ready(function() {
    displayData();
})

//btnSave
$('#btnSave').click(function() {
    var form_data = $('#form').serialize();
    if ($('#btnSave').text() == "Insert") {
        //Insert
        $.ajax({
            type: 'POST',
            url: 'status_json.php?data=add_status',
            data: form_data,
            dataType: 'json',
            success: function(data) {
                alert(data);
                displayData();
                $('#myModal').modal('hide');
            },
            error: function(ex) {
                console.log(ex.responseText);
            }
        });
    } else {
        
        //Update
        $.ajax({
            type: 'POST',
            url: 'status_json.php?data=update_status&id=' + status_id,
            data: form_data,
            dataType: 'json',
            success: function(data) {
                alert(data);
                displayData();
                $('#myModal').modal('hide');
            },
            error: function(ex) {
                console.log(ex.responseText);
            }
        });
    }
});

$('#btnAdd').click(function() {
    $('#txtName').val();
    $('#btnSave').text("Insert");
});

var status_id;

function editData(id) {
    $('#btnSave').text("Update");
    status_id = id;
    $.ajax({
        url: 'status_json.php?data=get_byid',
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
            url: 'status_json.php?data=delete_status&id=' + id,
            dataType: 'json',
            success: function(data) {
                alert(data);
                displayData();
            },
            error: function(ex) {
                console.log(ex.responseText);
            }
        });
    }
}