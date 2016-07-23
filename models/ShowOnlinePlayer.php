<?php
include("mysql.inc.php");
$d=strtotime("-5min");//以五分鐘為計算計算在線數
$time1 = date("Y-m-d H:i:s",$d);
$time2 = date("Y-m-d H:i:s");
//echo $time1."<br>".$time2."<br>";
//echo "相差".(-(strtotime($time1) - strtotime($time2))/60)."分鐘"; 

$sql="SELECT DISTINCT u_id
    FROM  `UserLoginTime` 
    WHERE Time
    BETWEEN (
     '$time1'
    )
    AND (
     '$time2'
    )";//顯示在線人數sql語法
$OnlineCount=mysqli_query($link,$sql);
if($OnlineCount){
$ans=mysqli_fetch_row($OnlineCount);
echo $ans[0];}//在線人數
else{
    echo "Error";
}
mysqli_close($link); 

?>