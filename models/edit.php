<?php
class edit{
    
    function goEidt(){
        
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
        
        
        
        //if(isset($_POST['signup'])){
        include("mysql.inc.php");
        $username=trim($_POST["Username"]);
        $email=test_input($_POST['Email']);
        $pwd=$_POST['Password'];
        if(empty($pwd))
        echo 'Password empty';
        if(empty($username))
        echo 'UserName empty';
        if(empty($email))
        echo 'E-mail empty';
        if($pwd!==$_POST['RePassword']){
        echo 'Password Not The Same';}
        else{
        //檢查舊密碼是否輸入正確
            $pwd = test_input($pwd);
            $pwd = md5($pwd);
            $u_id=$_SESSION['u_id'];
            $FindOldpwd="SELECT pwd FROM UserData WHERE u_id='$u_id'";
            $OldPWD=$mysqli->query($FindOldpwd);
            $Answer= $OldPWD->fetch_row();
            if($Answer[0]!=$pwd){
                echo "Password Error";
            }else
            
                {
                
                 $ip=$_POST['u_ip'];
                 $u_id=$_SESSION['u_id'];
                 
                 $username=$mysqli->real_escape_string($username);
                 $pwd=$mysqli->real_escape_string($pwd);
                 $email=$mysqli->real_escape_string($email);
                 
                 $edi_sql="UPDATE UserData SET id='$username',pwd='$pwd',email='$email' where u_id='$u_id'";
                 $goedit=$mysqli->query($edi_sql);
                 if($goedit){
                     $_SESSION['user_id']=$username;
                     echo "<script> alert('Update Data Success');location.href='index.php'</script>";
                    // header("Location: logout.php");
                    if($_POST['DeleteAllScoreData']=="delete"){     //check delete checkbox
                        $Dsql="DELETE FROM g_log WHERE u_id = '$u_id'";
                        if($mysqli->query($Dsql)){
                            echo "<script>alert('PLEASE LOGIN AGAIN');location.href='/EasyMVC';</script>";
                        }
                            else{
                             echo "Error";
                        }
                        
                    }
                 }else{
                     echo "<script> alert('Error Input');location.href='index.php'</script>";
                     
                 }
                
            }
        }
            
    }
        //}
}
?>