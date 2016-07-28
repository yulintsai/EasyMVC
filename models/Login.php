
<?php
class Login {
   
      function __construct(){
            Server::setConnect();
            Server::GetIP();
            Server::pdoConnect();
        }
      
      function CheckLogin(){ 
      
      $account =  $_POST["Account"];
      $password= $_POST["Password"];
      
      // 檢查是否輸入使用者名稱和密碼
      if(($account&&$password)==""){
         return "<script>alert('NO input!');location.href='/EasyMVC/'</script>t";
         }else{
            
                  //避免SQL Injection
                  $account=Server::$mysqli->real_escape_string($account);
                  $password=md5(Server::$mysqli->real_escape_string($password));
                  
                  // 進行帳密確認
                  $sql = "SELECT * FROM UserData WHERE pwd='";
                  $sql.= $password."' AND account='".$account."'";
                  
                  if ( Server::$mysqli->query($sql)->num_rows > 0 ) {
                     
                     $sql="SELECT u_id,id FROM UserData WHERE account='$account'";//抓取使用者名稱
                     $findUsername=Server::$mysqli->query($sql);
                     if($findUsername){
                        $log="INSERT INTO `UserLoginTime`(`u_id`,`Status`,`IP`) VALUES ('$u_id','Login','".Server::$myip."')";
                        Server::$mysqli->query($log);
                        }
                     $id_result=$findUsername->fetch_assoc();
                     $user_id= $id_result['id'];
                     $u_id=$id_result['u_id'];
                     //更新使用者登入次數
                     $Visit="UPDATE UserData SET visit=visit+1 account='$account'";
                     Server::$mysqli->query($Visit);
                        
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
      
}
?>
