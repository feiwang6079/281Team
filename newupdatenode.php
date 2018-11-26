
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
<a class="active" href="newindex.php?building=1">
<i class="fa fa-th"></i>
<span>Sensors </span>
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
include 'config.php';

$building = $_GET['building'];
$cluster_id = $_GET['clusterid'];
$floor_sql = "select location from floor where floor_cluster_id = $cluster_id";
$result = mysqli_query($conn, $floor_sql);
$row = mysqli_fetch_assoc($result);
echo 'Cluster location: ';
echo $row['location'] ;


?>
        
        </h3>

        <!-- FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
            <h4><i class="fa fa-angle-right"></i> Insert room node</h4>
            <div class="form-panel">
              <div class=" form">
                <form class="cmxform form-horizontal style-form" id="commentForm" method="post" action="#">           
                  <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Node id </label>
                    <div class="col-lg-10">
                    
                     <?php    
                         
                         $id = (int) $_GET['nodeid'];
                         
                         $sql = "select * from node where node_id = $id";
                         $result = mysqli_query($conn, $sql);
                         $row = mysqli_fetch_assoc($result);
                         
                         $nodeid = $row['node_id'];
                         $location = $row['location'];
                         $time = $row['time'];
                         
                         if(isset($_POST["location"]) && isset($_POST["id"]))
                         {
                             $nodeid = $_POST["id"];
                             $location = $_POST["location"];
                         }
                         
                     
                        echo "<input class=\" form-control\" name=\"id\"  type=\"text\" value = \"$nodeid\" required />";
                     ?>
                   
                   
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-2">Node location </label>
                    <div class="col-lg-10">
                    <?php
                    echo "<input class=\"form-control \" name=\"location\" value =\"$location\" required />";
                     ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button class="btn btn-theme" type="submit">Save</button>
                         <?php    
                          echo "<button class=\"btn btn-theme04\" type=\"button\" onclick=\"window.location.href='newindex.php?building=$building&clusterid=$cluster_id'\">Cancel</button>";
                         ?>
                    </div>
                  </div>
                  
      <?php    
      
    if(isset($_POST["location"]) && isset($_POST["id"]))
    {
        
        $nodeid = $_POST["id"];
        $location = $_POST["location"];
        
        if(strcmp($nodeid, $row['node_id']) == 0 && strcmp($location, $row["location"])==0 && strcmp($time, $row['time'])==0)
        {
            echo "<div>please enter different data</div>";
        }
        else 
        {
            $sql = "update node set node_id = $nodeid, location = '$location' where node_id = $id";
            
            if (mysqli_query($conn, $sql)) {
                echo "<div> insert success</div> ";
            }else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        }
       
    }
                  
    ?>
                  
                </form>
              </div>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
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
        <a href="form_validation.html#" class="go-top">
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
  <script src="lib/form-validation-script.js"></script>

</body>

</html>
