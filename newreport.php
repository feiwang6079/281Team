<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Dashio - Bootstrap Admin Template</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <link href="css/table-responsive.css" rel="stylesheet">

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="#" class="logo"><b>Infrastructure<span>  Management</span></b></a>
      <!--logo end-->

    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <li>
          <?php 
          include 'config.php';
          $building = $_GET['building'];
          echo "<a  href=\"newindex.php?building=$building\">"
          ?>
              <i class="fa fa-th"></i>
              <span>Infrastructure </span>
              </a>
          </li>
        
         <li>
          <?php  echo "<a class=\"active\" href=\"newreport.php?building=$building\">" ?>
              <i class="fa fa-bar-chart-o"></i>
              <span>Status Report </span>
              </a>
          </li>
        
       </ul>
        
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
   <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Status Report</h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Status Detail</h4>
              <section id="unseen">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>Building Name</th>
                      <th>Building Address</th>
                      <th class="numeric">Total Clusters</th>
                      <th class="numeric">Total Nodes</th>
                      <th class="numeric">Total Sensors</th>
                      <th class="numeric">Total ONStatus</th>
                      <th class="numeric">Total OFFStatus</th>
                      <th class="numeric">Total INACTIVEStatus</th>
<!--                       <th class="numeric">Volume</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    
                    <?php 
                    
                    $count_sql = "select * from building where building_id = $building";
                    $result = mysqli_query($conn, $count_sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "<td>".$row['building_name']."</td>";
                    echo "<td>".$row['building_address']."</td>";
                    
                    $count_sql = "select count(floor_cluster_id) as c from building_floor where building_id = $building";
                    $result = mysqli_query($conn, $count_sql);
                    $data = mysqli_fetch_assoc($result);
                    $floorCount = $data['c'];                                 
                    
                    echo "<td class=\"numeric\">$floorCount</td>";
                    
                    $sql = "select * from building_floor where building_id = $building";
                    $result = mysqli_query($conn, $sql);
                    $nodeCount = 0;                        
                    $sensorCount = 0;
                    
                    
                    $onConunt = 0;
                    $offCount = 0;
                    $inactiveCount = 0;
                    
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $floorid = $row['floor_cluster_id'];
                        $count_node_sql = "select count(node_id) as c from floor_node where floor_cluster_id = $floorid";
                        $count_node_result = mysqli_query($conn, $count_node_sql);
                        $data_node = mysqli_fetch_assoc($count_node_result);
                        $nodeCount += $data_node['c'];
                        
                        
                        $node_sql = "select * from floor_node where floor_cluster_id = $floorid";
                        $node_result = mysqli_query($conn, $node_sql);

                        while($nodeRow = mysqli_fetch_assoc($node_result))
                        {
                            $nodeid = $nodeRow['node_id'];
                            $count_sensor_sql = "select count(sensor_id) as c from node_sensor where node_id=$nodeid";
                            $count_sensor_result = mysqli_query($conn, $count_sensor_sql);
                            $data_sensor = mysqli_fetch_assoc($count_sensor_result);
                            $sensorCount += $data_sensor['c'];
                            
                            $sensor_sql = "select * from node_sensor where node_id = $nodeid";
                            $sensor_result = mysqli_query($conn, $sensor_sql);
                            while($sensorRow = mysqli_fetch_assoc($sensor_result))
                            {
                                $sensorid = $sensorRow['sensor_id'];
                                $sensor_status_sql = "select sensor_status from sensor where sensor_id = $sensorid";
                                $sensor_status_result = mysqli_query($conn, $sensor_status_sql);
                                $sensor_status_row = mysqli_fetch_assoc($sensor_status_result);
                                if(strcmp("on", $sensor_status_row['sensor_status']) == 0)
                                {
                                    $onConunt++;
                                }
                                else if(strcmp("off", $sensor_status_row['sensor_status']) == 0)
                                {
                                    $offCount++;
                                }
                                else if(strcmp("inactive", $sensor_status_row['sensor_status']) == 0 )
                                {
                                    $inactiveCount++;
                                }
                                
                            }
                            
                        }
                    }
                    
                    echo "<td class=\"numeric\">$nodeCount</td>";
                    echo "<td class=\"numeric\">$sensorCount</td>";
                    echo "<td class=\"numeric\">$onConunt</td>";
                    echo "<td class=\"numeric\">$offCount</td>";
                    echo "<td class=\"numeric\">$inactiveCount</td>";
                    
                    
                    ?>
                      
                    </tr>
                  </tbody>
                </table>
              </section>
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-lg-4 -->
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
        </p>
        <div class="credits">
          <!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
          Created with Dashio template by <a href="https://templatemag.com/">TemplateMag</a>
        </div>
        <a href="responsive_table.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
</body>

</html>