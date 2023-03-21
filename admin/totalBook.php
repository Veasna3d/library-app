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
                    Total Book
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Total Book</li>
                    <li class="active">Report</li>
                </ol>
            </section>

            <div class="col-md-12">
                <div class="content-panel" style="padding-top: 10px;">
                    <div class="box">
                        <div class="card-body">
                          
                                <div id="div_print">
                                    <!-- <p style="text-align: center;"><img style="width:100%; height:200px;" src="./upload/customer_banner.jpg" alt=""> </p> -->
                                    <h2 style="text-align: center;">Tatal Book Repoet</h2>
                                    <p style="text-align: center; line-heigth: 5px;">Website : www.sale.com.kh</p>
                                    <p style="text-align: center;">Email : hr@gmail.com</p>
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
        <script src='js\print_js.js'></script>
</body>

<script>
    $(document).ready(function() {
        displayData();
    });
    //displayData Function
    function displayData() {
        $.ajax({
            url: 'report_json.php?data=get_totalBook',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var str = " <table data-ordering='false' id='table_id' class='table table-hover d-flex justify-content-between'><tr>" +
                    "<th>ID</th>" +
                    "<th>BOOK TITLE</th>" +
                    "<th>CATEGORY NAME</th>" +
                    "<th>CREATE DATE</th>" +
                    "</tr>";
                for (var d in data) {
                    str += "<tr>";
                    str += "<td>" + data[d][0] + "</td>";
                    str += "<td>" + data[d][1] + "</td>";
                    str += "<td>" + data[d][2] + "</td>";
                    str += "<td>" + data[d][3] + "</td>";
                    str += "</tr>";
                }
                str += "<tr><th colspan='3'>Total Book</th><th>" + data.length + "</th></tr>";
                str += "</table>";
                $('#display').html(str);
            },
            error: function(ex) {
                console.log(ex.responseText);
            }
        }); //ajax
    }
</script>