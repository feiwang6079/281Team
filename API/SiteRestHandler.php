<?php
require_once("SimpleRest.php");
require_once("Login.php");


class SiteRestHandler extends SimpleRest {
    
    function getLogin($user, $password){
        $login = new Login();
        $isSuccess = $login->getLoginStatus($user, $password);
        $result = array();
        if($isSuccess)
        {
            $statusCode = 200;
            $result = array('result' => true);
        }
        else 
        {
            $statusCode = 200;
            $result = array('error' => 'No sites found!');
        }
        
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this ->setHttpHeaders($requestContentType, $statusCode);
        $response = $this->encodeJson($result);
        echo $response;
    }
    
    function getAllBuilding(){
        $login = new Login();
        $buildings = $login->getAllbuilding();
        
        if(empty($buildings))
        {
            $statusCode = 404;
            $buildings = array('error' => 'No sites found!');
        }else
        {
            $statusCode = 200;
        }
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this ->setHttpHeaders($requestContentType, $statusCode);
        $response = $this->encodeJson($buildings);
        echo $response;
    }
    
    function getFloor($building){
        $login = new Login();
        $floors = $login->getFloor($building);
        
        if(empty($floors))
        {
            $statusCode = 404;
            $floors = array('error' => 'No sites found!');
        }else
        {
            $statusCode = 200;
        }
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this ->setHttpHeaders($requestContentType, $statusCode);
        $response = $this->encodeJson($floors);
        echo $response;
    }
    
    function getNode($floor) {
        $login = new Login();
        $nodes = $login->getNode($floor);
        
        if(empty($nodes))
        {
            $statusCode = 404;
            $nodes = array('error' => 'No sites found!');
        }else
        {
            $statusCode = 200;
        }
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this ->setHttpHeaders($requestContentType, $statusCode);
        $response = $this->encodeJson($nodes);
        echo $response;
    }
        
    public function encodeJson($responseData) {
        $jsonResponse = json_encode($responseData);
        return $jsonResponse;
    }
    
   
}
?>