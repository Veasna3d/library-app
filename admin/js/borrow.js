
function displayData(){
    $.ajax({
        url: 'borrow_json.php?data=get_borrow',
        type: 'GET',
        dataType: 'json',
        success: function (alldata){
            var columns = [
                { title: "ID" },
                { title: "BOOK TITLE" },
                { title: "STUDENT NAME" },
                { title: "BORROW DATE" },
                { title: "RETURN DATE" },
                { title: "STATUS" },
                { title: "REMARK" },
                { title: "CREATE DATE" },
                { title: "ACTION" }
            ];
            var data = [];
            var option = '';
            for(var i in alldata){
                option =
            "<i style='cursor: pointer;' class='fa fa-pencil-square-o' data-toggle='modal' data-target='#myModal' onclick='editData(" +
            alldata[i][0] +
            ")'></i> | <i style='cursor: pointer;' class='fa fa-trash' onclick='deleteData(" +
            alldata[i][0] +
            ")'></i> | <i style='cursor: pointer;' class='fa fa-retweet' onclick='statusReturn(" +
            alldata[i][0] +
            ")'></i> ";
                data.push([alldata[i][0], alldata[i][1], alldata[i][2], alldata[i][3], alldata[i][4], alldata[i][5], alldata[i][6], alldata[i][7], option]);
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

function setStudent(myselect, myjson, caption) {
    try {
      var sel = $(myselect);
      sel.empty();
      sel.append('<option value="">' + caption + "</option>");
      $.ajax({
        url: myjson,
        dataType: "json",
        success: function (s) {
          for (var i = 0; i < s.length; i++) {
            sel.append(
              '<option value="' +
              s[i][0] +
              '">' +
              s[i][1] +
              "-" +
              s[i][2] +
              "</option>"
            );
          }
        },
        error: function (e) {
          console.log(e.responseText);
        },
      });
    } catch (err) {
      console.log(err.message);
    }
  }

$(document).ready(function(){
    displayData();
    setDataToSelect('#txtBookId', 'borrow_json.php?data=get_book', "--Book--");
    setStudent('#txtStudentId', 'borrow_json.php?data=get_student', "--Student--");
});

$("#btnAdd").click(function () {
    $("#txtBookId").val("");
    $("#txtStudentId").val("");
    $("#txtBorrow").val("");
    $("#txtReturn").val("");
    $("#txtRemark").val("");
    $("#btnSave").text("Insert");
  });

var student_id;
function editData(id){
    $("#btnSave").text("Update");
    student_id = id;

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
            $("#txtRemark").val(data[0][5]);
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
            url: 'borrow_json.php?data=update_borrow&id=' + id,
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

function statusReturn(id) {
    if (confirm("Are you sure to return this transaction?")) {
      $.ajax({
        type: "GET",
        url: "borrow_json.php?data=return_borrow&id=" + id,
        dataType: "json",
        success: function (data) {
          alert(data);
          displayData();
        },
        error: function (ex) {
          console.log(ex.responseText);
        },
      });
    }
  }


