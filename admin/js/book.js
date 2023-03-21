//Filter Available
$("#btnAvailable").click(function () {
  $.ajax({
    url: "book_json.php?data=get_available",
    type: "Get",
    dataType: "json",
    success: function (alldata) {
      var columns = [
        {
          title: "ID",
        },
        {
          title: "BOOK TITLE",
        },
        {
          title: "DESCRIPTION",
        },
        {
          title: "CATEGORY",
        },
        {
          title: "AUTHOR",
        },{
          title: "IMAGE",
        },{
          title: "STATUS",
        },
        {
          title: "CREATE DATE",
        },
        {
          title: "ACTIONS",
        },
      ];
      var data = [];
      var option = "";
      for (var i in alldata) {
        option =
          "<button class='btn btn-success btn-sm edit btn-flat' data-toggle='modal' data-target='#myModal' onclick='editData(" +
          alldata[i][0] +
          ")'><i class='fa fa-edit'></i> </button> | <button class='btn btn-danger btn-sm delete btn-flat' onclick='deleteData(" +
          alldata[i][0] + ")'><i class='fa fa-trash'></i> </button> | <button style='cursor: pointer;' class='btn btn-success btn-sm edit btn-flat' id='btnStatus' onclick='unAvailable(" +
          alldata[i][0] +
          ")'><i class='fa fa-retweet'></i></button> ";
          data.push([
            alldata[i][0],
            alldata[i][1],
            alldata[i][2],
            alldata[i][3],
            alldata[i][4],
            "<img style='width: 50%; height: 50%;' src='upload/" + alldata[i][5] + "'>",
            alldata[i][6],
            alldata[i][7],
            option,
          ]);
      }
      console.log(data);
      $("#table_id").DataTable({
        responsive: true,
        scrollX: true,
        destroy: true,
        data: data,
        columns: columns,
      });
    },
    error: function (e) {
      console.log(e.responseText);
    },
  });
});

//Filter UnAvailable
$("#btnUnAvailable").click(function () {
  $.ajax({
    url: "book_json.php?data=get_unavailable",
    type: "Get",
    dataType: "json",
    success: function (alldata) {
      var columns = [
        {
          title: "ID",
        },
        {
          title: "BOOK TITLE",
        },
        {
          title: "DESCRIPTION",
        },
        {
          title: "CATEGORY",
        },
        {
          title: "AUTHOR",
        },{
          title: "IMAGE",
        },{
          title: "STATUS",
        },
        {
          title: "CREATE DATE",
        },
        {
          title: "ACTIONS",
        },
      ];
      var data = [];
      var option = "";
      for (var i in alldata) {
        option =
        option =
        "<button class='btn btn-success btn-sm edit btn-flat' data-toggle='modal' data-target='#myModal' onclick='editData(" +
        alldata[i][0] +
        ")'><i class='fa fa-edit'></i> </button> | <button class='btn btn-danger btn-sm delete btn-flat' onclick='deleteData(" +
        alldata[i][0] + ")'><i class='fa fa-trash'></i> </button> | <button style='cursor: pointer;' class='btn btn-success btn-sm edit btn-flat' id='btnStatus' onclick='available(" +
        alldata[i][0] +
        ")'><i class='fa fa-retweet'></i></button> ";
          data.push([
            alldata[i][0],
            alldata[i][1],
            alldata[i][2],
            alldata[i][3],
            alldata[i][4],
            "<img style='width: 50%; height: 50%;' src='upload/" + alldata[i][5] + "'>",
            alldata[i][6],
            alldata[i][7],
            option,
          ]);
      }
      console.log(data);
      $("#table_id").DataTable({
        responsive: true,
        scrollX: true,
        destroy: true,
        data: data,
        columns: columns,
      });
    },
    error: function (e) {
      console.log(e.responseText);
    },
  });
});

