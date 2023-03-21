<?php
session_start();
// include('config/db.php');

if (!isset($_SESSION["username"])) {
    header('Location: ../index.php');
    exit();
}

$dsn = 'mysql:host=localhost;dbname=libraryDB';
$username = 'root';
$password = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
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
                                $stmt = $pdo->query($sql);
                                $num_rows = $stmt->rowCount();
                                echo "<h3>" . $num_rows . "</h3>";

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
                                $stmt = $pdo->query($sql);
                                $num_rows = $stmt->rowCount();
                                echo "<h3>" . $num_rows . "</h3>";
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
                                // $sql = "SELECT * FROM Borrow WHERE status = 1";
                                // $query = $conn->query($sql);
                                // echo "<h3>" . $query->num_rows . "</h3>";
                                $sql = "SELECT * FROM Borrow WHERE status = 1";
                                $stmt = $pdo->query($sql);
                                $num_rows = $stmt->rowCount();
                                echo "<h3>" . $num_rows . "</h3>";

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
                                 $stmt = $pdo->query($sql);
                                 $num_rows = $stmt->rowCount();
                                 echo "<h3>" . $num_rows . "</h3>";
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
                            <div class="box-body">
                                <div class="chart">
                                    <br>
                                    <div id="chartLegend" style="height: 300px; width: 100%;"></div>
                                    <!-- <canvas id="chartLegend" style="height:300px"></canvas> -->
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
    $and = 'AND YEAR(date) = :year';
    $months = array();
    $return = array();
    $borrow = array();
    for ($m = 1; $m <= 12; $m++) {
        $month = str_pad($m, 2, 0, STR_PAD_LEFT);
        $sql = "SELECT id, bookId, studentId FROM Borrow WHERE MONTH(returnDate) = :month AND YEAR(returnDate) = :year AND status=1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['month' => $month, 'year' => $year]);
        array_push($return, $stmt->rowCount());

        $sql = "SELECT id, bookId, studentId FROM Borrow WHERE MONTH(borrowDate) = :month AND YEAR(borrowDate) = :year AND status=0";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['month' => $month, 'year' => $year]);
        array_push($borrow, $stmt->rowCount());

        $month_name = date('M', mktime(0, 0, 0, $m, 1));
        array_push($months, $month_name);
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
        $(function() {
            $.ajax({
                type: "GET",
                url: "chart_json.php?data=get_byqty",
                dataType: "json",
                success: function(allData) {
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
                                y: Number(allData[i][1]),
                                name: allData[i][0]
                            });
                        }
                    }
                    var chart = new CanvasJS.Chart("chartLegend", {
                        exportEnabled: true,
                        animationEnabled: true,
                        title: {
                            text: "Total Borrow Book"
                        },
                        legend: {
                            cursor: "pointer",
                            itemclick: explodePie
                        },
                        data: [{
                            type: "pie",
                            showInLegend: true,
                            toolTipContent: "{name}: <strong>{y}</strong>",
                            indexLabel: "{name} = {y}",
                            dataPoints: dataPoints
                        }]
                    });
                    chart.render();

                },
                error: function(e) {
                    console.log(e.responseText)
                }
            })
        });

        function explodePie(e) {
            if (typeof(e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e
                    .dataPointIndex].exploded) {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
            } else {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
            }
            e.chart.render();
        }
    </script>
    <script>
        $(function() {
            $('#select_year').change(function() {
                window.location.href = 'home.php?year=' + $(this).val();
            });
        });
    </script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    </script>
</body>

</html>