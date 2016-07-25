<?php
class player{
    function CountOnlinePlayer(){
        include_once("mysql.inc.php");
        $d=strtotime("-5min");//以五分鐘為計算計算在線數
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
        $OnlineCount=$mysqli->query($sql);
        if($OnlineCount){
        $ans=$OnlineCount->fetch_row();
        //echo var_dump($ans);
        echo "Online Players<br>".$ans[0];}//在線人數
        else{
            echo "Error";
        }
    }//計算線上人數
    
    function GlobalRank(){
          session_start();
          include_once("mysql.inc.php");
          $rank_sql="SELECT distinct id,score FROM GameLog order by score desc ,time asc limit 5";
          $rank_score=$mysqli->query($rank_sql);
          $result_rankscore=$rank_score->fetch_all();
          echo "<table border='1px'width='100%' height='100%'> <td>Rank</td><td>ID</td><td>Score</td>";
        foreach ($result_rankscore as $key=>$value) {
           echo "<tr><td>".($key+1)."</td><td>".$value[0]."</td><td>".$value[1]."</td></tr>";
          }
          echo "</table>";
    }//全部玩家排行
    
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
    //   $this->GoSignup()
      return $data;
    } //檢查Input
    
    function GoSignup(){
        include_once("mysql.inc.php");
        $email=$this->test_input($_POST['Email']);
        $msg1="<script> alert('Please input Your ";
        $msg2="');location.href='/EasyMVC' </script>";

if(isset($_POST['signup'])){
    $check=0;
    if (empty($_POST["Account"]) ){
            $idErr="Name is required";
            echo $idErr;
            echo $msg1."Name".$msg2;
     }else{
            $account=$this->test_input($_POST["Account"]) ;
            $username=trim($_POST["Username"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$account)) {
                
            $nameErr = "Only letters and white space allowed"; 
            $check++;  
            }
        }
    if(empty($_POST['Password'])or empty($_POST['RePassword']) ){
            echo $msg1."password".$msg2;
            $pwdErr="Password is Empty";
    }else{
        $check++; 
    }
            
    if($_POST['Password']!=$_POST['RePassword']){
            echo $msg1."password again".$msg2;
            $pwdErr="Password is NOT the Same";
    }else{
        $check++; 
    }
            
    if(empty($email) ){
           $emailErr="E-mail is Empty";
           echo $msg1."E-mail".$msg2;
        }else{
          $pw=$this->test_input($_POST['Password']);
          $pw = md5($_POST["Password"]);
          $check++; 
        }
          
          
    if($check>2){
          
          $ip=$_POST['u_ip'];
          $account=$mysqli->real_escape_string($account);
          $username=$mysqli->real_escape_string($username);
          $pw=$mysqli->real_escape_string($pw);
          $email=$mysqli->real_escape_string($email);
          
          //check account 重複
        $sql = "SELECT account FROM UserData WHERE account='$account'";
        $CheckSameAc=$mysqli->query($sql);
        $result= $CheckSameAc->fetch_row();
             
          if($account==$result[0]){
              echo 'The account is been use!';
              echo '<meta http-equiv=REFRESH CONTENT=2;url=/EasyMVC>';
          }else{
        
            $sql="INSERT INTO UserData(account,id,pwd,email,ip)values('$account','$username','$pw','$email','$ip')";
            
          if($mysqli->query($sql))
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
           $mysqli->close();    
          }   else{
              echo "HI";
          }
    }

else
{           //非註冊人禁止進入
        header("Location: /EasyMVC/");
        
}
    }//註冊帳號
    
    function UpdateStatus(){
        session_start();
        include_once('GetIP.php');
        include_once("mysql.inc.php");
        if($_GET['status']){
        $status=$_GET['status'];
        $u_id=$_SESSION['u_id'];
        $logout="INSERT INTO `UserLoginTime`(`u_id`,`Status`,`IP`) VALUES ('$u_id','$status','$myip')";
        $mysqli->query($logout);
        }else{
            echo "Error";
        }
    }//更新狀態
    
    function UserLogScore(){
        session_start();
        include_once("mysql.inc.php");
        $u_id=$_SESSION['u_id'];
        $myscore_sql="SELECT distinct score FROM GameLog where u_id='$u_id' order by score desc limit 6";
        $mysc=$mysqli->query($myscore_sql);
         "HI";
        if($mysc){
            $result=$mysc->fetch_all();
            echo "<table border='1px'width='100%' height='100%'> <td>NO.</td><td>Score</td>";
            foreach($result as $key=>$value){
               echo "<tr><td>".($key+1)."</td><td>".$result[$key][0]."</td></tr>";
            }
            echo "</table>";
        }else{
            echo "error";
        }
          
        }//查分數紀錄
        
    function UserLvExp(){
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
    }//計算玩家等級經驗值
    
}
?>