function displayData() {
  $.ajax({
    url: "book_json.php?data=get_available",
    type: "GET",
    dataType: "json",
    success: function (alldata) {
      var columns = [
        {
          title: "ID",
        },
        {
          title: "BOOK TITLE",
        },
        {
          title: "DESCRIPTION",
        },
        {
          title: "CATEGORY",
        },
        {
          title: "AUTHOR",
        },{
          title: "IMAGE",
        },{
          title: "STATUS",
        },
        {
          title: "CREATE DATE",
        },
        {
          title: "ACTIONS",
        },
      ];
      var data = [];
      var option = "";
      for (var i in alldata) {
        option =
          "<span style='display: flex;'><button class='btn btn-success btn-sm edit btn-flat' data-toggle='modal' data-target='#myModal' onclick='editData(" +
          alldata[i][0] +
          ")'><i class='fa fa-edit'></i> </button> | <button class='btn btn-danger btn-sm delete btn-flat' onclick='deleteData(" +
          alldata[i][0] + ")'><i class='fa fa-trash'></i> </button> | <button style='cursor: pointer;' class='btn btn-success btn-sm edit btn-flat' id='btnStatus' onclick='unAvailable(" +
          alldata[i][0] +
          ")'><i class='fa fa-retweet'></i></button> </span>";
        data.push([
          alldata[i][0],
          alldata[i][1],
          alldata[i][2],
          alldata[i][3],
          alldata[i][4],
          "<img style='width: 50px; height: 50px;' src='upload/" + alldata[i][5] + "'>",
          alldata[i][6],
          alldata[i][7],
          option,
        ]);
      }
      console.log(data);
      $("#table_id").DataTable({
        // // responsive: true,
        // scrollX: true,
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

//Load
$(document).ready(function () {
  displayData();
  setDataToSelect("#ddlCategory", "book_json.php?data=get_category", "--Category--");
});

//btnSave
$("#btnSave").click(function () {
    
    var bookTitle = $("#txtBookTitle");
    var cateogry = $("#ddlCateogry");
    
    if (bookTitle.val() == "") {
        bookTitle.focus();
        return toastr.warning("Field Require!").css("margin-top", "2rem");
    }else if (cateogry.val() == "") {
        cateogry.focus();
        return toastr.warning("Category Require!").css("margin-top", "2rem");
    }
    

  var form_data = new FormData($("#form")[0]); // Use FormData object to include file data
  if ($("#btnSave").text() == "Insert") {
    //Insert
    $.ajax({
      type: "POST",
      url: "book_json.php?data=add_book",
      data: form_data,
      dataType: "json",
      contentType: false, // Set to false to let jQuery decide the content type
      processData: false, // Set to false to prevent jQuery from processing data (i.e. no stringifying)
      success: function (data) {
        toastr.success("Action completed").css("margin-top", "2rem");
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
      url: "book_json.php?data=update_book&id=" + book_id,
      data: form_data,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (data) {
        toastr.success("Action completed").css("margin-top", "2rem");
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

$("#btnAdd").click(function () {
  $("#txtBookTitle").val("");
  $("#txtDescription").val("");
  $("#txtAuthor").val("");
  $("#ddlCategory").val("");
  $("#image").val("");
  $("#btnSave").text("Insert");
});

var book_id;

function editData(id) {
  $("#btnSave").text("Update");
  book_id = id;
  $.ajax({
    url: "book_json.php?data=get_byid",
    data: "&id=" + id,
    type: "GET",
    dataType: "json",
    contentType: false,
    processData: false,
    success: function (data) {
      $("#txtBookTitle").val(data[0][1]);
      $("#txtDescription").val(data[0][2]);
      $("#ddlCategory").val(data[0][3]);
      $("#txtAuthor").val(data[0][4]);
      $("#image").val(data[0][5]);
    },
    error: function (ex) {
      console.log(ex.responseText);
    },
  });
}

//Delete
function deleteData(id) {
  Swal.fire({
    title: "Are you sure to delete this book?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "GET",
        url: "book_json.php?data=delete_book&id=" + id,
        dataType: "json",
        success: function (data) {
          Swal.fire({
            title: "Action completed",
            icon: "success",
            showConfirmButton: false,
            timer: 2000,
          });
          displayData();
        },
        error: function (ex) {
          Swal.fire({
            title: "Action incomplete",
            text: ex.responseText,
            icon: "error",
            showConfirmButton: false,
            timer: 2000,
          });
          console.log(ex.responseText);
        },
      });
    }
  });
}




//unavailable
function unAvailable(id) {
  Swal.fire({
    title: "This is book unavailable in library?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "GET",
        url: "book_json.php?data=is_unavailable&id=" + id,
        dataType: "json",
        success: function (data) {
          Swal.fire({
            title: "Action completed",
            icon: "success",
            showConfirmButton: false,
            timer: 2000,
          });
          displayData();
        },
        error: function (ex) {
          Swal.fire({
            title: "Action incomplete",
            text: ex.responseText,
            icon: "error",
            showConfirmButton: false,
            timer: 2000,
          });
          console.log(ex.responseText);
        },
      });
    }
  });
}


//available
function available(id) {
  Swal.fire({
    title: "This is book available in library?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "GET",
        url: "book_json.php?data=is_available&id=" + id,
        dataType: "json",
        success: function (data) {
          Swal.fire({
            title: "Action completed",
            icon: "success",
            showConfirmButton: false,
            timer: 2000,
          });
          displayData();
        },
        error: function (ex) {
          Swal.fire({
            title: "Action incomplete",
            text: ex.responseText,
            icon: "error",
            showConfirmButton: false,
            timer: 2000,
          });
          console.log(ex.responseText);
        },
      });
    }
  });
}



