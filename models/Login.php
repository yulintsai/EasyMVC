
<?php
class Login{
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
      
      function CheckLogin(){ 
      
      // 檢查是否輸入使用者名稱和密碼
      $account =$_POST["Account"];
      $password = $_POST["Password"];
      // 取得表單欄位值
      
      if($account==null and $password==null){
         echo "<script> alert('NO input!');location.href='/EasyMVC/'</script>t";
      }elseif ($account==null ){
         echo "<script> alert('No Account!');location.href='/EasyMVC/'</script>";
      
      }elseif($password==null ){
         echo "<script> alert('No Password!');location.href='/EasyMVC/'</script>";
      }else{
      
      
         // 建立MySQL的資料庫連接 
         include("GetIP.php");
         //避免SQL Injection
         $account=Server::$mysqli->real_escape_string($account);
         $password=md5(Server::$mysqli->real_escape_string($password));
         
         // 建立SQL指令字串
         $sql = "SELECT * FROM UserData WHERE pwd='";
         $sql.= $password."' AND account='".$account."'";
         // 執行SQL查詢
         $result = Server::$mysqli->query($sql);
         $total_records = $result->num_rows;
        
         // 是否有查詢到使用者記錄
         if ( $total_records > 0 ) {
            // 成功登入, 指定Session變數
            
            
            //並給予cookie轉址到/EasyMVC.php
            $sql="SELECT u_id,id FROM UserData WHERE account='$account'";//抓取使用者名稱
            $username=Server::$mysqli->query($sql); 
            $user_ID=$username->fetch_assoc();
            $user_id= $user_ID['id'];
            $u_id=$user_ID['u_id'];
            //更新使用者登入次數
            $Visit="UPDATE UserData SET visit=visit+1 account='$account'";
            $UpdateVisit=Server::$mysqli->query($online);
            if($username){
            $myip=$this->GetIP();
            $log="INSERT INTO `UserLoginTime`(`u_id`,`Status`,`IP`) VALUES ('$u_id','Login','$myip')";
            Server::$mysqli->query($log);
            }
            $_SESSION['status']=true;
            $_SESSION['u_id']=$u_id;
            $_SESSION['user_id']=$user_id;
            header("Location: /EasyMVC/");
         } else {  // 登入失敗
            
           echo "<script> alert('Account or Password Error!');location.href='/EasyMVC/'</script>";
           
            
            //header("Location: /EasyMVC");
         }
        // $mysqli->close();  // 關閉資料庫連接  
      }
      
      }
      
}
?>
