<?php
session_start();
include('config/db.php');

if (!isset($_SESSION["username"])) {
    header('Location: ./index.php');
}
?>
<?php include 'includes/header.php'; ?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-top: 50px;">
            <!-- Content Header (Page header) -->

            <section class="content-header">
                <h1>
                    Borrow & Return
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Borrow & Returnr</li>
                    <li class="active">Report</li>
                </ol>
            </section>

            <div class="col-md-12">
                <div class="content-panel" style="padding-top: 10px;">
                    <div class="box">
                        <div class="card-body">
                           
                                <p>
                                    Data : <input type="date" id="date1"> to <input type="date" id="date2">
                                    <button type="button" class="btn btn-primary" id="btnsearch">Search</button>
                                </p>

                                <div id="div_print">
                                    <!-- <p style="text-align: center;"><img style="width:100%; height:200px;" src="../PDO_Report/Image/sale_banner.jpg" alt=""> </p> -->
                                    <h2 style="text-align: center;">Borrow Repoet</h2>
                                    <p style="text-align: center; line-heigth: 5px;">Website : www.sale.com.kh</p>
                                    <p style="text-align: center;">Email : hr@gmail.com</p>
                                    <p id="showdate">...</p>
                                    <div id="display">content.........</div>
                                    <h1>&nbsp;</h1>
                                    <!-- <p style="text-align: right; padding-right:15%;">Product By</p>
                                    <p style="text-align: right; padding-right:15%;">Name</p> -->
                                </div>
                                <button type="button" id="btnprint" class="btn btn-success" onclick="PrintReport();">Print</button>
                    
                            </table>

                        </div>

                    </div>
                </div>

            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/scripts.php'; ?>


        <script type="text/javascript" src="js\jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="js\dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript" src="js\impSupplier.js"></script>
        <script type="text/javascript" src="js\printThis.js"></script>
        <script src='print_js.js'></script>
</body>
<script>
    $(document).ready(function(){
        displayData();
    });
    //displayData Function
  function displayData(){
    $.ajax({
        url: 'report_json.php?data=get_vborrow',
        type:'GET',
        dataType : 'json',
        success:function(data){   
          var str = "<table data-ordering='false' id='table_id' class='table table-hover d-flex justify-content-between'><tr>"+
                                "<th>ID</th>"+
                                "<th>Book Title</th>"+
                                "<th>Student Name</th>"+
                                "<th>Borrow Date</th>"+
                                "<th>Return Date</th>"+
                                "<th>Create Date</th>"+
                                "</tr>";
                    var total = 0;
                    for(var d in data){
                        str += "<tr>";
                            str += "<td>" + data[d][0] + "</td>";
                            str += "<td>" + data[d][1] + "</td>";
                            str += "<td>" + data[d][2] + "</td>";
                            str += "<td>" + data[d][3] + "</td>";
                            str += "<td>" + data[d][4] + "</td>";
                            str += "<td>" + data[d][5] + "</td>";
                        str += "</tr>";
                        total += Number(data[d][6])
                    }
                    str += "<tr><th colspan='5'>Total Number</th><th>" + data.length +"</th></tr>";
                    str += "</table>";
                    $('#display').html(str);
        },
        error: function (ex){
          console.log(ex.responseText);
        }
      });//ajax
    }

        //search Button 
        $('#btnsearch').click(function(){
        var date1 = $("#date1").val();
        var date2 = $("#date2").val();
        $("#showdate").html("Date : <i>" + date1 + "</i> to  <i>" + date2 + "</i>");
    $.ajax({
        url: 'report_json.php?data=get_borrowbydate',
        type:'GET',
                data: '&date1=' + date1 + '&date2=' + date2,
        dataType : 'json',
        success:function(data){   
          var str = "<table data-ordering='false' id='table_id' class='table table-hover d-flex justify-content-between'><tr>"+
                                "<th>ID</th>"+
                                "<th>Book Title</th>"+
                                "<th>Student Name</th>"+
                                "<th>Borrow Date</th>"+
                                "<th>Return Date</th>"+
                                "<th>Create Date</th>"+
                                "</tr>";
                    var total = 0;
                    for(var d in data){
                        str += "<tr>";
                            str += "<td>" + data[d][0] + "</td>";
                            str += "<td>" + data[d][1] + "</td>";
                            str += "<td>" + data[d][2] + "</td>";
                            str += "<td>" + data[d][3] + "</td>";
                            str += "<td>" + data[d][4] + "</td>";
                            str += "<td>" + data[d][5] + "</td>";
                        str += "</tr>";
                        total += Number(data[d][6])
                    }
                    str += "<tr><th colspan='5'>Total Number</th><th>" + data.length +"</th></tr>";
                    str += "</table>";
                    $('#display').html(str);
        },
        error: function (ex){
          console.log(ex.responseText);
        }
      });//ajax
        })


</script>