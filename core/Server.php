<?php
    #server負責進行資料庫連接，將連接資料建給靜態變數$mysqli
    class Server {
        
        public static $mysqli,$myip,$db;
        
        public static function setConnect() {
            $db_server="localhost";
            $db_user="rain123473";
            $db_pwd="0000";
            $db_name="project";
            
            $mysqli=new mysqli($db_server,$db_user,$db_pwd,$db_name);
            
            if($mysqli->connect_errno)
                die("Can't Connect Database");
                
            $mysqli->set_charset("utf8");
            Server::$mysqli=$mysqli;
        }
        
        public static function closeConnect() {
            Server::$mysqli->close();
        }
        
        public static function pdoConnect(){
            
            $config['db']['dsn']='mysql:host=localhost; dbname=project; charset=utf8';
            // 資料庫的帳號密碼 >>> 要依照你的資料做設定
            $config['db']['user'] = 'rain123473';
            $config['db']['password'] = '0000';
            
            $db = new PDO(
                $config['db']['dsn'],
                $config['db']['user'],
                $config['db']['password'],
                    array(
                        PDO::ATTR_EMULATE_PREPARES=>false,
                        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
                    )
                );
             Server::$db=$db;
                
            }
        
        public static function GetIP(){
            if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                $myip = $_SERVER['HTTP_CLIENT_IP'];
             }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $myip = $_SERVER['HTTP_X_FORWARDED_FOR'];
             }else{
                $myip= $_SERVER['REMOTE_ADDR'];
             }
             Server::$myip = $myip;
        }
        
        
        
        
    }
?>