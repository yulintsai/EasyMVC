<?php
    #server負責進行資料庫連接，將連接資料建給靜態變數$worldO 
    class Server {
        
        public static $mysqli;
        
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
    }
    ?>