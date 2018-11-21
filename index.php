
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
<br><br>

<table>
<tr>
<td>
<?php 
include 'config.php';

$building = $_GET['building'];
$count_sql = "select * from building where building_id = $building";
$result = mysqli_query($conn, $count_sql);
$row = mysqli_fetch_assoc($result);
echo 'Building Name: ';
echo $row['building_name'] . '<br>';
echo 'Building Address: ';
echo $row['building_address'];

?>
</td>
</tr>

<tr>
<td>

</td>
</tr>

<tr>
<td>
<?php 

//展示sensor列表
if(isset($_GET['nodeid']))
{
    $building_id = $_GET['building'];
    $cluster_id = $_GET['clusterid'];
    $node_id = $_GET['nodeid'];
    
//     $floor_sql = "select location from floor where floor_cluster_id = $cluster_id";
//     $result = mysqli_query($conn, $floor_sql);
//     $row = mysqli_fetch_assoc($result);
//     echo 'Cluster location: ';
//     echo $row['location'] . '<br>';
    
    $floor_sql = "select location from node where node_id = $node_id";
    $result = mysqli_query($conn, $floor_sql);
    $row = mysqli_fetch_assoc($result);
    echo 'Node location: ';
    echo $row['location'] . '<br>';
    $location = $row['location'];
    
    $count_sql = 'select count(sensor_id) as c from node_sensor';
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
    $sql = "select sensor_id, sensor_type, time from sensor order by sensor_id desc limit $offset , $num";
    $result = mysqli_query($conn, $sql);
    echo '<table width="800" border="1">';
    
    echo '<tr>';
    echo '<td>' . 'Device id' . '</td>';
    echo '<td>' . 'Device type' . '</td>';
    echo '<td>' . 'location' . '</td>';
    echo '<td>' . 'Install time' . '</td>';
    echo '<td>' . 'update' . '</td>';
    echo '<td>' . 'delete' . '</td>';
    echo '</tr>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        
        echo '<tr>';
        echo '<td>' . $row['sensor_id'] . '</td>';
        echo '<td>' . $row['sensor_type'] . '</td>';
        echo '<td>' . $location . '</td>';
        echo '<td>' . $row['time'] . '</td>';
        echo "<td><a href=\"update.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id&sensorid=" . $row['sensor_id'] . '">update</a></td>';
        echo "<td><a href=\"delete.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id&sensorid=" . $row['sensor_id'] . '">delete</a></td>';
        echo '</tr>';
    }
    echo "<tr><td colspan=\"6\"><a href=\"index.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id&page=1\">Main</a>  <a href=\"index.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id&page=" . ($page - 1) . "\">Previous</a>   <a href=\"index.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id&page=" . ($page + 1) . "\">Next</a>  <a href=\"index.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id&page=" . $total . "\">Last</a>  Current " . $page . 'Total' . $total;
    echo "<input type=\"button\" value=\" add new sensor \" onclick=\"window.location.href='newaddsensor.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id'\"> </td></tr>";
    echo '</table>';
}

//展示node列表

else if(isset($_GET['clusterid']))
{
    $building_id = $_GET['building'];
    $cluster_id = $_GET['clusterid'];
    
    $floor_sql = "select location from floor where floor_cluster_id = $cluster_id";
    $result = mysqli_query($conn, $floor_sql);
    $row = mysqli_fetch_assoc($result);
    echo 'Cluster location: ';
    echo $row['location'] . '<br>';
      
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
    echo '<table width="800" border="1">';
    
    echo '<tr>';
    echo '<td>' . 'Device id' . '</td>';
    echo '<td>' . 'Device type' . '</td>';
    echo '<td>' . 'location' . '</td>';
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
        echo "<td><a href=\"index.php?building=$building_id&clusterid=$cluster_id&nodeid=$node_id\">" . $node_id . '</td>';
        echo '<td>Node</td>';
        echo '<td>' . $room['location'] . '</td>';
        echo '<td>' . $room['time'] . '</td>';
        echo "<td><a href=\"update.php?building=$building_id&clusterid=$cluster_id&nodeid=" . $node_id . '">update</a></td>';
        echo "<td><a href=\"delete.php?building=$building_id&clusterid=$cluster_id&nodeid=" . $node_id . '">delete</a></td>';
        echo '</tr>';
    }
    echo "<tr><td colspan=\"6\"><a href=\"index.php?building=$building_id&clusterid=$cluster_id&page=1\">Main</a>  <a href=\"index.php?building=$building_id&clusterid=$cluster_id&page=" . ($page - 1) . "\">Previous</a>   <a href=\"index.php?building=$building_id&clusterid=$cluster_id&page=" . ($page + 1) . "\">Next</a>  <a href=\"index.php?building=$building_id&clusterid=$cluster_id&page=" . $total . "\">Last</a>  Current " . $page . 'Total' . $total;
    echo "<input type=\"button\" value=\" add new node \" onclick=\"window.location.href='add.php?building=$building_id&clusterid=$cluster_id'\"> </td></tr>";
    echo '</table>';
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
    echo '<table width="800" border="1">';
    
    echo '<tr>';
    echo '<td>' . 'Device id' . '</td>';
    echo '<td>' . 'Device type' . '</td>';
    echo '<td>' . 'location' . '</td>';
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
        echo "<td><a href=\"index.php?building=$building_id&clusterid=$cluster_id\">" . $cluster_id . '</td>';
        echo '<td>FCluster</td>';
        echo '<td>' . $floor['location'] . '</td>';
        echo '<td>' . $floor['time'] . '</td>';
        echo '<td><a href="update.php?building=$building_id&clusterid=' . $cluster_id . '">update</a></td>';
        echo '<td><a href="delete.php?building=$building_id&clusterid=' . $cluster_id . '">delete</a></td>';
        echo '</tr>';
    }
    echo "<tr><td colspan=\"6\"><a href=\"index.php?building=$building_id&page=1\">Main</a>  <a href=\"index.php?building=$building_id&page=" . ($page - 1) . "\">Previous</a>   <a href=\"index.php?building=$building_id&page=" . ($page + 1) . "\">Next</a>  <a href=\"index.php?building=$building_id&page=" . $total . "\">Last</a>  Current " . $page . 'Total' . $total;
    echo "<input type=\"button\" value=\" add new floor cluster\" onclick=\"window.location.href='add.php?building=1'\"> </td></tr>";
    echo '</table>';
}

?>
</td>
</tr>
</table>


<tr>
<td class="bottle" colspan="2" >
feiwang.tech</td>
</tr>

</table>

</body>
</html>

