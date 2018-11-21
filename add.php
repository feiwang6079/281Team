
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
<h1 style = "text-align:center">Infrastructure Add</h1>
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
<br><br><br><br><br><br>

<?php 

include 'config.php';

$building = $_GET['building'];

$count_sql = "select * from building where building_id = $building";
$result = mysqli_query($conn, $count_sql);
$row = mysqli_fetch_assoc($result);
echo 'Building Name: ';
echo $row['building_name'] . '<br>';
echo 'Building Address: ';
echo $row['building_address'].'<br><br>';

if(isset($_GET["nodeid"]))
{
    $node_id = $_GET["nodeid"];
    $cluster_id = $_GET['clusterid'];
    
    $floor_sql = "select location from node where node_id = $node_id";
    $result = mysqli_query($conn, $floor_sql);
    $row = mysqli_fetch_assoc($result);
    echo 'Node location: ';
    echo $row['location'] . '<br><br>';
    
    
    echo '<form action="#" method="post">';
    echo 'sensor id : <input type="text" name="id"><br>';
    echo 'sensor type : <input type="text" name="type"><br>';
    echo 'sensor status : <input type="text" name="status"><br>';
    echo "<input type=\"button\" value=\"return\" onclick=\"window.location.href='index.php?building=$building&clusterid=$cluster_id&nodeid=$node_id'\">";
    echo '<input type="submit" value="submit"></form>';
    
    if(isset($_POST["type"])&&isset($_POST["id"]) & isset($_POST["status"]))
    {
        $type=$_POST["type"];
        $id=$_POST["id"];
        $status = $_POST["status"];
        
        $sql = "INSERT INTO node_sensor (node_id, sensor_id) VALUES ($node_id, $id)";
        
        if (mysqli_query($conn, $sql)) {
//             echo "insert success";
            $sql = "INSERT INTO sensor (sensor_id, sensor_type, sensor_status) VALUES ($id, '$type', $status)";
            
            if (mysqli_query($conn, $sql)) {
                //             echo "insert success";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } 
}

else if(isset($_GET["clusterid"]))
{
    $cluster_id = $_GET['clusterid'];
    $floor_sql = "select location from floor where floor_cluster_id = $cluster_id";
    $result = mysqli_query($conn, $floor_sql);
    $row = mysqli_fetch_assoc($result);
    echo 'Cluster location: ';
    echo $row['location'] . '<br>';
   
    echo '<form action="#" method="post">';
    echo 'node id : <input type="text" name="id"><br>';
    echo 'node location : <input type="text" name="location"><br>';
    echo "<input type=\"button\" value=\"return\" onclick=\"window.location.href='index.php?building=$building&clusterid=$cluster_id'\">";
    echo '<input type="submit" value="submit"></form>';
    
    if(isset($_POST["location"]) && isset($_POST["id"]))
    {
        $id=$_POST["id"];
        $location=$_POST["location"];
        
        $sql = "INSERT INTO floor_node (floor_cluster_id, node_id) VALUES ($cluster_id, $id)";
        if (mysqli_query($conn, $sql)) {
            //             echo "insert success";
            
            $sql = "INSERT INTO node (node_id, location) VALUES ($id, '$location')";
            
            if (mysqli_query($conn, $sql)) {
                //             echo "insert success";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
else if(isset($_GET["building"]))
{
    
    echo '<form action="#" method="post">';
    echo 'cluster id : <input type="text" name="id"><br>';
    echo 'cluster location : <input type="text" name="location"><br>';
    echo "<input type=\"button\" value=\"return\" onclick=\"window.location.href='index.php?building=$building'\">";
    echo '<input type="submit" value="submit"></form>';
        
    if(isset($_POST["location"]) && isset($_POST["id"]))
    {
        $id=$_POST["id"];
        $location=$_POST["location"];
        
        $sql = "INSERT INTO building_floor (building_id, floor_cluster_id) VALUES ($building, $id)";
        
        if (mysqli_query($conn, $sql)) {
//             echo "insert success";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        $sql = "INSERT INTO floor (floor_cluster_id, location) VALUES ($id, '$location')";
        
        if (mysqli_query($conn, $sql)) {
//             echo "insert success";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
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

