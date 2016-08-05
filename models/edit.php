<?php
class edit extends dataFilter{
    
    public function __construct(){
            Server::pdoConnect();
            Server::setConnect();
        }
    
    function edit(){
        
        $username=$this->test_input($_POST["Username"]);
        $email=$this->test_input($_POST['Email']);
        $pwd=$this->test_input($_POST['Password']);
       
        $ip=$_POST['u_ip'];
        $u_id=$_SESSION['u_id'];
        //檢查舊密碼是否輸入正確
        $pwd = md5($pwd);
        $u_id=$_SESSION['u_id'];
        $FindOldpwd="SELECT `pwd` FROM `UserData` WHERE `u_id`='$u_id'";
        $OldPWD=Server::$db->query($FindOldpwd);
        $Answer= $OldPWD->fetch(PDO::FETCH_ASSOC);
        
        if($Answer['pwd']!==$pwd){
            return "Password Error";
        }
        else {
             $edi_sql="UPDATE `UserData` SET `id`='$username',`pwd`='$pwd',`email`='$email' WHERE `u_id`='$u_id'";
             $goedit=Server::$db->query($edi_sql);
             if($goedit){
                 $_SESSION['user_id']=$username;
                 return "<script> alert('Update Data Success');location.href='/EasyMVC'</script>";
                if($_POST['DeleteAllScoreData']=="delete"){     //check delete checkbox
                    $Dsql="DELETE FROM `GameLog` WHERE `u_id` = '$u_id'";
                    if(Server::$mysqli->query($Dsql)){
                        return "<script>alert('PLEASE LOGIN AGAIN');location.href='/EasyMVC';</script>";
                    }
                        else{
                         return "Error";
                    }
                    
                }
             }else{
                 return "<script> alert('Error Input');location.href='/EasyMVC'</script>";
                 
             }
            
        }
    }
    
    
     function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          $data = Server::$mysqli->real_escape_string($data);
          return $data;
        } //過濾Input
    
    
    
}
?>