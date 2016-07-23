<?php
/*include("mysql.inc.php");
$u_id=$_SESSION['u_id'];
$delete="DELETE FROM `UserLoginTime` WHERE u_id='$u_id'";
$go_delete=mysqli_query($link,$delete);
mysqli_close($link); */
session_start();
session_unset();
header("Location:/EasyMVC/Home/loginPage");
?>