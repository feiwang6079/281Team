<?php

// include 'newconfig.php';

Class Login {
    
    public function getLoginStatus($user_name, $user_password){
        
        include 'newconfig.php';
        
//         // 创建连接
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        
        // 检测连接
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        
        $sql = "SELECT id, user_name, user_password FROM user";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            $user = $row["user_name"];
            $password = $row["user_password"];
            
            if((strcmp($user_name, $user) == 0) && (strcmp($user_password, $password)==0))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
    
    public function getAllbuilding(){
        include 'newconfig.php';
        $sql = "select * from building";
        $result = mysqli_query($conn, $sql);
        $array = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $array[] = $row;
        }
        return $array;
    }
    
    public function getFloor($building){
        include 'newconfig.php';
        
        $sql = "select floor_cluster_id from building_floor where building_id = $building order by floor_cluster_id desc";
        $result = mysqli_query($conn, $sql); 
        $array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $cluster_id = $row['floor_cluster_id'];
            $floorSql = "select * from floor where floor_cluster_id = $cluster_id";
            $resultSql = mysqli_query($conn, $floorSql);
            $floor = mysqli_fetch_assoc($resultSql);
            $array[] = $floor;
         }
         return $array;
    }
}
?>