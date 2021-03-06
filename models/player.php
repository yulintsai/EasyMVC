<?php
    class player{
        
        public function __construct(){
                Server::pdoConnect();
                Server::setConnect();
        }
          
        public function CountOnlinePlayer($min){
            
            $d=strtotime("-".$min."min");//以五分鐘為計算計算在線數
            $time1 = date("Y-m-d H:i:s",$d);
            $time2 = date("Y-m-d H:i:s");//現在時間
            $sql="SELECT COUNT(DISTINCT `u_id`)
                FROM  `UserLoginTime` 
                WHERE `Time`
                BETWEEN (
                 '$time1'
                )
                AND (
                 '$time2'
                )";//顯示在線人數sql語法
    
            $ans=Server::$db->query($sql)->fetch();
            return "Online Players<br>".$ans[0];//在線人數
        }//計算線上人數
        
        public function showGlobalRank(){
            
              $rank_sql="SELECT DISTINCT `id`,`score` FROM `GameLog` ORDER BY `score` DESC ,`time` ASC LIMIT 5";
              $rank_score=Server::$db->query($rank_sql)->fetchAll();
              return $rank_score;
            
        }//查看全部玩家排行
        
        public function showUserLogScore(){
            
                $u_id=$_SESSION['u_id'];
                $myscore_sql="SELECT DISTINCT `score` FROM `GameLog` WHERE `u_id`='$u_id' ORDER BY `score` DESC LIMIT 6";
                $result=Server::$db->query($myscore_sql)->fetchAll();
                return $result;
            }//查看分數紀錄
        
        public function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          $data = Server::$mysqli->real_escape_string($data);
          return $data;
        } //過濾Input
        
        public function GoSignup(){
            
            $msg1="<script> alert('";
            $msg2="');location.href='/EasyMVC'</script>";
    
            if(isset($_POST['signup'])){
                
                $check=0;
                
                if (($_POST["Account"])=="" ){
                        return $msg1."Account empty".$msg2;}
                    else{
                        $account=$this->test_input($_POST["Account"]) ;
                        if (!preg_match("/^[a-zA-Z ]*$/",$account)) {
                            $AccountErr = "Only letters and white space allowed"; 
                            return  $msg1.$AccountErr.$msg2;
                            $check++;
                        }
                    }
                    
                if((($_POST['Password'])||($_POST['RePassword']))==""){
                        return $msg1."password empty".$msg2;
                    }
                    else{$check++;}
                        
                if($_POST['Password']!=$_POST['RePassword']){
                        return $msg1."password not the same".$msg2;}
                    else{
                        $pw=$this->test_input($_POST['Password']);
                        $pw = md5($_POST["Password"]);
                        $check++;
                        }
                        
                if($_POST['Email']==""){
                       return $msg1."E-mail empty".$msg2;}
                    else{
                      $email=$this->test_input($_POST['Email']);
                      $check++; 
                    }
                  
                if($check>2){
                      $ip=$_POST['u_ip'];
                      $username=$this->test_input($_POST['Username']);
                       //check account 重複
                      $sql = "SELECT `account` FROM `UserData` WHERE `account`='$account'";
                      $result= Server::$db->query($sql)->fetch();
                     
                      if($account==$result[0]){
                          return  $msg1.'The account is been use!'.$msg2; ;
                      }else{
                    
                        $sql="INSERT INTO `UserData`(`account`,`id`,`pwd`,`email`,`ip`)VALUES(:account,:username,:pw,:email,:ip)";
                        
                        $ans=Server::$db->prepare($sql);
                        $ans->bindParam(':account',$account);
                        $ans->bindParam(':username',$username);
                        $ans->bindParam(':pw',$pw);
                        $ans->bindParam(':email',$email);
                        $ans->bindParam(':ip',$ip);
                        $ans->execute();
                          if($ans->execute())
                                {
                                        return  $msg1.'Sign up Success!'.$msg2; ;
                                }
                                else
                                {
                                        return  $msg1.'Sign up ERROR!'.$msg2; ;
                                }
                            }
                    
                }
                    else{
                        return  $msg1."NO Check all".$msg2; ;
                    }
                    
            }else{//非註冊人禁止進入
                return  $msg1."違法使用".$msg2;
              }   
            }//註冊帳號
        
        public function UpdateStatus($status,$myip){
            
            $u_id=$_SESSION['u_id'];
            $updateStatue="INSERT INTO `UserLoginTime`(`u_id`,`Status`,`IP`) VALUES (:u_id,:status,:myip)";
            $ans=Server::$db->prepare($updateStatue);
            $ans->bindParam(':u_id',$u_id);
            $ans->bindParam(':status',$status);
            $ans->bindParam(':myip',$myip);
            $ans->execute();
            
        }//更新狀態
            
        public function UserLvExp(){
                $user_id=strtoupper($_SESSION['user_id']);
                $u_id=$_SESSION['u_id'];
                $sql="SELECT SUM(score) FROM `GameLog` WHERE u_id='$u_id'";//players total
                $PlayerScore=Server::$db->query($sql)->fetch(PDO::FETCH_ASSOC);
                $p_score=$PlayerScore['SUM(score)'];//總分
                $result=array("score"=>$p_score,"user_id"=>$user_id);
                return $result;
                
        }//計算玩家等級經驗值
        
        public function addVisitor(){
            
            $sql="UPDATE information SET visit_num=visit_num+1";//games total
            return (Server::$db->query($sql));
        }//更新登入次數
        
        
        
        
    }
?>