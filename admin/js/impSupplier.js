function displayData() {
    $.ajax({
        url: 'impSupplier_json.php?data=get_imp',
        type: 'GET',
        dataType: 'json',
        success: function(alldata) {
            var columns = [
                { title: "ID" },
                { title: "IMPORT DATE" },
                { title: "BOOK TITLE" },
                { title: "SUPPLIER" },
                { title: "AUTHOR" },
                { title: "QUANTITY" },
                { title: "ACTION" },
              ];
            var data = [];
            var option = '';
            for (var i in alldata) {
                option = "<button class='btn btn-success btn-sm edit btn-flat' data-toggle='modal' data-target='#myModal' onclick='editData(" +
                alldata[i][0] +
                ")'><i class='fa fa-edit'></i> </button> | <button class='btn btn-danger btn-sm delete btn-flat' onclick='deleteData(" +
                alldata[i][0] + ")'><i class='fa fa-trash'></i> </button> ";
                data.push([alldata[i][0], alldata[i][1],alldata[i][2],alldata[i][3],alldata[i][4],alldata[i][5], option]);
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
  
  function setDataToSelect(myselect, myjson, caption) {
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
              '<option value="' + s[i][0] + '">' + s[i][1] + "</option>"
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
  
  $(document).ready(function () {
    displayData();
    setDataToSelect(
      "#txttitle",
      "impSupplier_json.php?data=get_book",
      "--Book--"
    );
  });
  
  $(document).ready(function () {
    displayData();
    setDataToSelect(
      "#txtsuppname",
      "impSupplier_json.php?data=get_suppname",
      "--Supplier--"
    );
  });
  
  $("#btnAdd").click(function () {
    $("#txtdate").val("");
    $("#txttitle").val("");
    $("#txtsuppname").val("");
    $("#txtauthor").val("");
    $("#txtqty").val("");
    $("#btnSave").text("Insert");
  });
  
  var imp_id;
  function editData(id) {
    // alert('yes');
    $("#btnSave").text("Update");
    imp_id = id;
    $.ajax({
      url: "impSupplier_json.php?data=get_byid",
      data: "&id=" + id,
      type: "GET",
      dataType: "json",
      success: function (data) {
        $("#txtdate").val(data[0][1]);
        $("#txttitle").val(data[0][2]);
        $("#txtsuppname").val(data[0][3]);
        $("#txtauthor").val(data[0][4]);
        $("#txtqty").val(data[0][5]);
      },
      error: function (ex) {
        console.log(ex.responseText);
      },
    });
  }
  
  $("#btnSave").click(function () { 
    var form_data = $("#form").serialize();
    if ($("#btnSave").text() == "Insert") {
      //Insert
      $.ajax({
        type: "POST",
        url: "impSupplier_json.php?data=add_imp",
        data: form_data,
        dataType: "json",
        success: function (data) {
          toastr.success("Action completed").css("margin-top", "2rem");
          // alert(data);
          displayData();
          $("#myModal").modal("hide");
        },
        error: function (ex) {
          toastr.error("Action incomplete").css("margin-top", "2rem");
          console.log(ex.responseText);
        },
      });
    } else {
      //Update
      $.ajax({
        type: "POST",
        url: "impSupplier_json.php?data=update_imp&id=" + imp_id,
        data: form_data,
        dataType: "json",
        success: function (data) {
          toastr.success("Action completed").css("margin-top", "2rem");
// alert(data);
          displayData();
          $("#myModal").modal("hide");
        },
        error: function (ex) {
          toastr.error("Action incomplete").css("margin-top", "2rem");
          console.log(ex.responseText);
        },
      });
    }
  });

  
function deleteData(id){
  if(confirm('Are you sure?')){
      $.ajax({
          type: 'GET',
          url: 'impSupplier_json.php?data=delete_imp&id=' + id,
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