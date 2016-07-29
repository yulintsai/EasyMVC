
<?php
class Login {
   
      function __construct(){
            // Server::setConnect();
            Server::GetIP();
            Server::pdoConnect();
        }
      
      function CheckLogin($account,$password){ 
      
      // 檢查是否輸入使用者名稱和密碼
      if(($account&&$password)==""){
         return "<script>alert('NO input!');location.href='/EasyMVC/'</script>t";
         }else{
            
                  $password=md5($password);
                  
                  // 進行帳密確認
                  $sql = "SELECT * FROM UserData WHERE pwd='";
                  $sql.= $password."' AND account='".$account."'";
                  
                  $ex =Server::$db->query($sql);
                  $count=$ex->rowCount();
                  if ( $count > 0 ) {
                     
                     $sql="SELECT u_id,id FROM UserData WHERE account='$account'";//抓取使用者名稱
                     $findUsername=Server::$db->query($sql);
                     
                     $id_result=$findUsername->fetch(PDO::FETCH_ASSOC);
                    
                     $user_id= $id_result['id'];
                     $u_id=$id_result['u_id'];
                     
                     if( $id_result){
                        $log=Server::$db->prepare("INSERT INTO `UserLoginTime`(`u_id`,`Status`,`IP`) VALUES(:u_id,:Status,:IP)");
                        $log->execute(array(
                                    ':u_id'=>$u_id,
                                    ':Status'=>'Login',
                                    ':IP'=>Server::$myip
                           ));

                        }
                     //更新使用者登入次數
                     $Visit="UPDATE UserData SET visit=visit+1 where account='$account'";
                     Server::$db->query($Visit);
                        
                     $_SESSION['status']=true;
                     $_SESSION['u_id']=$u_id;
                     $_SESSION['user_id']=$user_id;
                     header("Location: /EasyMVC/");
                     exit();
                  } 
                     else {  
                    return "<script> alert('Account or Password Error!');location.href='/EasyMVC/'</script>";
                  }//登入失敗
      }
      
      }
      
      function logout(){
            /*$u_id=$_SESSION['u_id'];
            $delete="DELETE FROM `UserLoginTime` WHERE u_id='$u_id'";
            $go_delete=mysqli_query($link,$delete); */
            session_unset();
            header("Location:/EasyMVC/");
        }
      
}
?>
