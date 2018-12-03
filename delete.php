<<?php
include 'config.php';

if(isset($_GET["sensorid"]))
{
    $building = $_GET['building'];
    $cluster_id = $_GET['clusterid'];
    $node_id = $_GET['nodeid'];
    
    $id = (int) $_GET['sensorid'];
    
    $sql = "DELETE FROM node_sensor where sensor_id = $id";
    if (mysqli_query($conn, $sql))
    {
        
        $sql = "DELETE FROM sensor where sensor_id = $id";
        if (mysqli_query($conn, $sql))
        {
            header("Location: newindex.php?building=$building&clusterid=$cluster_id&nodeid=$node_id");
            
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        
    }

}

else if(isset($_GET["nodeid"]))
{
    $id = (int) $_GET['nodeid'];
    
    $building = $_GET['building'];
    $cluster_id = $_GET['clusterid'];
    
    
    $sql = "DELETE FROM node where node_id = $id";
    if (mysqli_query($conn, $sql))
    {
        $sql = "DELETE FROM floor_node where node_id = $id";
        if (mysqli_query($conn, $sql))
        {
            header("Location: newindex.php?building=$building&clusterid=$cluster_id");
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
else if(isset($_GET["clusterid"]))
{
    $building = $_GET['building'];
    
    $id = (int) $_GET['clusterid'];
    
    $sql = "DELETE FROM floor where floor_cluster_id = $id";
    if (mysqli_query($conn, $sql))
    {
        $sql = "DELETE FROM building_floor where floor_cluster_id = $id";
        if (mysqli_query($conn, $sql))
        {
            header("Location: newindex.php?building=$building");
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    

}


?>