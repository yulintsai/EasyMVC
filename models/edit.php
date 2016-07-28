<?php
class edit extends dataFilter{
    
    public function __construct(){
            Server::setConnect();
        }
    
    function edit(){
        //if(isset($_POST['signup'])){
        $username=$this->test_input($_POST["Username"]);
        $email=$this->test_input($_POST['Email']);
        $pwd=$this->test_input($_POST['Password']);
       
        $ip=$_POST['u_ip'];
        $u_id=$_SESSION['u_id'];
        //檢查舊密碼是否輸入正確
        $pwd = md5($pwd);
        $u_id=$_SESSION['u_id'];
        $FindOldpwd="SELECT pwd FROM UserData WHERE u_id='$u_id'";
        $OldPWD=Server::$mysqli->query($FindOldpwd);
        $Answer= $OldPWD->fetch_row();
        
            if($Answer[0]!==$pwd){
                echo "Password Error";
            }
            else {
                 $edi_sql="UPDATE UserData SET id='$username',pwd='$pwd',email='$email' where u_id='$u_id'";
                 $goedit=Server::$mysqli->query($edi_sql);
                 if($goedit){
                     $_SESSION['user_id']=$username;
                     echo "<script> alert('Update Data Success');location.href='/EasyMVC'</script>";
                    // header("Location: logout.php");
                    if($_POST['DeleteAllScoreData']=="delete"){     //check delete checkbox
                        $Dsql="DELETE FROM GameLog WHERE u_id = '$u_id'";
                        if(Server::$mysqli->query($Dsql)){
                            echo "<script>alert('PLEASE LOGIN AGAIN');location.href='/EasyMVC';</script>";
                        }
                            else{
                             echo "Error";
                        }
                        
                    }
                 }else{
                     echo "<script> alert('Error Input');location.href='/EasyMVC'</script>";
                     
                 }
                
            }
            
               
        
            
    }
    
}
?>