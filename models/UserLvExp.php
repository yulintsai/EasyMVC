
    <?php
include_once("mysql.inc.php");
session_start();
$u_id=$_SESSION['u_id'];
$sql="SELECT SUM(score) FROM `GameLog` WHERE u_id='$u_id'";//players total
$score=$mysqli->query($sql);
if($score){
$PlayerScore=$score->fetch_assoc();
$p_score=$PlayerScore['SUM(score)'];
//echo "Total Exp = ".$p_score."<br>";//總分
$lv=(ceil($p_score/50)+1);
//echo "Lv".$lv."<br>";玩家等級
$exp=(($p_score%50)*2);
//echo "Exp".$exp."%";玩家經驗值


       echo"<div id='lv'>Lv.".$lv."</div>
            <div id='user'>".(strtoupper($_SESSION['user_id']))."</div>
            <div class='progress progress-striped'><div class='progress-bar progress-bar-success' role='progressbar' 
      aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' id='exp'style='width:$exp%'"."title=".$p_score."/".($lv*50).">".(($p_score%50)*2)."%</div></div>";

}else{
    echo "error";
}
$mysqli->close();
?>
    
    
    
  