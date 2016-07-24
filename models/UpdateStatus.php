<?php
session_start();
require_once 'models/GetIP.php';
include_once 'models/mysql.inc.php';
if($_GET['status']){
$status=$_GET['status'];
$u_id=$_SESSION['u_id'];
$logout="INSERT INTO `UserLoginTime`(`u_id`,`Status`,`IP`) VALUES ('$u_id','$status','$myip')";
$go_logout=mysqli_query($link,$logout);
}else{
    echo "bye";
}
?>