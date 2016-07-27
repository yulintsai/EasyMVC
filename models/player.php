<?php
class player{
    
    function __construct(){
         Server::setConnect();
    }
    
    function GetIP(){
         if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $myip = $_SERVER['HTTP_CLIENT_IP'];
         }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $myip = $_SERVER['HTTP_X_FORWARDED_FOR'];
         }else{
            $myip= $_SERVER['REMOTE_ADDR'];
         }
         return $myip;
      }
      
    function CountOnlinePlayer($min){
        $d=strtotime("-".$min."min");//以五分鐘為計算計算在線數
        $time1 = date("Y-m-d H:i:s",$d);
        $time2 = date("Y-m-d H:i:s");//現在時間
        $sql="SELECT COUNT(DISTINCT u_id)
            FROM  `UserLoginTime` 
            WHERE Time
            BETWEEN (
             '$time1'
            )
            AND (
             '$time2'
            )";//顯示在線人數sql語法

        $ans=Server::$mysqli->query($sql)->fetch_row();
        echo "Online Players<br>".$ans[0];//在線人數
    }//計算線上人數
    
    function showGlobalRank(){
          $rank_sql="SELECT distinct id,score FROM GameLog order by score desc ,time asc limit 5";
          $rank_score=Server::$mysqli->query($rank_sql)->fetch_all();
          echo "<table border='1px'width='100%' height='100%'> <td>Rank</td><td>ID</td><td>Score</td>";
        foreach ($rank_score as $key=>$value) {
           echo "<tr><td>".($key+1)."</td><td>".$value[0]."</td><td>".$value[1]."</td></tr>";
           }
           echo "</table>";
    }//查看全部玩家排行
    
    function showUserLogScore(){
            $u_id=$_SESSION['u_id'];
            $myscore_sql="SELECT distinct score FROM GameLog where u_id='$u_id' order by score desc limit 6";
            $result=Server::$mysqli->query($myscore_sql)->fetch_all();
            echo "<table border='1px'width='100%' height='100%'> <td>NO.</td><td>Score</td>";
            foreach($result as $key=>$value){
               echo "<tr><td>".($key+1)."</td><td>".$result[$key][0]."</td></tr>";
            }
            echo "</table>";
          
        }//查看分數紀錄
    
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $data = Server::$mysqli->real_escape_string($data);
      return $data;
    } //檢查Input
    
    function GoSignup(){
        $email=$this->test_input($_POST['Email']);
        $msg1="<script> alert('Please input Your ";
        $msg2="');location.href='/EasyMVC'</script>";

    if(isset($_POST['signup'])){
        $check=0;
        
        if (($_POST["Account"])=="" ){
                echo $msg1."Name".$msg2;
         }else{
                $account=$this->test_input($_POST["Account"]) ;
                $username=trim($_POST["Username"]);
                
                if (!preg_match("/^[a-zA-Z ]*$/",$account)) {
                    $nameErr = "Only letters and white space allowed"; 
                    $check++;}
            }
            
        if((($_POST['Password'])||($_POST['RePassword']))==""){
                echo $msg1."password".$msg2;
            }else{$check++;}
                
        if($_POST['Password']!=$_POST['RePassword']){
                echo $msg1."password again".$msg2;
            }else{$check++;}
                
        if($email==""){
               echo $msg1."E-mail".$msg2;}
         else{
              $pw=$this->test_input($_POST['Password']);
              $pw = md5($_POST["Password"]);
              $check++; 
            }
            
        $ip=$_POST['u_ip'];  
        
        if($check>2){
         //check account 重複
        $sql = "SELECT account FROM UserData WHERE account='$account'";
        $result= Server::$mysqli->query($sql)->fetch_row();
             
          if($account==$result[0]){
              echo 'The account is been use!';
              echo '<meta http-equiv=REFRESH CONTENT=2;url=/EasyMVC>';
          }else{
        
            $sql="INSERT INTO UserData(account,id,pwd,email,ip)values('$account','$username','$pw','$email','$ip')";
            
              if(Server::$mysqli->query($sql))
                    {
                            echo 'OK!';
                            echo '<meta http-equiv=REFRESH CONTENT=2;url=/EasyMVC>';
                    }
                    else
                    {
                            echo 'ERROR!';
                            echo '<meta http-equiv=REFRESH CONTENT=2;url=/EasyMVC>';
                    }
                }
            }else{
                echo "NO Check all";
            }
            
        }else{//非註冊人禁止進入
        header("Location: /EasyMVC/");
      }   
    }//註冊帳號
    
    function UpdateStatus(){
        
        $myip=$this->GetIP();
        $status=$_GET['status'];
        $u_id=$_SESSION['u_id'];
        $updateStatue="INSERT INTO `UserLoginTime`(`u_id`,`Status`,`IP`) VALUES ('$u_id','$status','$myip')";
        Server::$mysqli->query($updateStatue);
        
    }//更新狀態
        
    function UserLvExp(){
            $user_id=strtoupper($_SESSION['user_id']);
            $u_id=$_SESSION['u_id'];
            $sql="SELECT SUM(score) FROM `GameLog` WHERE u_id='$u_id'";//players total
            $PlayerScore=Server::$mysqli->query($sql)->fetch_assoc();
            $p_score=$PlayerScore['SUM(score)'];//總分
            $lv=(ceil($p_score/50)+1);//玩家等級
            $exp=(($p_score%50)*2);//玩家經驗值
            
            echo "<div id='lv'>Lv.".$lv."</div>
                 <div id='user'>".$user_id."</div>
                 <div class='progress progress-striped'><div class='progress-bar progress-bar-success' role='progressbar' 
              aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' id='exp'style='width:$exp%'"."title=".$p_score."/".($lv*50).">".$exp."%</div></div>";
            
    }//計算玩家等級經驗值
    
}
?>