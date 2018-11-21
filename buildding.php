
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
<h1 style = "text-align:center">Building Select</h1>
</td>
</tr>

<tr>
<td class="list">
<b>My Building</b><br>
<a href="index.php">Building IoT</a><br>
<a href="index.php">Status Report</a><br>
<a href="index.php">Map View</a><br>
</td>


<td class="content">
<br><br><br>
Select Building
<br><br><br>
<?php 
include 'config.php';

$sql = "select building_id, building_name from building";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo '<a href="index.php?building='.$row['building_id'].'">'.$row['building_name'].'</a><br><br>';
}

?>
</td>


<tr>
<td class="bottle" colspan="2" >
feiwang.tech</td>
</tr>

</table>

</body>
</html>

