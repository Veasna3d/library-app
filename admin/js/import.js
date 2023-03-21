function displayData() {
  $.ajax({
    url: "import_json.php?data=get_imp",
    type: "GET",
    dataType: "json",
    success: function (alldata) {
      var columns = [
        { title: "ID" },
        { title: "IMPORT DATE" },
        { title: "BOOK TITLE" },
        { title: "CATEGORY" },
        { title: "SUPPLIER" },
        { title: "AUTHOR" },
        { title: "QUANTITY" },
        { title: "CREATE DATE" },
        { title: "ACTIONS" },
      ];
      var data = [];
      var option = "";
      for (var i in alldata) {
        option =
          "<button class='btn btn-success btn-sm edit btn-flat' data-toggle='modal' data-target='#myModal' onclick='editData(" +
          alldata[i][0] +
          ")'><i class='fa fa-edit'></i> </button> | <button class='btn btn-danger btn-sm delete btn-flat' onclick='deleteData(" +
          alldata[i][0] +
          ")'><i class='fa fa-trash'></i> </button> ";
        data.push([
          alldata[i][0],
          alldata[i][1],
          alldata[i][2],
          alldata[i][3],
          alldata[i][4],
          alldata[i][5],
          alldata[i][6],
          alldata[i][7],
          option,
        ]);
      }
      console.log(data);
      $("#table_id").DataTable({
        destroy: true,
        data: data,
        columns: columns,
      });
    },
    error: function (e) {
      console.log(e.responseText);
    },
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
    "#txtBook",
    "import_json.php?data=get_book",
    "--Book--"
  );
});

$(document).ready(function () {
  displayData();
  setDataToSelect(
    "#txtCategory",
    "import_json.php?data=get_category",
    "--Category--"
  );
});

$(document).ready(function () {
  displayData();
  setDataToSelect(
    "#txtSuppname",
    "import_json.php?data=get_suppname",
    "--Supplier--"
  );
});



$("#btnAdd").click(function () {
  $("#txtDate").val("");
  $("#txtSuppname").val("");
  $("#txtBook").val("");
  $("#txtCategory").val("");
  $("#txtAuthor").val("");
  $("#txtQty").val("");
  $("#btnSave").text("Insert");
});

var imp_id;
function editData(id) {
  // alert('yes');
  $("#btnSave").text("Update");
  imp_id = id;
  $.ajax({
    url: "import_json.php?data=get_byid",
    data: "&id=" + id,
    type: "GET",
    dataType: "json",
    success: function (data) {
      $("#txtDate").val(data[0][1]);
      $("#txtBook").val(data[0][2]);
      $("#txtCategory").val(data[0][3]);
      $("#txtSuppname").val(data[0][4]);
      $("#txtAuthor").val(data[0][5]);
      $("#txtQty").val(data[0][6]);
    },
    error: function (ex) {
      console.log(ex.responseText);
    },
  });
}

$("#btnSave").click(function () {

  var importDate = $("#txtDate");
  var book = $("#txtBook");
  var category = $("#txtCategory");
  var supplier = $("#txtSuppname");
  var qty = $("#txtQty");

  if (
    importDate.val() == "" &&
    book.val() == "" &&
    supplier.val() == "" &&
    qty.val() == "" && category.val() == "" 
  ) {
    importDate.focus();
    return toastr.warning("Fields Require!").css("margin-top", "2rem");
  } else if (importDate.val() == "") {
    importDate.focus();
    return toastr.warning("Import Date Require!").css("margin-top", "2rem");
  } else if (book.val() == "") {
    book.focus();
    return toastr.warning("Book Require!").css("margin-top", "2rem");
  }else if(category.val() == ""){
    category.focus();
    return toastr.warning("Category Require!").css("margin-top", "2rem");
  }else if (supplier.val() == "") {
    supplier.focus();
    return toastr.warning("Supplier Require!").css("margin-top", "2rem");
  } else if (qty.val() == "") {
    qty.focus();
    return toastr.warning("Qty Require!").css("margin-top", "2rem");
  }

  var form_data = $("#form").serialize();
  if ($("#btnSave").text() == "Insert") {
    //Insert
    $.ajax({
      type: "POST",
      url: "import_json.php?data=add_imp",
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
      url: "import_json.php?data=update_imp&id=" + imp_id,
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

function deleteData(id) {
  if (confirm("Are you sure?")) {
    $.ajax({
      type: "GET",
      url: "import_json.php?data=delete_imp&id=" + id,
      dataType: "json",
      success: function (data) {
        // alert(data);
        toastr.success("Action completed").css("margin-top", "2rem");
        displayData();
      },
      error: function (ex) {
        toastr.error("Action incomplete").css("margin-top", "2rem");
        console.log(ex.responseText);
      },
    });
  }
}
