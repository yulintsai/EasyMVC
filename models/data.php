<?php
class data{
    
    function __construct(){
                 Server::pdoConnect();
        }
    
    function mergeData($usremail,$ip){
        $user_id=$_SESSION['user_id'];
        return array($user_id,$usremail,$ip);
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
            $row=Server::$db->query($edit1_sql);
            $result=$row->fetch(PDO::FETCH_ASSOC);
            return $result;
        }//找使用者帳號跟信箱
        
}
?>