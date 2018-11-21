
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
<h1 style = "text-align:center">Infrastructure Manager Login Page</h1>

</td>
</tr>

<tr>
<td class="list">
<b>Login</b><br>
</td>
<td class="content">
<br><br><br><br><br><br>
<?php 

include 'config.php';

$sql = "SELECT id, user_name, user_password FROM user";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
    $row = mysqli_fetch_assoc($result);
    $user_name = $row["user_name"];
    $user_password = $row["user_password"];
    
    if((strcmp($_POST["fname"],$user_name) == 0) && (strcmp($_POST["fpassword"],$user_password)==0))
    {
        header("Location: newmapselectbuilding.php");
        //确保重定向后，后续代码不会被执行
        exit;  
    }
    else 
    {
        wrongPassaword();
    }
}
else 
{
    wrongPassaword();
}
function wrongPassaword()
{
    echo "Login Failed"."<form method=\"get\" action=\"login.php\"><button type=\"submit\">Re-Login</button></form>";
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

