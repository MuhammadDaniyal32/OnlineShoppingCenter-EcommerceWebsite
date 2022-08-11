<?php 
    require 'admin_access.php';
    require_once "config.php";

    //Fetching top 5 ordered products

    $topproducts_query = "SELECT `order_product_id`,`order_product` AS Products , SUM(`order_qty`) AS TotalSales FROM `orders_tbl` GROUP BY `order_product_id` ORDER BY SUM(`order_qty`) DESC LIMIT 5";
    $topproducts_result = mysqli_query($con,$topproducts_query);

    $Products = array();
    $TotalSales = array();
    foreach ($topproducts_result as $row) {
        $Products[] = $row['Products'];
        $TotalSales[] = $row['TotalSales'];
    }

    //Fetching top 5 ordered products percentage

    $productsstock_query ="SELECT order_product AS ProductName,ROUND(SUM(order_qty) * 100 / (SELECT SUM(order_qty) FROM orders_tbl)) AS OrderPercentage FROM orders_tbl GROUP BY order_product ORDER BY SUM(`order_qty`) DESC LIMIT 5;";
    $ProductName = array();
    $ProductOrderPercentage=array();

    $productsstock_result = mysqli_query($con,$productsstock_query);
    foreach($productsstock_result as $row){
        $ProductName[] =$row['ProductName'];
        $ProductOrderPercentage[] =$row['OrderPercentage'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap_admin.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/style_admin.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
</head>

<body id="reportsPage">
    <div class="" id="home">
        <nav class="navbar navbar-expand-xl">
              <div class="container h-100">
                <a class="navbar-brand" href="dashboard.php">
                  <h1 class="tm-site-title mb-0">Admin Dashboard</h1>
                </a>
                <button
                  class="navbar-toggler ml-auto mr-0"
                  type="button"
                  data-toggle="collapse"
                  data-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                >
                  <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mx-auto h-100">
                    <li class="nav-item">
                      <a class="nav-link active" href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                        <span class="sr-only">(current)</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="products.php">
                        <i class="fas fa-shopping-cart"></i> Products
                      </a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="accounts.php">
                        <i class="far fa-user"></i> Accounts
                      </a>
                    </li>
                  </ul>
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link d-block" href="Logout.php">
                      <?php echo$_SESSION['Username'];?>, <b>Logout</b>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Welcome back, <b><?php echo$_SESSION['Username'];?></b></p>
                </div>
            </div>
            <!-- row -->
            <div class="row tm-content-row">
                <!-- <div class="col-sm-12 col-md-12 col-lg-6 col-xl-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">Latest Hits</h2>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div> -->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">Top 5 Order Products</h2>
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller">
                        <h2 class="tm-block-title">Top 5 Order Products Percentage</h2>
                        <div id="pieChartContainer">
                            <canvas id="pieChart" class="chartjs-render-monitor" width="200" height="200"></canvas>
                        </div>                        
                    </div>
                </div>
                <!-- <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-overflow">
                        <h2 class="tm-block-title">Notification List</h2>
                        <div class="tm-notification-items">
                            <div class="media tm-notification-item">
                                <div class="tm-gray-circle"><img src="img/notification-01.jpg" alt="Avatar Image" class="rounded-circle"></div>
                                <div class="media-body">
                                    <p class="mb-2"><b>Jessica</b> and <b>6 others</b> sent you new <a href="#"
                                            class="tm-notification-link">product updates</a>. Check new orders.</p>
                                    <span class="tm-small tm-text-color-secondary">6h ago.</span>
                                </div>
                            </div>    
                            <div class="media tm-notification-item">
                                <div class="tm-gray-circle"><img src="img/notification-01.jpg" alt="Avatar Image" class="rounded-circle"></div>
                                <div class="media-body">
                                    <p class="mb-2"><b>Jessica</b> and <b>6 others</b> sent you new <a href="#"
                                            class="tm-notification-link">product updates</a>. Check new orders.</p>
                                    <span class="tm-small tm-text-color-secondary">6h ago.</span>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div> -->
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Orders List</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ORDER NO.</th>
                                    <th scope="col">USERNAME</th>
                                    <th scope="col">PRODUCT</th>
                                    <th scope="col">LOCATION</th>
                                    <th scope="col">QUANTITY</th>
                                    <th scope="col">TOTAL</th>
                                    <th scope="col">ORDERED DATE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $getorders_query=mysqli_query($con,"SELECT * FROM orders_tbl");
                                    while($order =mysqli_fetch_assoc($getorders_query)){
                                ?>
                                <tr>
                                    <td scope="row" class="text-center"><b><?php echo $order['order_id'];?></b></td>
                                    <td><b><?php echo $order['order_username'];?></b></td>
                                    <td><b><?php echo $order['order_product'];?></b></td>
                                    <td><b><?php echo $order['order_city'];?>,<?php echo $order['order_country'];?></b></td>
                                    <td class="text-center"><b><?php echo $order['order_qty'];?></b></td>
                                    <td><b><?php echo $order['order_total'];?></b></td>
                                    <td><b><?php echo $order['order_timestamp'];?></b></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="js/bootstrap_admin.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <!-- <script src="js/tooplate-scripts.js"></script> -->

    <script>
        Chart.defaults.global.defaultFontColor = 'white';
        let ctxLine,
            ctxBar,
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
        barChart, pieChart;
        // DOM is ready
        $(function () {
            const width_threshold = 480;

            if ($("#barChart").length) {
                ctxBar = document.getElementById("barChart").getContext("2d");
                optionsBar = {
                    // title: {
                    //     display: true,
                    //     position:'bottom',
                    //     text: 'Custom Chart Title'
                    // },
                responsive: true,
                scales: {
                    xAxes: [{ 
                        stacked: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Orders'
                        },
                        ticks: {
                        beginAtZero:true,
                        mirror:false,
                        suggestedMin: 0,
                        suggestedMax: 100,
                         } 
                    }],
                    yAxes: [{ 
                        barPercentage: 0.2,
                            stacked: true,
                            scaleLabel: {
                            display: true,
                            //padding:10,
                            labelString: "Products"
                        }
                    }],
                    scaleBeginAtZero : true,
                }
                };

                optionsBar.maintainAspectRatio =
                $(window).width() < width_threshold ? false : true;

                configBar = {
                type: "horizontalBar",
                data: {
                    labels: <?php echo json_encode($Products);?>,
                    datasets: [
                    {
                        label: "<?php echo $Products[0];?>",
                        data: <?php echo json_encode($TotalSales);?>,
                        backgroundColor: [
                        "#F7604D",
                        "#4ED6B8",
                        "#A8D582",
                        "#D7D768",
                        "#9D66CC",
                        "#DB9C3F",
                        //"#3889FC"
                        ],
                        borderWidth: 0
                    }
                    ]
                },
                options: optionsBar
                };
                barChart = new Chart(ctxBar, configBar);
            } // Bar Chart

            if ($("#pieChart").length) {
                var chartHeight = 300;

                $("#pieChartContainer").css("height", chartHeight + "px");

                ctxPie = document.getElementById("pieChart").getContext("2d");

                optionsPie = {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                    left: 10,
                    right: 10,
                    top: 10,
                    bottom: 10
                    }
                },
                legend: {
                    display: true,
                    position: "top",
                }
                };

                configPie = {
                type: "pie",
                data: {
                    datasets: [
                    {
                        data: <?php echo json_encode($ProductOrderPercentage);?>,
                        backgroundColor: [
                        "#F7604D",
                        "#4ED6B8",
                        "#A8D582",
                        "#D7D768",
                        "#9D66CC",
                        "#DB9C3F"
                    ],
            
                    }
                    ],
                    labels: <?php echo json_encode($ProductName);?>,
                },
                options: optionsPie
                };

                pieChart = new Chart(ctxPie, configPie);
            } // Pie Chart

            $(window).resize(function () {
                //updateLineChart();
            function updateBarChart() {
                if (barChart) {
                    barChart.options = optionsBar;
                    barChart.update();
                }
            }                
            });
        });
        
    </script>
 
</body>

</html>