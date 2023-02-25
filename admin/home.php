<?php
session_start();
// include('config/db.php');

if (!isset($_SESSION["username"])) {
    header('Location: ../index.php');
}

$conn = new mysqli('localhost', 'root', '', 'libraryDB');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include 'includes/timezone.php';
$today = date('Y-m-d');
$year = date('Y');
if (isset($_GET['year'])) {
    $year = $_GET['year'];
}

?>

<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header" style="margin-top: 50px;">
                <h1>
                    Dashboard
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">

                                <?php
                                $sql = "SELECT * FROM Book";
                                $query = $conn->query($sql);

                                echo "<h3>" . $query->num_rows . "</h3>";
                                ?>
                                <p>Total Books</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                            <a href="book.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <?php
                                $sql = "SELECT * FROM Category";
                                $query = $conn->query($sql);

                                echo "<h3>" . $query->num_rows . "</h3>";
                                ?>
                                <p>Total Category</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <a href="student.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <?php
                                $sql = "SELECT * FROM Borrow WHERE status = 1";
                                $query = $conn->query($sql);

                                echo "<h3>" . $query->num_rows . "</h3>";
                                ?>
                                <p>Total Returned</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-mail-reply"></i>
                            </div>
                            <a href="return.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <?php
                                $sql = "SELECT * FROM Borrow WHERE status = 0";
                                $query = $conn->query($sql);

                                echo "<h3>" . $query->num_rows . "</h3>";
                                ?>
                                <p>Total Borrowed</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-mail-forward"></i>
                            </div>
                            <a href="borrow.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Monthly Transaction Report</h3>
                                <div class="box-tools pull-right">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <label>Select Year: </label>
                                            <select class="form-control input-sm" id="select_year">
                                                <?php
                                                for ($i = 2022; $i <= 2025; $i++) {
                                                    $selected = ($i == $year) ? 'selected' : '';
                                                    echo "
                            <option value='" . $i . "' " . $selected . ">" . $i . "</option>
                          ";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <br>
                                    <div id="legend" class="text-center"></div>
                                    <canvas id="barChart" style="height:300px"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 pot">
                            <div id="chartContainer"></div>
                            <h1>Hello</h1>
                        </div>
                        <div class="col-md-6 pot">
                            <div id="chartLegend"></div>
                            <h1>Hello</h1>
                        </div> -->
                    <div class="col-xs-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Monthly Transaction Report</h3>
                                <div class="box-tools pull-right">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <label>Select Year: </label>
                                            <select class="form-control input-sm" id="select_year">
                                                <?php
                                                for ($i = 2022; $i <= 2025; $i++) {
                                                    $selected = ($i == $year) ? 'selected' : '';
                                                    echo "
                            <option value='" . $i . "' " . $selected . ">" . $i . "</option>
                          ";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <br>
                                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                                    <!-- <canvas id="chartContainer" style="height:300px"></canvas> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Monthly Transaction Report</h3>
                                <div class="box-tools pull-right">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <label>Select Year: </label>
                                            <select class="form-control input-sm" id="select_year">
                                                <?php
                                                for ($i = 2022; $i <= 2025; $i++) {
                                                    $selected = ($i == $year) ? 'selected' : '';
                                                    echo "
                            <option value='" . $i . "' " . $selected . ">" . $i . "</option>
                          ";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <br>
                                    <div id="chartLegend" style="height: 300px; width: 100%;"></div>
                                    <!-- <canvas id="chartContainer" style="height:300px"></canvas> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- right col -->
        </div>
    </div>
    <!-- ./wrapper -->

    <!-- Chart Data -->
    <?php
    $and = 'AND YEAR(date) = ' . $year;
    $months = array();
    $return = array();
    $borrow = array();
    for ($m = 1; $m <= 12; $m++) {
        $sql = "SELECT id,bookId, studentId FROM Borrow WHERE MONTH(returnDate) = '$m' AND YEAR(returnDate) = '$year' AND status=1 ";
        $rquery = $conn->query($sql);
        array_push($return, $rquery->num_rows);

        $sql = "SELECT id,bookId, studentId  FROM Borrow WHERE MONTH(borrowDate) = '$m' AND YEAR(borrowDate) = '$year' AND status=0 ";
        $bquery = $conn->query($sql);
        array_push($borrow, $bquery->num_rows);

        $num = str_pad($m, 2, 0, STR_PAD_LEFT);
        $month =  date('M', mktime(0, 0, 0, $m, 1));
        array_push($months, $month);
    }

    $months = json_encode($months);
    $return = json_encode($return);
    $borrow = json_encode($borrow);

    ?>
    <!-- End Chart Data -->
    <?php include 'includes/scripts.php'; ?>
    <script>
        $(function() {
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChart = new Chart(barChartCanvas)
            var barChartData = {
                labels: <?php echo $months; ?>,
                datasets: [{
                        label: 'Borrow',
                        fillColor: 'rgba(210, 214, 222, 1)',
                        strokeColor: 'rgba(210, 214, 222, 1)',
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: <?php echo $borrow; ?>
                    },
                    {
                        label: 'Return',
                        fillColor: 'rgba(60,141,188,0.9)',
                        strokeColor: 'rgba(60,141,188,0.8)',
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: <?php echo $return; ?>
                    }
                ]
            }
            barChartData.datasets[1].fillColor = '#00a65a'
            barChartData.datasets[1].strokeColor = '#00a65a'
            barChartData.datasets[1].pointColor = '#00a65a'
            var barChartOptions = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template
                legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                //Boolean - whether to make the chart responsive
                responsive: true,
                maintainAspectRatio: true
            }

            barChartOptions.datasetFill = false
            var myChart = barChart.Bar(barChartData, barChartOptions)
            document.getElementById('legend').innerHTML = myChart.generateLegend();
        });

        function findMax(arr) {
            var maxValue = Number.MIN_VALUE;
            for (var i in arr) {
                if (maxValue < Number(arr[i][2])) {
                    maxValue = Number([i][2]);
                }
                return maxValue;
            }
        }

        function findMin(arr) {
            var minValue = Number.MAX_VALUE;
            for (var i in arr) {
                if (minValue > Number(arr[i][2])) {
                    minValue = Number(arr[i][2]);
                }
                return minValue;
            }
        }
        //pie
     
            $.ajax({
                type: "GET",
                url: "chart_json.php?data=get_byqty",
                dataType: "json",
                success: function(allData) {
                    alert('yes');
                    var dataPoints = [];
                    var max_value = findMax(allData);
                    for (var i in allData) {
                        if (allData[i][2] == max_value) {
                            dataPoints.push({
                                y: Number(allData[i][2]),
                                name: allData[i][1],
                                exploded: true
                            });
                        } else {
                            dataPoints.push({
                                y: Number(allData[i][2]),
                                name: allData[i][1]
                            });
                        }
                    }
                var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Desktop Browser Market Share in 2016"
                },
                data: [{
                    type: "pie",
                    startAngle: 25,
                    toolTipContent: "<b>{label}</b>: {y}%",
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "{label} - {y}%",
                    dataPoints: [{
                            y: 51.08,
                            label: "Chrome"
                        },
                        {
                            y: 27.34,
                            label: "Internet Explorer"
                        },
                        {
                            y: 10.62,
                            label: "Firefox"
                        },
                        {
                            y: 5.02,
                            label: "Microsoft Edge"
                        },
                        {
                            y: 4.07,
                            label: "Safari"
                        },
                        {
                            y: 1.22,
                            label: "Opera"
                        },
                        {
                            y: 0.44,
                            label: "Others"
                        }
                    ]
                }]
            });
            chart.render();
                },
                error: function(e) {
                    console.log(e.responseText)
                }
            })
            $("#reload").click(function() {
        location.reload();
    })

            // var chart = new CanvasJS.Chart("chartContainer", {
            //     theme: "light2", // "light1", "light2", "dark1", "dark2"
            //     exportEnabled: true,
            //     animationEnabled: true,
            //     title: {
            //         text: "Desktop Browser Market Share in 2016"
            //     },
            //     data: [{
            //         type: "pie",
            //         startAngle: 25,
            //         toolTipContent: "<b>{label}</b>: {y}%",
            //         showInLegend: "true",
            //         legendText: "{label}",
            //         indexLabelFontSize: 16,
            //         indexLabel: "{label} - {y}%",
            //         dataPoints: [{
            //                 y: 51.08,
            //                 label: "Chrome"
            //             },
            //             {
            //                 y: 27.34,
            //                 label: "Internet Explorer"
            //             },
            //             {
            //                 y: 10.62,
            //                 label: "Firefox"
            //             },
            //             {
            //                 y: 5.02,
            //                 label: "Microsoft Edge"
            //             },
            //             {
            //                 y: 4.07,
            //                 label: "Safari"
            //             },
            //             {
            //                 y: 1.22,
            //                 label: "Opera"
            //             },
            //             {
            //                 y: 0.44,
            //                 label: "Others"
            //             }
            //         ]
            //     }]
            // });
            // chart.render();




        
        
    </script>
    <script>
        $(function() {
            $('#select_year').change(function() {
                window.location.href = 'home.php?year=' + $(this).val();
            });
        });
    </script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>

</html>