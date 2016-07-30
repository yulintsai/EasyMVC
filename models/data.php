<?php
class data{
    
    function __construct(){
                 Server::setConnect();
        }
    
    function mergeData($usremail,$ip){
        $user_id=$_SESSION['user_id'];
        return $a=array($user_id,$usremail,$ip);
    }
    
    function getIP(){
            if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                $myip = $_SERVER['HTTP_CLIENT_IP'];
             }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $myip = $_SERVER['HTTP_X_FORWARDED_FOR'];
             }else{
                $myip= $_SERVER['REMOTE_ADDR'];
             }
             return $myip;
        }
        
    function searchUserdata(){
            $u_id=$_SESSION['u_id'];
            $edit1_sql='SELECT account,email FROM UserData WHERE u_id='.$u_id;
            $row=Server::$mysqli->query($edit1_sql)->fetch_row();
            return $row[1];
        }//找使用者帳號跟信箱
        
    function __destruct(){
            Server::closeConnect();
        }    
}
?>