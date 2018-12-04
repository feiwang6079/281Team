<?php

require_once("SiteRestHandler.php");

$view = "";
if(isset($_GET["view"]))
    $view = $_GET["view"];

    switch($view){
        
        case "login":
                $user = $_GET["user"];
                $password = $_GET["password"];
                $siteRestHandler = new SiteRestHandler();
                $siteRestHandler->getLogin($user, $password);
                break;
           
        case "buildinglist":
                $siteRestHandler = new SiteRestHandler();
                $siteRestHandler->getAllBuilding();
                break;
                    
        case "floorlist":
                $building = $_GET["building"];
                $siteRestHandler = new SiteRestHandler();
                $siteRestHandler->getFloor($building);
                
        case "" :
            //404 - not found;
            break;
    }
 ?>