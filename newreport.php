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
        <h3><i class="fa fa-angle-right"></i> 
        
        <?php 

$count_sql = "select * from building where building_id = $building";
$result = mysqli_query($conn, $count_sql);
$row = mysqli_fetch_assoc($result);
echo 'Building Name: ';
echo $row['building_name'] . '<br>';
// echo 'Building Address: ';
// echo $row['building_address'];

?>
        </h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> 
              
                      <?php 
if(isset($_GET['nodeid']))
{
    $node_id = $_GET['nodeid'];
    
    $floor_sql = "select location from node where node_id = $node_id";
    $result = mysqli_query($conn, $floor_sql);
    $row = mysqli_fetch_assoc($result);
    echo 'Node location: ';
    echo $row['location'] ;
}   
else if(isset($_GET['clusterid']))
{
    $cluster_id = $_GET['clusterid'];
    
    $floor_sql = "select location from floor where floor_cluster_id = $cluster_id";
    $result = mysqli_query($conn, $floor_sql);
    $row = mysqli_fetch_assoc($result);
    echo 'Cluster location: ';
    echo $row['location'] ;
}
else if(isset($_GET['building']))
{
    echo 'Building Address: ';
    echo $row['building_address'];
}
                      


?>
              </h4>
              <section id="unseen">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
  <?php                 
      
    if(isset($_GET['nodeid']))
    {
        $building_id = $_GET['building'];
        $cluster_id = $_GET['clusterid'];
        $node_id = $_GET['nodeid'];
        
//         $floor_sql = "select location from node where node_id = $node_id";
//         $result = mysqli_query($conn, $floor_sql);
//         $row = mysqli_fetch_assoc($result);
        $location = $row['location'];
        
        $count_sql = "select count(sensor_id) as c from node_sensor where node_id = $node_id";
        $result = mysqli_query($conn, $count_sql);
        $data = mysqli_fetch_assoc($result);
        $count = $data['c'];
        
        //得到总的用户数
        $count = $data['c'];
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $num = 5;
        $total = ceil($count / $num);
        if ($page <= 1) {
            $page = 1;
        }
        if ($page >= $total) {
            $page = $total;
        }
        
        $offset = ($page - 1) * $num;
        $sql = "select sensor_id from node_sensor where node_id = $node_id order by sensor_id desc limit $offset , $num";
        $result = mysqli_query($conn, $sql);
        
        if($result == false)
        {

            echo "<tr><div align=\"center\"><input type=\"button\" value=\" add new sensor \" 
                                                   onclick=\"window.location.href='newaddsensor.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id'\">
                                                    </div></td></tr>";
            
        }
        else
        {
        
        echo '<tr>';
        echo '<td>' . 'Device id' . '</td>';
        echo '<td>' . 'Device type' . '</td>';
        echo '<td>' . 'Status' . '</td>';
        echo '<td>' . 'location' . '</td>';
        echo '<td>' . 'Install time' . '</td>';
        echo '<td>' . 'update' . '</td>';
        echo '<td>' . 'delete' . '</td>';
        echo '</tr>';
        
        while ($row = mysqli_fetch_assoc($result)) {
            
            $sensor_id = $row['sensor_id'];
            $nodeSql = "select * from sensor where sensor_id = $sensor_id";
            $resultSql = mysqli_query($conn, $nodeSql);
            $room = mysqli_fetch_assoc($resultSql);
            
            echo '<tr>';
            echo '<td>' . $room['sensor_id'] . '</td>';
            echo '<td>' . $room['sensor_type'] . '</td>';
            echo '<td>' . $room['sensor_status'] . '</td>';
            echo '<td>' . $location . '</td>';
            echo '<td>' . $room['time'] . '</td>';
            echo "<td><a href=\"newupdatesensor.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id&sensorid=" . $row['sensor_id'] . '">update</a></td>';
            echo "<td><a href=\"delete.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id&sensorid=" . $row['sensor_id'] . '">delete</a></td>';
            echo '</tr>';
            }
         echo "<tr><td colspan=\"7\">
                                    <div align=\"right\">
                                    <a href=\"newindex.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id&page=1\">Main
                                    </a>  <a href=\"newindex.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id&page=" . ($page - 1) . "\">Previous
                                    </a>   <a href=\"newindex.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id&page=" . ($page + 1) . "\">Next
                                    </a>  <a href=\"newindex.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id&page=" . $total . "\">Last
                                    </a>  Current " . $page . 'Total' . $total."
                                    </div>
                                    <div align=\"center\">
                                        <input type=\"button\" value=\" add new sensor \" 
                                        onclick=\"window.location.href='newaddsensor.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id'\"> 
                                    </div></td></tr>";
        
        }
    }
    
    //展示node列表
    
    else if(isset($_GET['clusterid']))
    {
        $building_id = $_GET['building'];
        $cluster_id = $_GET['clusterid'];
        
//         $floor_sql = "select location from floor where floor_cluster_id = $cluster_id";
//         $result = mysqli_query($conn, $floor_sql);
//         $row = mysqli_fetch_assoc($result);
//         echo 'Cluster location: ';
//         echo $row['location'] . '<br>';
        
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        
        $count_sql = "select count(node_id) as c from floor_node where floor_cluster_id = $cluster_id";
        $result = mysqli_query($conn, $count_sql);
        $data = mysqli_fetch_assoc($result);
        $count = $data['c'];
        
        $num = 5;
        $total = ceil($count / $num);
        
        if ($page <= 1) {
            $page = 1;
        }
        if ($page >= $total) {
            $page = $total;
        }
        
        $offset = ($page - 1) * $num;
        $sql = "select node_id from floor_node where floor_cluster_id = $cluster_id order by node_id desc limit $offset , $num";
        
        $result = mysqli_query($conn, $sql);
        
        if($result == false)
        {
            echo "<tr><div align=\"center\"><input type=\"button\" value=\" add new node \" 
                                                   onclick=\"window.location.href='newaddnode.php?building=$building_id&clusterid=$cluster_id'\"> 
                                                    </div></td></tr>";
            
        }
        else 
        {
            echo '<tr>';
            echo '<td>' . 'Device id' . '</td>';
            echo '<td>' . 'Device type' . '</td>';
            echo '<td>' . 'Status' . '</td>';
            echo '<td>' . 'Location' . '</td>';
            echo '<td>' . 'Install time' . '</td>';
            echo '<td>' . 'update' . '</td>';
            echo '<td>' . 'delete' . '</td>';
            echo '</tr>';
            
            while ($row = mysqli_fetch_assoc($result)) {
                
                $node_id = $row['node_id'];
                $nodeSql = "select * from node where node_id = $node_id";
                $resultSql = mysqli_query($conn, $nodeSql);
                $room = mysqli_fetch_assoc($resultSql);
                
                echo '<tr>';
                echo "<td><a href=\"newindex.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id\">" . $node_id . '</td>';
                echo '<td>Node</td>';
                echo '<td>' . $room['status'] . '</td>';
                echo '<td>' . $room['location'] . '</td>';
                echo '<td>' . $room['time'] . '</td>';
                echo "<td><a href=\"newupdatenode.php?building=$building_id&clusterid=$cluster_id&nodeid=" . $node_id . '">update</a></td>';
                echo "<td><a href=\"delete.php?building=$building_id&clusterid=$cluster_id&nodeid=" . $node_id . '">delete</a></td>';
                echo '</tr>';
            }
            echo "<tr><td colspan=\"7\">
                                        <div align=\"right\" >
                                        <a href=\"newindex.php?building=$building_id&clusterid=$cluster_id&page=1\">Main
                                        </a>  <a href=\"newindex.php?building=$building_id&clusterid=$cluster_id&page=" . ($page - 1) . "\">Previous
                                        </a>   <a href=\"newindex.php?building=$building_id&clusterid=$cluster_id&page=" . ($page + 1) . "\">Next
                                        </a>  <a href=\"newindex.php?building=$building_id&clusterid=$cluster_id&page=" . $total . "\">Last
                                        </a>  Current " . $page . 'Total' . $total."
                                        </div>
                                        <div align=\"center\">
                                            <input type=\"button\" value=\" add new node \" 
                                            onclick=\"window.location.href='newaddnode.php?building=$building_id&clusterid=$cluster_id'\"> 
                                        </div> </td></tr>";
        }
    }
    
    //展示cluster列表
    
    else if(isset($_GET['building']))
    {
        $building_id = $_GET['building'];
        
        $count_sql = "select count(floor_cluster_id) as c from building_floor where building_id = $building_id";
        $result = mysqli_query($conn, $count_sql);
        $data = mysqli_fetch_assoc($result);
        $count = $data['c'];
        
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        
        $num = 5;
        $total = ceil($count / $num);
        if ($page <= 1) {
            $page = 1;
        }
        if ($page >= $total) {
            $page = $total;
        }
        
        $offset = ($page - 1) * $num;
        $sql = "select floor_cluster_id from building_floor where building_id = $building_id order by floor_cluster_id desc limit $offset , $num";
        $result = mysqli_query($conn, $sql); 
        
        if($result == false)
        {
            echo "<tr><div align=\"center\"><input type=\"button\" value=\" add new floor cluster\" onclick=\"window.location.href='newadd.php?building=$building_id'\"> </div></tr>";
            
        }
        else {
            
            echo '<tr>';
            echo '<td>' . 'Device id' . '</td>';
            echo '<td>' . 'Device type' . '</td>';
            echo '<td>' . 'Status' . '</td>';
            echo '<td>' . 'Location' . '</td>';
            echo '<td>' . 'Install time' . '</td>';
            echo '<td>' . 'update' . '</td>';
            echo '<td>' . 'delete' . '</td>';
            echo '</tr>';
            
            while ($row = mysqli_fetch_assoc($result)) {
                
                $cluster_id = $row['floor_cluster_id'];
                $floorSql = "select * from floor where floor_cluster_id = $cluster_id";
                $resultSql = mysqli_query($conn, $floorSql);
                $floor = mysqli_fetch_assoc($resultSql);
                
                echo '<tr>';
                echo "<td><a href=\"newindex.php?building=$building_id&clusterid=$cluster_id\">" . $cluster_id . '</td>';
                echo '<td>FCluster</td>';
                echo '<td>' . $floor['status'] . '</td>';
                echo '<td>' . $floor['location'] . '</td>';
                echo '<td>' . $floor['time'] . '</td>';
                
                echo "<td><a href=\"newupdate.php?building=$building_id&clusterid=$cluster_id\">update</a></td>";
                echo "<td><a href=\"delete.php?building=$building_id&clusterid=$cluster_id\">delete</a></td>";
                echo '</tr>';
            }
         
         echo "<tr><td colspan=\"7\"> 
                                    <div align=\"right\" ><a href=\"newindex.php?building=$building_id&page=1\">Main
                                    </a>  <a href=\"newindex.php?building=$building_id&page=" . ($page - 1) . "\">Previous
                                    </a>   <a href=\"newindex.php?building=$building_id&page=" . ($page + 1) . "\">Next
                                    </a>  <a href=\"newindex.php?building=$building_id&page=" . $total . "\">Last
                                    </a>  Current " . $page . 'Total' . $total."
                                    </div>
                                    <div align=\"center\"><input type=\"button\" value=\" add new floor cluster\" 
                                           onclick=\"window.location.href='newadd.php?building=$building_id'\">
                                    </div></td></tr>";
            
        }

    }
    ?>

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
