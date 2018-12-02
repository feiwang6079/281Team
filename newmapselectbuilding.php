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
            <a class="active" href="newmapselectbuilding.php">
              <i class="fa fa-map-marker"></i>
              <span>Google Maps </span>
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
      <section class="wrapper site-min-height">
        <div class="row mt">
          <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading">
                Google Map with Loaction List
              </header>
              <div class="panel-body">
              
              <?php 
                   include 'config.php';
              
                   $sql = "select * from building";
                   $result = mysqli_query($conn, $sql);
                   $array = array();
                   while ($row = mysqli_fetch_assoc($result))
                   {
                        $array[] = $row;
                    }
              ?>
              
              <script>

              var map;
              var jsonData;
              function initialize()
              {
                  
                var mapProp = {
                  center: new google.maps.LatLng(37.336451, -121.880437),
                  zoom:8,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                
                map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
				jsonData = <?php echo json_encode($array);?> 
                
                for (var i = 0; i < jsonData.length; i++)
                {
                	var marker = new google.maps.Marker({
                 	  position:new google.maps.LatLng(jsonData[i].latitude, jsonData[i].longitude),
                	});
                 	 marker.setMap(map);

                 	showInfoMessage(marker, i);
//                		google.maps.event.addListener(marker, 'click', function() {
//                			infowindow.open(map,marker);
//                		});
                 } 
              }

              function showInfoMessage(marker, i)
              {
                	var infowindow = new google.maps.InfoWindow({
       	  				content:jsonData[i].building_name
       				});
       				
            	  google.maps.event.addListener(marker, 'click', function(event) {
         			infowindow.open(map,marker);
            	  });
              }

              function loadScript()
              {
                var script = document.createElement("script");
                script.type = "text/javascript";
                script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyAtChepFLHQSDIJy0DzP-24xf3vq5U3Ecg&sensor=false&callback=initialize";
                document.body.appendChild(script);
              }

              window.onload = loadScript;
              </script>
              
				<div id="googleMap" style="width:500px;height:380px;"></div>
              
              
<!--                 <div id="gmap-list"></div> -->
                <div> <br> Engineer Building
<input type="button" value="submit" onclick="window.location.href='newindex.php?building=1'"></div>
              </div>
            </section>
          </div>
        </div>

        <!-- page end-->
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
        <a href="google_maps.html#" class="go-top">
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
  <!--Google Map-->
  <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7"></script>
  <script src="lib/google-maps/maplace.js"></script>
  <script src="lib/google-maps/data/points.js"></script>
  <script>
    //ul list example
    new Maplace({
      locations: LocsB,
      map_div: '#gmap-list',
      controls_type: 'list',
      controls_title: 'Choose a location:'
    }).Load();

  </script>



</body>

</html>
