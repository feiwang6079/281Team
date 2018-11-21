
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"> 
<link rel="stylesheet" type="text/css" href="content.css">
<title>Fei Wang</title> 
</head>
<body>

<table style="width:100%">
<tr>
<td colspan="2" style="background-color:#FFA500;">
<h1 style = "text-align:center">Infrastructure Management</h1>
</td>
</tr>

<tr>
<td class="list">
<b>My Building</b><br>
<a href="index.php?building=1">Building IoT</a><br>
<!-- <a href="index.php">Status Report</a><br> -->
<!-- <a href="index.php">Map View</a><br> -->
</td>
<td class="content">
<br><br><br><br>

<?php 
    include 'config.php';
    $building = $_GET['building'];
    
    //更新sensor
    if(isset($_GET["sensorid"]))
    {
        $cluster_id = $_GET['clusterid'];
        
        $node_id = (int) $_GET['nodeid'];
        $floor_sql = "select location from node where node_id = $node_id";
        $result = mysqli_query($conn, $floor_sql);
        $row = mysqli_fetch_assoc($result);
        echo 'Node location: ';
        echo $row['location'] . '<br><br><br>';
        
        $id = (int) $_GET['sensorid'];
        $sql = "select sensor_type, sensor_status from sensor where sensor_id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $type = $row['sensor_type'];
        $status = $row['sensor_status'];
        
        if(isset($_POST["type"])&&isset($_POST["status"]))
        {
            $type2 = $_POST["type"];
            $status2 = $_POST["status"];
                      
            if(strcmp($type, $type2) == 0 && strcmp($status, $status2)==0)
            {
                echo "please enter different data";
                
                echo '<form action="#" method="post">
               sensor type: <input type="text" name="type" value = "'.$type.'"><br>
               sensor status: <input type="text" name="status" value = "'.$status.'"><br>
               <input type="submit" value="submit">
                </form>';
            }
            else {
                
                $sql = "update sensor set sensor_type = '$type2', sensor_status = $status2 where sensor_id = $id";
                
                if (mysqli_query($conn, $sql)) {
                    echo "insert success";
                    echo "<br>";
                    echo "<input type=\"button\" value=\"return\" onclick=\"window.location.href='index.php?building=$building&clusterid=$cluster_id&nodeid=$node_id'\">";
                    
                        
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    
                    echo '<form action="#" method="post">
               sensor type: <input type="text" name="type" value = "'.$type.'"><br>
               sensor status: <input type="text" name="status" value = "'.$status.'"><br>
               <input type="submit" value="submit">
                </form>';
                }
            }
        }else{
            
            echo '<form action="#" method="post">
               sensor type: <input type="text" name="type" value = "'.$type.'"><br>
               sensor status: <input type="text" name="status" value = "'.$status.'"><br>
               <input type="submit" value="submit">
                </form>';
        }
        
    }
    
    // 更新node
    else if(isset($_GET["nodeid"]))
    {
        $cluster_id = $_GET['clusterid'];
        
        $id = (int) $_GET['nodeid'];
        $floor_sql = "select location from node where node_id = $id";
        $result = mysqli_query($conn, $floor_sql);
        $row = mysqli_fetch_assoc($result);
        echo 'Node location: ';
        echo $row['location'] . '<br><br><br>';
        
        $sql = "select * from node where node_id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $nodeid = $row['node_id'];
        $location = $row['location'];
        $time = $row['time'];
        
        if(isset($_POST["location"])&& isset($_POST["time"]) && isset($_POST["nodeid"]))
        {
            $nodeid2 = $_POST["nodeid"];
            $location2 = $_POST["location"];
            $time2 = $_POST["time"];
            
            if(strcmp($nodeid, $nodeid2) == 0 && strcmp($location, $location2)==0 && strcmp($time, $time2)==0)
            {
                echo "please enter different data <br><br>";
                echo '<form action="#" method="post">';
                echo 'node id: <input type="text" name="nodeid" value = "'.$nodeid2.'"><br>';
                echo 'node location: <input type="text" name="location" value = "'.$location2.'"><br>';
                echo 'node install time: <input type="text" name="time" value = "'.$time2.'"><br>';
                echo "<input type=\"button\" value=\"return\" onclick=\"window.location.href='index.php?building=$building&clusterid=$cluster_id'\">";
                echo '<input type="submit" value="submit"></form>';
            }
            else 
            {
                $sql = "update node set node_id = $nodeid2, location = '$location2' where node_id = $nodeid";
                if (mysqli_query($conn, $sql)) {
                    echo "insert success";
                    echo "<br>";
                    echo "<input type=\"button\" value=\"return\" onclick=\"window.location.href='index.php?building=$building&clusterid=$cluster_id'\">";
                    
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    
                    echo "please enter  again <br>";
                    echo '<form action="#" method="post">';
                    echo 'node id: <input type="text" name="clusterid" value = "'.$nodeid2.'"><br>';
                    echo 'node location: <input type="text" name="location" value = "'.$location2.'"><br>';
                    echo 'node install time: <input type="text" name="time" value = "'.$time2.'"><br>';
                    echo "<input type=\"button\" value=\"return\" onclick=\"window.location.href='index.php?building=$building&clusterid=$cluster_id'\">";
                    echo '<input type="submit" value="submit"></form>';
                }
            }
        }
        else 
        {
            echo '<form action="#" method="post">';
            echo 'node id: <input type="text" name="nodeid" value = "'.$nodeid.'"><br>';
            echo 'node location: <input type="text" name="location" value = "'.$location.'"><br>';
            echo 'node install time: <input type="text" name="time" value = "'.$time.'"><br>';
            echo "<input type=\"button\" value=\"return\" onclick=\"window.location.href='index.php?building=$building&clusterid=$cluster_id'\">";
            echo '<input type="submit" value="submit"></form>';
        }
            
    }
    
    // 更新cluster
    
    else if(isset($_GET["clusterid"]))
    {
        $id = (int) $_GET['clusterid'];
        
        $sql = "select * from floor where floor_cluster_id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $clusterid = $row['floor_cluster_id'];
        $location = $row['location'];
        $time = $row['time'];
        
        if(isset($_POST["location"])&& isset($_POST["time"]) && isset($_POST["clusterid"]))
        {
            $clusterid2 = $_POST["clusterid"];
            $location2 = $_POST["location"];
            $time2 = $_POST["time"];
            
            
            if(strcmp($clusterid, $clusterid2) == 0 && strcmp($location, $location2)==0 && strcmp($time, $time2)==0)
            {
                echo "please enter different data <br>";
                echo '<form action="#" method="post">';
                echo 'cluster id: <input type="text" name="clusterid" value = "'.$clusterid2.'"><br>';
                echo 'cluster location: <input type="text" name="location" value = "'.$location2.'"><br>';
                echo 'cluster install time: <input type="text" name="time" value = "'.$time2.'"><br>';
                echo "<input type=\"button\" value=\"return\" onclick=\"window.location.href='index.php?building=1'\">";
                echo '<input type="submit" value="submit"></form>';
            }
            else {
                
                $sql = "update floor set floor_cluster_id = $clusterid2, location = '$location2' where floor_cluster_id = $id";
                if (mysqli_query($conn, $sql)) {
                    echo "insert success";
                    echo "<br>";
                    echo "<input type=\"button\" value=\"return\" onclick=\"window.location.href='index.php?building=1'\">";
                    
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    
                    echo "please enter  again <br>";
                    echo '<form action="#" method="post">';
                    echo 'cluster id: <input type="text" name="clusterid" value = "'.$clusterid2.'"><br>';
                    echo 'cluster location: <input type="text" name="location" value = "'.$location2.'"><br>';
                    echo 'cluster install time: <input type="text" name="time" value = "'.$time2.'"><br>';
                    echo "<input type=\"button\" value=\"return\" onclick=\"window.location.href='index.php?building=1'\">";
                    echo '<input type="submit" value="submit"></form>';
                }
            }
        }
        else 
        {
            echo '<form action="#" method="post">';
            echo 'cluster id: <input type="text" name="clusterid" value = "'.$clusterid.'"><br>';
            echo 'cluster location: <input type="text" name="location" value = "'.$location.'"><br>';
            echo 'cluster install time: <input type="text" name="time" value = "'.$time.'"><br>';
            echo "<input type=\"button\" value=\"return\" onclick=\"window.location.href='index.php?building=1'\">";
            echo '<input type="submit" value="submit"></form>';
        }
    }
    
?>


</td>
</tr>

<tr>
<td class="bottle" colspan="2" >
feiwang.tech</td>
</tr>

</table>

</body>
</html>

